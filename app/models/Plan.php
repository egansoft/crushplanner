<?php

Class Plan extends Eloquent {
	public function user() {
		$this->belongsTo('User');
	}
	
	public function task() {
		$this->hasMany('Task');
	}
}

?>