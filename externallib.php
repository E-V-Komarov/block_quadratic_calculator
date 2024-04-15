<?php
require_once($CFG->libdir . "/externallib.php");

class block_quadratic_calculator_external extends external_api {
    public static function get_history_parameters() {
        return new external_function_parameters(array());
    }

    public static function get_history() {
        global $USER, $DB;
        require_login();
        $history = $DB->get_records('block_quadratic_calculator_history', array('userid' => $USER->id), 'timemodified DESC');
        return $history;
    }

    public static function get_history_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, 'Record ID'),
                    'userid' => new external_value(PARAM_INT, 'User ID'),
                    'a' => new external_value(PARAM_FLOAT, 'Coefficient A'),
                    'b' => new external_value(PARAM_FLOAT, 'Coefficient B'),
                    'c' => new external_value(PARAM_FLOAT, 'Coefficient C'),
                    'x1' => new external_value(PARAM_FLOAT, 'First root', VALUE_OPTIONAL),
                    'x2' => new external_value(PARAM_FLOAT, 'Second root', VALUE_OPTIONAL),
                    'timemodified' => new external_value(PARAM_INT, 'Time modified')
                )
            )
        );
    }
}