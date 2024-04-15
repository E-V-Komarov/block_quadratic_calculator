<?php
declare(strict_types=1);

class block_quadratic_calculator extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_quadratic_calculator');
    }

    public function get_content() {
      global $OUTPUT, $PAGE;
  
      if ($this->content !== null) {
          return $this->content;
      }
  
      $this->content = new stdClass;
      $this->content->text = '';
      $this->content->footer = '';
  
      // Подключаем JavaScript-модуль для AJAX.
      $PAGE->requires->js_call_amd(
          'block_quadratic_calculator/module', 
          'init', 
          array('selector' => '#quadratic-calculator-form')
      );
  
      // Подключаем JavaScript-модуль для модального окна.
      $PAGE->requires->js_call_amd(
          'block_quadratic_calculator/modal', 
          'init'
      );
  
      // Подготавливаем данные для шаблона.
      $data = new stdClass();
      $data->action_url = new moodle_url('/blocks/quadratic_calculator/calculate.php');
      $data->sesskey = sesskey();
  
      // Рендерим форму с использованием шаблона Mustache.
      $this->content->text = $OUTPUT->render_from_template('block_quadratic_calculator/calculator_form', $data);
  
      // Добавляем HTML-код кнопки для открытия модального окна.
      //$this->content->text .= $OUTPUT->render_from_template('block_quadratic_calculator/history', new stdClass());
  
      return $this->content;
    }
}