<?php

class CategoryController extends BaseController {

    protected $layout = 'templates.layout.master';

    public function getIndex() {
        $categories = Category::all();
        
        $this->layout->content = View::make('forums.index')->with('categories', $categories);
    }

}