<?php

require_once "src/utils.php";
require_once "vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use CarStore\Car;


class validateDataFieldsTest extends TestCase
{
    public function test_incorrect_data()
    {
        $expected = "Invalid name<br>Invalid year<br>Invalid zero to sixty value<br>Invalid price<br>Invalid brand name<br>";
        $this->assertEquals($expected, validateDataFields("", -2000, -23, -23, "herlskdjflksjdkfjsklkkdkfssssssssssssssssssssssssssss"));
    }

    public function test_correct_data()
    {
        $this->assertEquals("Car successfully submitted", validateDataFields("ferrari spyder", 2000, 5.3, 200000, "ferrari"));
    }
}
