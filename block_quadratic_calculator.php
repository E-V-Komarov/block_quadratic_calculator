<?php
declare(strict_types=1);

class block_quadratic_calculator extends block_base {

    const BLOCK_NAME = 'block_quadratic_calculator';
    const BLOCK_DIR = '/blocks/quadratic_calculator/';

    public function init() {
        $this->title = get_string('pluginname', self::BLOCK_NAME);
    }

    public function get_content(): object {
        global $OUTPUT;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = (object) [
            'text' => '',
            'footer' => '',
        ];

        // Подключаем JavaScript-модули.
        $this->init_js_module('module', ['#quadratic-calculator-form']);
        $this->init_js_module('modal');

        // Подготавливаем данные для шаблона.
        $data = (object) [
            'action_url' => new moodle_url(self::BLOCK_DIR .'calculate.php'),
            'sesskey' => sesskey(),
        ];

        // Рендерим форму с использованием шаблона Mustache.
        $this->content->text = $OUTPUT->render_from_template(self::BLOCK_NAME . '/calculator_form', $data);

        return $this->content;
    }

    /**
     * Initializes a JavaScript module from the moodle block's directory.
     *
     * @param string    $module         The name of the JavaScript module to load (relative path within the block).
     * @param array     $arguments      (optional) An array of arguments to pass to the module's 'init' function.
     */
    private function init_js_module(string $module, array $arguments = []) {
        global $PAGE;
        $PAGE->requires->js_call_amd(self::BLOCK_NAME . '/' . $module, 'init', $arguments);

    }
}