<?php

require_once 'src/utils.php';
require_once 'vendor/autoload.php';

use CarStore\Car;
use PHPUnit\Framework\TestCase;

class ListOfCarsTest extends TestCase
{
    public function test_List_Of_Cars()
    {
        $expected = "";
        $expected .= "<h3>" . "ferrari spyder" . "</h3>";
        $expected .= "<ul>";
        $expected .= "<li>" . 2000 . "</li>";
        $expected .= "<li>" . 2.3 . "</li>";
        $expected .= "<li>" . 200000 . "</li>";
        $expected .= "<li>" . "ferrari" . "</li>";
        $expected .= "</ul>";

        $car = [new Car("ferrari spyder", 2000, 2.3, 200000, "ferrari")];

        $this->assertEquals($expected, create_list_of_cars($car));
    }

    public function test_Malformed_List_Of_Cars()
    {
        $input = [["ferrari", 2000, 2.3, 200000, "ferrar"]];
        $this->assertFalse(create_list_of_cars($input));
    }

    public function test_Empty_Array()
    {
        $input = [];
        $this->expectExceptionMessage("Empty car array");

        create_list_of_cars($input);
    }
}
