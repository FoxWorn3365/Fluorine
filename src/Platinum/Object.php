<?php
/**
 * --------------------------------
 *     PLATINUM PHP - File
 * --------------------------------
 * This file is under the MIT license.
 * 
 * (C) 2023-now FoxWorn3365
*/
namespace Platinum;
use Platinum\ClearObject;
use Platinum\NextArray;

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
            $this->foreach(function(string $key) {
                if ($key === $search) {
                    $this->elements->{$key} = NULL;
                }
            });
            return true;
        } elseif ($type === 'value') {
            $this->foreach(function(string $key, mixed $value) {
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
}