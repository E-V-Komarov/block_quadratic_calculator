# Quadratic Equation Calculator

## This project implements a quadratic equation calculator with the following features:

* Calculates roots of quadratic equations (ax^2 + bx + c = 0)
* Stores calculation history in a database
* User interface for inputting coefficients and viewing results
* Input validation to ensure correct data format
* Written with strict type declarations (declare(strict_types=1))

## To Use:

* Download the source code or release file (.zip).
* Install any necessary dependencies.
* Run the application or install the Moodle block plugin as per the instructions.
* Enter the coefficients (a, b, c) of the quadratic equation and click "Calculate".
* The calculated roots (x1 and x2) will be displayed, along with an option to save the results to the database.

## Technical Implementation Details:

* Database: MySQL with XML database representation
* Communication: AJAX requests for dynamic data retrieval and manipulation
* User Interface: moodle modal dialogs for user interactions, moodle theme styles for consistent visual appearance
