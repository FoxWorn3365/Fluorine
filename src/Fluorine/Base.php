<?php
/**
 * --------------------------------
 *    Fluorine - OOP PHP - File
 * --------------------------------
 * This file is under the MIT license.
 * This file is apart of the Fluorine OSS Project by FoxWorn3365 (Federico Cosma)
 * 
 * Some right are reserved.
 * 
 * Contact:
 *  - Email: foxworn3365@gmail.com
 *  - Discord: FoxWorn#0001
 * 
 * GitHub:
 *  - Author: https://github.com/FoxWorn3365
 *  - Repository: https://github.com/FoxWorn3365/Fluorine
 * 
 * (C) 2023-now FoxWorn3365
*/
namespace Fluorine;
use Fluorine\NextArray;
use Fluorine\NextObject;
use Fluorine\NextString;

class ClearObject {}
class Fluorine {
    public const AUTHOR = "FoxWorn3365";
    public const LICENSE = "MIT";
    public const GITHUB = "https://github.com/FoxWorn3365/Fluorine";
    public const NUMER = 9;

    public static function string(string $string = NULL) : NextString {
        return new NextString($string);
    }

    public static function array(array $element = NULL) : NextArray {
        return new NextArray($element);
    }

    public static function object(object $obj = NULL) : NextObject {
        return new NextObject($obj);
    }
}