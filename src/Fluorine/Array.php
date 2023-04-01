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
use Fluorine\NextObject;

class NextArray {
    protected object|NULL|array $elements;
    protected self|null $backup;
    public int $count = 0;

    function __construct(NextArray|array $element = NULL) {
        $this->elements = new ClearObject();

        if ($element !== NULL) {
            $this->internalImport($element);
        }
    }

    public function __invoke(int $count) {
        return $this->elements->{$count};
    }

    public function elements() : object {
        return $this->elements;
    }

    public function new(array $array) : NextArray {
        return new NextArray($array);
    }

    public function values() : array {
        $val = [];
        foreach ($this->elements as $values) {
            array_push($val, $values);
        };
        return $val;
    }

    public function arraycount() : int {
        return count((array)$this->elements);
    }

    public function count() : int {
        $counter = 0;
        foreach ($this->elements as $v) {
            $v = NULL;
            $counter++;
        }
        return $counter;
    }

    public function end() : mixed {
        return $this->elements->{$this->count-1};
    }

    public function add(mixed $element) : self {
        $this->elements->{$this->count} = $element;
        $this->count++;
        return $this;
    }

    public function foreach(callable $callback) : void {
        foreach ($this->elements as $value) {
            $callback($value);
        }
    }

    protected function completeForeach(callable $callback, int $startfrom = 0) : void {
        foreach ($this->elements as $key => $value) {
            if ($key < $startfrom) {
                continue;
            } else {
                $callback($key, $value);
            }
        }
    }

    public function rand() : mixed {
        return $this->elements->{rand(0, $this->count-1)};
    }

    public function clear() : self {
        $this->completeForeach(function (int $key, mixed $value) {
            if ($value === NULL) {
                unset($this->elements->{$key});
            }
        });
        return $this;
    }

    public function remove(mixed $element, bool $shift = true) : self {
        $this->completeForeach(function (int $key, mixed $value) use ($shift, $element) {
            if ($value === $element) {
                // unset($this->elements->{$key});
                $this->elements->{$key} = NULL;
                $this->count--;

                if ($shift) {
                    $this->completeForeach(function (int $key, mixed $value) {
                        $this->elements->{$key-1} = $this->elements->{$key};
                        // unset($this->elements->{$key});
                        $this->elements->{$key} = NULL;
                    }, $key+1);
                    $this->clear();
                }
            } 
        });
        return $this;
    }

    protected function internalImport(NextArray|array $element) : void {
        if ($element instanceof NextArray) {
            $element->foreach(function (mixed $value) {
                $this->add($value);
            });
        } else {
            foreach ($element as $value) {
                $this->add($value);
            }
        }
    }

    public function set(int $offset, mixed $value) : self {
        $this->elements->{$offset} = $value;
        return $this;
    }
    
    public function clone() : NextArray {
        return new NextArray($this->values());
    }

    public function chunk(int $lenght, bool $backup = false) : self {
        if ($backup) {
            $this->backup = NULL;
            $this->backup = $this;
        }
        $elements = $this->elements;
        $this->elements = NULL;
        $counter = 1;
        foreach ($elements as $value) {
            if ($counter != $lenght) {
                $el = new NextArray();
                $el->add($value);
                $counter++;
            } elseif ($counter == $lenght) {
                $el->add($value);
                $this->add($el);
                $counter = 1;
            }
        }
        return $this;
    }

    public function diff(NextArray|array $object) : NextArray {
        if ($object instanceof NextArray) {
            $values = $object->values();
        } else {
            $values = $object;
        }

        $el = new NextArray();

        $this->foreach(function (mixed $value) use ($el, $values) {
            if (!in_array($value, $values)) {
                $el->add($value);
            }
        });

        return $el;
    }

    public function push(mixed $value) : self {
        $this->add($value);
        return $this;
    }

    private function toArray() : void {
        $this->elements = (array)$this->elements;
    }

    private function toObject() : void {
        $this->elements = (object)$this->elements;
    }

    public function sort() : self {
        $this->toArray();
        sort($this->elements);
        $this->toObject();
        return $this;
    }

    public function asort() : self {
        $this->toArray();
        asort($this->elements);
        $this->toObject();
        return $this;
    }

    private function importValues(NextArray|array $object) : array {
        if ($object instanceof NextArray) {
            return $object->values();
        } else {
            return $object;
        }
    }

    public function join(NextArray|array $object) : self {
        $this->internalImport($object);
        return $this;
    }

    public function have(string $value) : bool {
        foreach ($this->elements as $element) {
            if ($element == $value) {
                return true;
            }
        }
        return false;
    }

    public function compare(NextArray|array $term) : int {
        $counter = 0;
        $array = $this->importValues($term);
        foreach ($array as $value) {
            if ($this->have($value)) {
                $counter++;
            }
        }
        return $counter;
    }

    public function find(string $value) : int {
        $counter = 0;
        foreach ($this->elements as $key => $val) {
            if ($value === $val) {
                return $counter;
            }
            $counter++;
        }
        return $counter;
    }

    public function __toArray() {
        return (array)$this->elements;
    }

    public function random() : mixed {
        return $this->elements->{rand(0, $this->count)};
    }

    public function implode(string $glue) : NextString|string {
        return new NextString(implode($glue, (array)$this->elements));
    }

    public function equal(NextArray $array) : NextArray {
        $el = new NextArray();
        foreach ($this->elements as $element) {
            if ($array->have($element)) {
                $el->add($element);
            }
        }
        return $el;
    }

    public function dump() : void {
        var_dump($this->values());
    }

    public function crop(int $pos) : self {
        $count = 0;
        $self = new ClearObject;
        foreach ($this->elements as $element) {
            if ($count < $pos) {
                $self->{$count} = $element;
            } else {
                break;
            }
            $count++;
        }
        $this->elements = $self;
        $this->count = $count;
        return $this;
    }
}