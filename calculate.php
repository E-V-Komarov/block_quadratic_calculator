<?php
require_once(__DIR__ . '/../../config.php');
require_login();
require_sesskey();

header('Content-Type: application/json');

$a = required_param('a', PARAM_FLOAT);
$b = required_param('b', PARAM_FLOAT);
$c = required_param('c', PARAM_FLOAT);

$discriminant = $b * $b - 4 * $a * $c;
$x1 = null;
$x2 = null;
$result = [];

if ($discriminant > 0) {
    $x1 = (-$b + sqrt($discriminant)) / (2 * $a);
    $x2 = (-$b - sqrt($discriminant)) / (2 * $a);
} elseif ($discriminant == 0) {
    $x1 = -$b / (2 * $a);
    $x2 = $x1;
}

if (isset($x1) && isset($x2)) {
    $result = ['x1' => $x1, 'x2' => $x2];
    // Сохраняем результаты в базу данных
    $record = new stdClass();
    $record->userid = $USER->id;
    $record->a = $a;
    $record->b = $b;
    $record->c = $c;
    $record->x1 = $x1;
    $record->x2 = $x2;
    $record->timemodified = time();
    
    try {
        $DB->insert_record('block_quadratic_calculator_history', $record);
    } catch (dml_exception $e) {
        //debugging('Error inserting record: ' . $e->getMessage(), DEBUG_DEVELOPER);
        $result['error'] = get_string('error_insert_record', 'block_quadratic_calculator');
    }
} else {
    $result['error'] = get_string('error_calculate_roots', 'block_quadratic_calculator');
}

echo json_encode($result);
exit();