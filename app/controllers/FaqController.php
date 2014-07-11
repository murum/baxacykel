<?php

class FaqController extends BaseController {

    protected $layout = 'templates.layout.master';

    public function getIndex() {
        $faqs = Faq::all();
        
        $this->layout->content = View::make('faq.index')->with('faqs', $faqs);
    }

    public function getGuide() {        
        $this->layout->content = View::make('faq.guide');
    }

}