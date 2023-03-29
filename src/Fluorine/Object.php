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
use Fluorine\ClearObject;
use Fluorine\NextArray;

class NextObject {
    protected object $elements;

    function __construct(object $element = NULL) {
        $this->elements = new ClearObject();

        if ($element instanceof NextObject && $element !== NULL) {
            $this->baseImport($element->getElements());
        } elseif ($element !== NULL) {
            $this->baseImport($element);
        }
    }

    protected function baseImport(object $object, bool $override = true) : void {
        foreach ($object as $key => $value) {
            if (!empty($this->elements->{$key}) && !$override) {
                continue;
            }
            $this->elements->{$key} = $value;
        }
    }

    public function getElements() : object {
        return $this->elements;
    }

    public function elements() : object {
        return $this->elements;
    }

    public function import(object $element, bool $override) : void {
        if ($element instanceof NextObject && $element !== NULL) {
            $this->baseImport($element->getElements());
        } elseif ($element !== NULL) {
            $this->baseImport($element);
        }
    }

    public function join(object $element, bool $override) : void {
        $this->import($element, $override);
    }

    public function __get(string $offset) : mixed {
        return $this->elements->{$offset};
    }

    public function __set(string $offset, mixed $value) : void {
        $this->elements->{$offset} = $value;
    }

    public function foreach(callable $callback) : void {
        foreach ($this->elements as $key => $value) {
            $callback($key, $value);
        }
    }

    public function remove(string $type, string $search) : bool {
        if ($type === 'key') {
            $this->foreach(function(string $key) use ($search) {
                if ($key === $search) {
                    $this->elements->{$key} = NULL;
                }
            });
            return true;
        } elseif ($type === 'value') {
            $this->foreach(function(string $key, mixed $value) use ($search) {
                if ($value === $search) {
                    $this->elements->{$key} = NULL;
                }
            });
            return true;
        }
        return false;
    }

    public function count() : int {
        return count($this->elements);
    }

    public function is(string $offset) : bool {
        if (!empty($this->elements->{$offset})) {
            return true;
        }
        return false;
    }

    public function exists(string $offset) : bool {
        return $this->is($offset);
    }

    private function objectify() : void {
        $this->elements = (object)$this->elements;
    }

    public function asort() : void {
        asort((array)$this->elements);
        $this->objectify();
    }

    public function ksort() : void {
        ksort((array)$this->elements);
        $this->objectify();
    }

    public function arsort() : void {
        arsort((array)$this->elements);
        $this->objectify();
    }

    public function krsort() : void {
        krsort((array)$this->elements);
        $this->objectify();
    }
}