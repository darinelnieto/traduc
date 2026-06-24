# Sajo Theme

## Available Commands

### Create Templates and Partials

Create a new template:
```bash
php sajo make:template template_name
```
This creates:
- `templates/template-name-template.php`
- `sass/templates/_template-name-template.scss`
- Imports in `sass/main.scss` using `@import`

Create a new partial:
```bash
php sajo make:partial partial_name
```
This creates:
- `partials/partial_name.php` (with enqueued JS)
- `js/partials/partial_name.js` (source file)
- `js/partials-min/partial_name.min.js` (minified file)
- `sass/partials/_partial_name.scss`
- Imports in `sass/main.scss` using `@import`

### Build Partial JavaScript

Build a specific partial's JavaScript into minified version:
```bash
php sajo build:partial-js partial_name
```

Build all partials' JavaScript files:
```bash
php sajo build:partial-js
```

This compiles `.js` files from `js/partials/` into `.min.js` files in `js/partials-min/`.

### Theme Commands

Display theme name:
```bash
php sajo theme:name
```
