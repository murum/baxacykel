<?php

class Category extends Eloquent {
    protected $table = 'categories';

    public function threads() {
        return $this->hasMany('Thread');
    }

}