<?php


namespace Views;

abstract class Base {
    public $f3;
    public $data = [];

    public function __construct() {
        $f3 = \Base::instance();
        $this->f3 = $f3;
    }

    public function render(): string|false|null {
        if (!is_array($this->data)) {
            $this->data = [];
        }

        return null;
    }
}
