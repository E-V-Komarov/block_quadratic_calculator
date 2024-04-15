<?php
defined('MOODLE_INTERNAL') || die();

$services = array(
    'Quadratic Calculator Service' => array(
        'functions' => array (
            'block_quadratic_calculator_get_history',
        ),
        'restrictedusers' => 0,
        'enabled' => 1,
        'shortname' => 'quadratic_calculator_service'
    )
);

$functions = array(
    'block_quadratic_calculator_get_history' => array(
        'classname'   => 'block_quadratic_calculator_external',
        'methodname'  => 'get_history',
        'classpath'   => 'blocks/quadratic_calculator/externallib.php',
        'description' => 'Returns the history of calculations for the user.',
        'type'        => 'read',
        'ajax'        => true,
        'capabilities' => '',
    ),
    // Другие функции веб-сервиса, если они есть...
);