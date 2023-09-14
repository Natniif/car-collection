<?php

require_once "src/utils.php";
require_once "vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use CarStore\Car;


class validateAddCarDataFieldsTest extends TestCase
{
    public function test_Incorrect_Data()
    {
        $expected =
            "Invalid name<br>Invalid year<br>Invalid zero to sixty value<br>Invalid price<br>Invalid brand name<br>";
        $this->assertEquals($expected, validateAddCarDataFields(
            "",
            -2000,
            -23,
            -23,
            "herlskdjflksjdkfjsklkkdkfssssssssssssssssssssssssssss"
        ));
    }

    public function test_Correct_Data()
    {
        $this->assertEquals(
            "Car successfully submitted",
            validateAddCarDataFields("ferrari spyder", 2000, 5.3, 200000, "ferrari")
        );
    }
}
