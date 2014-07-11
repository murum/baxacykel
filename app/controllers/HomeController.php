<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends BaseController {

	protected $layout = 'templates.layout.master';

	public function getIndex()
	{
		$this->layout->content = View::make('static.index');
	}

	public function getDevbug()
	{
		$this->layout->content = View::make('static.devbug');
	}

	public function getChangelog()
	{
		$this->layout->content = View::make('static.changelog');
	}
}