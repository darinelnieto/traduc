<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Sajo\Functions;

require_once('sajo-functions.php');

class MakeTemplateCommand extends Command {
    protected $commandName = 'make:template';
    protected $commandDescription = "Make a WordPress Template";

    protected $commandArgumentName = "template name";
    protected $commandArgumentDescription = "What name will your template have?";

    protected function configure() {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgumentName,
                InputArgument::OPTIONAL,
                $this->commandArgumentDescription
            );
    }
    protected function execute(InputInterface $input, OutputInterface $output) {
        $templateName = $input->getArgument($this->commandArgumentName);
        $randomHash = bin2hex(random_bytes(3));

        if ($templateName) {
            
            $fileName = Functions\Convert::Slug($templateName).'-template';
            if(!is_file('templates/'.$fileName.'.php')){
                $contents = Functions\Content::Template($templateName, $randomHash);
                file_put_contents('templates/'.$fileName.'.php', $contents);
                $output->writeln($fileName.'.php created.');
                if(!is_file('sass/templates/'.$fileName.'.scss')){
                    file_put_contents('sass/templates/_'.$fileName.'.scss', '#'.Functions\Convert::Slug($templateName).'-template-'.$randomHash.' {}');
                    $mainSASS = file('sass/main.scss');
                    foreach ($mainSASS as $key => $line) {
                        if(strpos($line, '#SajoTemplates')) {
                            $mainSASS[$key] = '// #SajoTemplates' . "\n" . '@import "./templates/'.$fileName.'";' . "\n";
                        }
                    }
                    file_put_contents('sass/main.scss', $mainSASS);
                    $output->writeln('sass/partials/_'.$fileName.'.scss created.');
                }
            } else {
                $output->writeln('The template already exists.');
            }
        } else {
            $output->writeln('Type the template name.');
        }
    }
}

class MakePartialCommand extends Command {
    protected $commandName = 'make:partial';
    protected $commandDescription = "Make a WordPress partial";

    protected $commandArgumentName = "partial name";
    protected $commandArgumentDescription = "What name will your partial have?";

    protected function configure() {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgumentName,
                InputArgument::OPTIONAL,
                $this->commandArgumentDescription
            );
    }
    protected function execute(InputInterface $input, OutputInterface $output) {
        $partialName = $input->getArgument($this->commandArgumentName);
        $randomHash = bin2hex(random_bytes(3));
        if ($partialName) {
            
            $fileName = str_replace(' ', '', $partialName);
            if(!is_file('partials/'.$fileName.'.php')){
                $contents = Functions\Content::Partial($partialName, $randomHash);
                $enqueueCode = "<?php
                \$script_handle = '{$fileName}-js';
                wp_enqueue_script(
                    \$script_handle,
                    get_template_directory_uri() . '/js/partials-min/{$fileName}.min.js',
                    array('jquery'),
                    null,
                    true
                );
                ?>\n";
                file_put_contents('partials/'.$fileName.'.php', $enqueueCode . $contents);
                $output->writeln('partials/'.$fileName.'.php created.');
                // Crear archivo JS para el partial
                $jsPath = 'js/partials/'.$fileName.'.js';
                if(!is_file($jsPath)){
                    file_put_contents($jsPath, '// JS for partial: '.$partialName.'\n');
                    $output->writeln($jsPath.' created.');
                }
                if (!is_dir('js/partials-min')) {
                    mkdir('js/partials-min', 0777, true);
                }
                $minJsPath = 'js/partials-min/'.$fileName.'.min.js';
                if(!is_file($minJsPath)){
                    file_put_contents($minJsPath, '// Minified JS for partial: '.$partialName.'\n');
                    $output->writeln($minJsPath.' created.');
                }
                if(!is_file('sass/partials/'.$fileName.'.scss')){
                    file_put_contents('sass/partials/_'.$fileName.'.scss', '.'.Functions\Convert::Slug($partialName).'-partial-'.$randomHash.' {}');
                    $mainSASS = file('sass/main.scss');
                    foreach ($mainSASS as $key => $line) {
                        if(strpos($line, '#SajoPartials')) {
                            $mainSASS[$key] = '// #SajoPartials' . "\n" . '@import "./partials/'.$fileName.'";' . "\n";
                        }
                    }
                    file_put_contents('sass/main.scss', $mainSASS);
                    $output->writeln('sass/partials/_'.$fileName.'.scss created.');
                }
            } else {
                $output->writeln('The partial already exists.');
            }
        } else {
            $output->writeln('Type the partial name.');
        }
    }
}

class BuildPartialJsCommand extends Command {
    protected $commandName = 'build:partial-js';
    protected $commandDescription = "Build partial JS files into .min.js";

    protected $commandArgumentName = "partial name";
    protected $commandArgumentDescription = "Optional partial name. If empty, all partial .js files are built.";

    protected function configure() {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgumentName,
                InputArgument::OPTIONAL,
                $this->commandArgumentDescription
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $partialName = $input->getArgument($this->commandArgumentName);
        $jsFiles = array();

        if ($partialName) {
            $fileName = str_replace(' ', '', $partialName);
            $sourceFile = 'js/partials/'.$fileName.'.js';
            if (!is_file($sourceFile)) {
                $output->writeln('The partial js file does not exist: '.$sourceFile);
                return;
            }
            $jsFiles[] = $sourceFile;
        } else {
            $foundFiles = glob('js/partials/*.js');
            if ($foundFiles) {
                foreach ($foundFiles as $file) {
                    if (substr($file, -7) !== '.min.js') {
                        $jsFiles[] = $file;
                    }
                }
            }
        }

        if (empty($jsFiles)) {
            $output->writeln('No partial js files found to build.');
            return;
        }

        if (!is_dir('js/partials-min')) {
            mkdir('js/partials-min', 0777, true);
        }

        foreach ($jsFiles as $sourceFile) {
            $baseName = basename($sourceFile, '.js');
            $targetFile = 'js/partials-min/'.$baseName.'.min.js';
            $command = 'npx terser '.escapeshellarg($sourceFile).' --compress --mangle --output '.escapeshellarg($targetFile).' 2>&1';
            exec($command, $commandOutput, $exitCode);

            if ($exitCode !== 0) {
                $output->writeln('Error building '.$sourceFile);
                $output->writeln(implode("\n", $commandOutput));
                continue;
            }

            $output->writeln($targetFile.' built.');
        }
    }
}