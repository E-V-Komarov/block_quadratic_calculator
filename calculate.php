<?php
declare(strict_types=1);

require_once(__DIR__ . '/../../config.php');
require_login();
require_sesskey();

header('Content-Type: application/json');

$a = required_param('a', PARAM_FLOAT);
$b = required_param('b', PARAM_FLOAT);
$c = required_param('c', PARAM_FLOAT);

// Решение квадратного уравнения и вычисление корней.
$discriminant = $b * $b - 4 * $a * $c;
$x1 = null;
$x2 = null;
$result = [];

if ($discriminant > 0) {
    $x1 = (-$b + sqrt($discriminant)) / (2 * $a);
    $x2 = (-$b - sqrt($discriminant)) / (2 * $a);
    $result = ['x1' => $x1, 'x2' => $x2];
} elseif ($discriminant == 0) {
    $x1 = -$b / (2 * $a);
    $result = ['x1' => $x1, 'x2' => $x1];
} else {
    $result = ['error' => get_string('error_calculate_roots', 'block_quadratic_calculator')];
}

echo json_encode($result);