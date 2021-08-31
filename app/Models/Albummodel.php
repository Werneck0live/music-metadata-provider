<?php

namespace App\Models;

use App\Models\Dal\Albumdal;

class Albummodel {
	
	public $name;
	public $artist;
	public $url;
	public $cover;
	public $playcount;
	public $image;

	public function setName($name) {
		$this->name = $name;
	}

	public function setArtist($artist) {
		$this->artist = $artist;
	}

	public function setUrl($url) {
		$this->url = $url;
	}

	public function setCover($cover) {
		$this->cover = $cover;
	}

	public function setPlayCount($playcount) {
		$this->playcount = $playcount;
	}

	public function setimage($image) {
		$this->image = $image;
	}

	public function toArray() {
		return [
			'name'		=> $this->name,
			'artist' 	=> $this->artist,
			'url' 		=> $this->url,
			'cover' 	=> $this->cover,
			'playcount' 	=> $this->playcount,
			'image' 	=> $this->image,
		];
	}

	// Return an array of albums or a empty array
	public function search($value) {
		// Access data access layer
		$albumdal = new Albumdal();
		return $albumdal->search($value);
	}

	public function searchTopAlbuns($value='') {
		$albumdal = new Albumdal();
		
		return $albumdal->searchTopAlbuns($value);
	}
}