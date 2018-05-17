<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyBase {

    Protected $departments_array = [];

    public function all() {
        return $this->departments_array;
    }

    public function get($id) {
        return $this->departments_array[$id];
    }

}
