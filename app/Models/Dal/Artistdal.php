<?php

namespace App\Models\Dal;

use App\Models\Artistmodel;
use App\Libraries\Lastfm;

class Artistdal {
	
	public function search($value) {
		
		$lastfm = new Lastfm();
		
		$artistsReturned = $lastfm->getArtistDetails($value);
		
		$artistsParsed = [];

		if (!$artistsReturned)
			return $artistsParsed;
		
		unset($artistmodel);

		$artistmodel = new Artistmodel();
		$artistmodel->setName($artistsReturned->name);
		$artistmodel->setUrl($artistsReturned->url);
		$artistmodel->setImage($this->returnImageSite($artistsReturned->image));
		$artistmodel->setTags($artistsReturned->tags);
		
		$artistsParsed[] = $artistmodel;
		
		return $artistsParsed;
	}

	public function returnImageSite(array $arrayImage, $size = 'small'){
		foreach ($arrayImage as $value) {
			if($value->size==$size){
				return $value->{'#text'};
			}
		}
	}
}