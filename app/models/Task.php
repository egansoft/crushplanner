<?php

class Task extends Eloquent {
	public function plan() {
		$this->belongsTo('Plan');
	}
}

?>