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

class NextString {
    protected string|NULL $string;

    public function __construct(string $string = NULL) {
        $this->string = $string;
    }

    public function set(string $string) : void {
        $this->string = $string;
    }

    public function stripos(mixed $needle) : bool {
        if (stripos($this->string, $needle) !== false) {
            return true;
        }
        return false;
    }

    public function contains(mixed $needle) : bool {
        return $this->stripos($needle);
    }

    public function explode(string $delimiter) : NextArray {
        $array = new NextArray();

        foreach (explode($delimiter, $this->string) as $values) {
            $array->add($values);
        }

        return $array;
    }

    public function implode(NextArray|array $collapse, string $delimiter) : void {
        if ($collapse instanceof NextArray) {
            $values = $collapse->values();
        } else {
            $values = $collapse;
        }

        $this->string = implode($delimiter, $values);
    }

    public function split(string $delimiter) : NextArray {
        return $this->explode($delimiter);
    }

    public function replace(string $char1, string $char2) : void {
        $this->string = str_replace($char1, $char2, $this->string);
    }

    public function remove(string $char) : void {
        $this->string = str_replace($char, "", $this->string);
    }

    public function clone() : self {
        return $this;
    }

    public function toBase64() : void {
        $this->string = base64_encode($this->string);
    }

    public function fromBase64() : void {
        $this->string = base64_decode($this->string);
    }

    public function __toString() : string {
        return $this->string;
    }

    public function md5() : void {
        $this->string = md5($this->string);
    }

    public function print() : void {
        print($this->string);
    }
}