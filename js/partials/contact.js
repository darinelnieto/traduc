// JS for partial: contact

function loadHubSpotScript() {
    if (window.hbspt && window.hbspt.forms) return Promise.resolve();

    const existing = document.querySelector('script[data-hubspot-embed="1"]');
    if (existing) {
        return new Promise(resolve => {
            existing.addEventListener('load', resolve, { once: true });
            if (window.hbspt && window.hbspt.forms) resolve();
        });
    }

    return new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = 'https://js.hsforms.net/forms/embed/v2.js';
        script.async = true;
        script.defer = true;
        script.dataset.hubspotEmbed = '1';
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
    });
}

function isLongField(name, type) {
    const n = (name || '').toLowerCase();
    return type === 'textarea' || n.includes('message') || n.includes('coment') || n.includes('detalle');
}

function normalizeText(str) {
    return (str || '').replace(/\*/g, '').trim();
}

function getHubSpotPlaceholder(hsField, input, type) {
    if (type === 'select') {
        const emptyOpt = hsField.querySelector('select option[value=""]');
        return normalizeText(emptyOpt ? emptyOpt.textContent : '');
    }

    return normalizeText(input.getAttribute('placeholder') || '');
}

function buildInputControl(fieldDef) {
    const { type, name, required, placeholder, options } = fieldDef;

    if (type === 'textarea') {
        const textarea = document.createElement('textarea');
        textarea.name = name;
        textarea.required = required;
        textarea.placeholder = placeholder || 'Ej: Historia clínica de paciente para proceso de visa médica en EE.UU. Necesito traducción al inglés con certificación...';
        textarea.className = 'ft';
        textarea.rows = 5;
        return textarea;
    }

    if (type === 'select') {
        const select = document.createElement('select');
        select.name = name;
        select.required = required;
        select.className = 'fs';

        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = placeholder || 'Selecciona una opción';
        select.appendChild(defaultOption);

        options.forEach(opt => {
            const option = document.createElement('option');
            option.value = opt.value;
            option.textContent = opt.label;
            select.appendChild(option);
        });

        return select;
    }

    if (type === 'checkbox_group') {
        const wrap = document.createElement('div');
        wrap.className = 'fg-checks';
        options.forEach((opt, idx) => {
            const label = document.createElement('label');
            label.className = 'fl';
            label.style.display = 'flex';
            label.style.alignItems = 'center';
            label.style.gap = '8px';

            const input = document.createElement('input');
            input.type = 'checkbox';
            input.name = name;
            input.value = opt.value;
            input.id = name + '_' + idx;

            const span = document.createElement('span');
            span.textContent = opt.label;

            label.appendChild(input);
            label.appendChild(span);
            wrap.appendChild(label);
        });
        return wrap;
    }

    if (type === 'radio') {
        const wrap = document.createElement('div');
        wrap.className = 'fg-radios';
        options.forEach((opt, idx) => {
            const label = document.createElement('label');
            label.className = 'fl';
            label.style.display = 'flex';
            label.style.alignItems = 'center';
            label.style.gap = '8px';

            const input = document.createElement('input');
            input.type = 'radio';
            input.name = name;
            input.value = opt.value;
            input.required = required;
            input.id = name + '_' + idx;

            const span = document.createElement('span');
            span.textContent = opt.label;

            label.appendChild(input);
            label.appendChild(span);
            wrap.appendChild(label);
        });
        return wrap;
    }

    const input = document.createElement('input');
    input.type = type || 'text';
    input.name = name;
    input.required = required;
    input.placeholder = placeholder || '';
    input.className = 'fi';
    return input;
}

function parseHubSpotField(hsField) {
    const labelEl = hsField.querySelector('label');
    const input = hsField.querySelector('input:not([type="hidden"]):not([type="submit"]), textarea, select');
    if (!input) return null;

    const rawType = input.tagName.toLowerCase() === 'textarea'
        ? 'textarea'
        : (input.tagName.toLowerCase() === 'select' ? 'select' : input.type);

    let type = rawType;
    if (input.type === 'checkbox' && hsField.querySelectorAll('input[type="checkbox"]').length > 1) {
        type = 'checkbox_group';
    }

    const name = input.name;
    if (!name) return null;

    const options = [];
    if (type === 'select') {
        hsField.querySelectorAll('select option').forEach((opt, idx) => {
            if (idx === 0 && !opt.value) return;
            options.push({ value: opt.value, label: normalizeText(opt.textContent) });
        });
    }
    if (type === 'checkbox_group' || type === 'radio') {
        hsField.querySelectorAll('input[type="checkbox"], input[type="radio"]').forEach(opt => {
            const optLabel = hsField.querySelector('label[for="' + opt.id + '"]');
            options.push({
                value: opt.value,
                label: normalizeText(optLabel ? optLabel.textContent : opt.value),
            });
        });
    }

    const required = !!input.required || !!hsField.querySelector('.hs-form-required');
    const label = normalizeText(labelEl ? labelEl.textContent : name);
    const placeholder = getHubSpotPlaceholder(hsField, input, type);

    return {
        name,
        type,
        required,
        label,
        placeholder,
        options,
        isLong: isLongField(name, type),
    };
}

function buildCustomForm(target, fieldDefs, submitLabel) {
    const form = document.createElement('form');
    form.className = 'form-grid';
    form.id = 'hsCustomQuoteForm';

    fieldDefs.forEach(fieldDef => {
        const group = document.createElement('div');
        group.className = 'fg';
        if (fieldDef.isLong || fieldDef.type === 'checkbox_group' || fieldDef.type === 'radio' || fieldDef.name === 'tipo_de_documento') {
            group.classList.add('fg--full');
        }

        if (fieldDef.type !== 'checkbox_group' && fieldDef.type !== 'radio') {
            const label = document.createElement('label');
            label.className = 'fl';
            label.htmlFor = 'f_' + fieldDef.name;
            label.textContent = fieldDef.label + (fieldDef.required ? ' *' : '');
            group.appendChild(label);
        } else {
            const legend = document.createElement('div');
            legend.className = 'fl';
            legend.textContent = fieldDef.label + (fieldDef.required ? ' *' : '');
            group.appendChild(legend);
        }

        const control = buildInputControl(fieldDef);
        if (control.id !== undefined && !control.id) {
            control.id = 'f_' + fieldDef.name;
        }
        group.appendChild(control);
        form.appendChild(group);
    });

    const submitWrap = document.createElement('div');
    submitWrap.className = 'fg fg--full';

    const submitBtn = document.createElement('button');
    submitBtn.type = 'submit';
    submitBtn.className = 'btn btn--terra btn--lg btn-arrow';
    submitBtn.id = 'hsCustomSubmitBtn';
    submitBtn.textContent = submitLabel || 'Solicitar cotización';

    submitWrap.appendChild(submitBtn);
    form.appendChild(submitWrap);

    target.innerHTML = '';
    target.appendChild(form);

    return form;
}

function getCookie(name) {
    const escaped = name.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    const match = document.cookie.match(new RegExp('(?:^|; )' + escaped + '=([^;]*)'));
    return match ? decodeURIComponent(match[1]) : '';
}

function collectHubSpotPayload(formEl) {
    const fields = [];
    const formData = new FormData(formEl);
    const used = new Set();

    formData.forEach((value, key) => {
        if (!used.has(key)) {
            const allValues = formData.getAll(key);
            used.add(key);

            if (allValues.length > 1) {
                fields.push({ name: key, value: allValues.join(';') });
            } else {
                fields.push({ name: key, value: String(value) });
            }
        }
    });

    const hutk = getCookie('hubspotutk');
    const context = {
        pageUri: window.location.href,
        pageName: document.title,
    };

    if (hutk) {
        context.hutk = hutk;
    }

    return {
        fields,
        context,
    };
}

function renderFeedback(target, message, ok) {
    const status = document.createElement('div');
    status.className = 'fg fg--full';
    status.style.fontSize = '14px';
    status.style.color = ok ? 'var(--verde)' : '#b3261e';
    status.textContent = message;
    target.appendChild(status);
}

function renderSuccessState(target) {
    // target.innerHTML = '';
    // target.insertAdjacentHTML(
    //     'beforeend',
    //     '<div id="successState"><div class="check">✓</div><h3 class="title">¡Solicitud recibida!</h3><p class="message">Te respondemos en menos de 2 horas hábiles. Revisa tu correo electrónico.</p></div>'
    // );
    window.location.href = '/gracias';
}

function getHubSpotErrorMessage(errorData) {
    if (!errorData) return 'No se pudo enviar el formulario. Intenta de nuevo.';
    if (typeof errorData === 'string') return errorData;

    if (Array.isArray(errorData.errors) && errorData.errors.length > 0) {
        const first = errorData.errors[0];
        if (first && first.message) return first.message;
    }

    if (errorData.message) return errorData.message;
    return 'No se pudo enviar el formulario. Intenta de nuevo.';
}

function initHubSpotContactForm() {
    const target = document.getElementById('hsQuoteForm');
    if (!target) return;

    const portalId = (target.dataset.portalId || '').trim();
    const formId = (target.dataset.formId || '').trim();
    const region = (target.dataset.region || 'na1').trim();

    if (!portalId || !formId) {
        console.warn('HubSpot form: missing portalId or formId in #hsQuoteForm');
        return;
    }

    const hiddenMount = document.createElement('div');
    hiddenMount.id = 'hsQuoteFormSource';
    hiddenMount.style.display = 'none';
    document.body.appendChild(hiddenMount);

    loadHubSpotScript()
        .then(() => {
            if (!window.hbspt || !window.hbspt.forms) return;

            window.hbspt.forms.create({
                region,
                portalId,
                formId,
                target: '#hsQuoteFormSource',
                onFormReady: $form => {
                    const sourceForm = $form && $form.get ? $form.get(0) : hiddenMount.querySelector('form');
                    if (!sourceForm) return;

                    const fieldDefs = [];
                    sourceForm.querySelectorAll('.hs-form-field').forEach(hsField => {
                        const fieldDef = parseHubSpotField(hsField);
                        if (fieldDef) fieldDefs.push(fieldDef);
                    });

                    const submitBtn = sourceForm.querySelector('input[type="submit"], button[type="submit"]');
                    const submitLabel = submitBtn ? (submitBtn.value || submitBtn.textContent || 'Enviar').trim() : 'Enviar';

                    const customForm = buildCustomForm(target, fieldDefs, submitLabel);

                    customForm.addEventListener('submit', evt => {
                        evt.preventDefault();

                        if (!customForm.reportValidity()) {
                            return;
                        }

                        const button = customForm.querySelector('#hsCustomSubmitBtn');
                        if (button) {
                            button.disabled = true;
                            button.textContent = 'Enviando...';
                        }

                        const payload = collectHubSpotPayload(customForm);
                        fetch('https://api.hsforms.com/submissions/v3/integration/submit/' + portalId + '/' + formId, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(payload),
                        })
                            .then(res => {
                                if (!res.ok) {
                                    return res.json().then(data => {
                                        throw data;
                                    });
                                }
                                return res.json();
                            })
                            .then(() => {
                                renderSuccessState(customForm);
                            })
                            .catch(error => {
                                if (button) {
                                    button.disabled = false;
                                    button.textContent = submitLabel || 'Enviar';
                                }
                                renderFeedback(customForm, getHubSpotErrorMessage(error), false);
                                console.error('HubSpot submit error:', error);
                            });
                    });
                },
            });
        })
        .catch(() => {
            console.warn('HubSpot form script could not be loaded.');
        });
}

document.addEventListener('DOMContentLoaded', initHubSpotContactForm);