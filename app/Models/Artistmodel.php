<?php

namespace App\Models;

use App\Models\Dal\Artistdal;

class Artistmodel {
	
	private $name;
	private $url;
	private $image;
	private $tags;
	private $top_albuns;

	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function setUrl($url) {
		$this->url = $url;
	}
	
	public function setImage($image) {
		$this->image = $image;
	}
	public function setTags($tags) {
		$this->tags = $tags;
	}
	public function setTopAlbuns($top_albuns) {
		$this->top_albuns = $top_albuns;
	}
	
	public function toArray() {
		return [
			'name'			=> $this->name,
			'url' 			=> $this->url,
			'image'			=> $this->image,
			'tags'			=> $this->tags,
			'top_albuns'	=> $this->top_albuns,
		];
	}

	public function search($value) {		
		$artistdal = new Artistdal();
		return $artistdal->search($value);
	}
	
	public function topArtists() {
		$artistdal = new Artistdal();
		return $artistdal->listTopArtists();	
	}
}