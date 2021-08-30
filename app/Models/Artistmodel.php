<?php

namespace App\Models;

use App\Models\Dal\Artistdal;

class Artistmodel {
	
	private $name;
	private $url;
	
	public function setName($name) {
		$this->name = $name;
	}

	
	public function setUrl($url) {
		$this->url = $url;
	}

	
	public function toArray() {
		return [
			'name'		=> $this->name,
			'url' 		=> $this->url,
		];
	}

	// Return an array of Artists or a empty array
	public function search($value) {
		// Access data access layer
		$artistdal = new Artistdal();
		// var_dump($artistdal->search($value));die();
		return $artistdal->search($value);
	}
}