<?php

namespace App\Models\Dal;

use App\Models\Albummodel;
use App\Libraries\Lastfm;

class Albumdal {
	
	public function search($value) {

		$lastfm = new Lastfm();
		$albumsReturned = $lastfm->searchAlbum($value);

		$albumsParsed = [];

		if (!$albumsReturned)
			return $albumsParsed;

		foreach($albumsReturned as $album) {

			unset($albummodel);
			
			$albummodel = new Albummodel();
			$albummodel->setName($album->name);
			$albummodel->setArtist($album->artist);
			$albummodel->setUrl($album->url);
			//$albummodel->setCover($album->image);

			$albumsParsed[] = $albummodel;

			break;
		}

		return $albumsParsed;
	}

}