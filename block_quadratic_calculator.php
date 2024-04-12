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

    $PAGE->requires->js_call_amd('block_quadratic_calculator/assets/module', 'init');

    $data = new stdClass();
      $data->action_url = $this->page->url->out(false);
      $data->sesskey = sesskey();
  
      // Если был POST-запрос, обрабатываем данные.
      if (data_submitted() && confirm_sesskey()) {
        $a = required_param('a', PARAM_FLOAT);
        $b = required_param('b', PARAM_FLOAT);
        $c = required_param('c', PARAM_FLOAT);

        // Решение квадратного уравнения и вычисление корней.
        $discriminant = $b * $b - 4 * $a * $c;
        $x1 = null;
        $x2 = null;

        if ($discriminant > 0) {
            $x1 = (-$b + sqrt($discriminant)) / (2 * $a);
            $x2 = (-$b - sqrt($discriminant)) / (2 * $a);
        } elseif ($discriminant == 0) {
            $x1 = -$b / (2 * $a);
        }

        // Добавление результатов в данные для шаблона.
        $data->x1 = $x1;
        $data->x2 = $x2;
      }
  
      // Рендеринг формы с использованием шаблона.
      $this->content->text = $OUTPUT->render_from_template('block_quadratic_calculator/calculator_form', $data);

    return $this->content;
}
}