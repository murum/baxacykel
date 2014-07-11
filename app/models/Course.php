<?php

class Course extends Eloquent {
	protected $table = 'courses';	

	public function attribute()
	{
		return $this->belongsTo('Attribute');
	}

	// Custom functions
	public function cooldownHours() {
		return $this->cooldown / 3600;
	}

	public function getCourseAttribute() {
		return $this->attribute()->first()->name;
	}
}