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
		$artistmodel->setTopAlbuns($lastfm->getTopAlbuns($artistsReturned->name, '10'));
		
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
	
	public function listTopArtists(){

		$lastfm = new Lastfm();		
		
		$artistsReturned = $lastfm->getTopArtists('5');
		
		$artistsParsed = [];

		if (!$artistsReturned)
			return $artistsParsed;
			
		foreach($artistsReturned as $artist) {
			unset($artistmodel);
			
			$artistmodal = new Artistmodel();
			$artistmodal->setName($artist->name);
			$artistmodal->setUrl($artist->url);
			$artistmodal->setImage($this->returnImageSite($artist->image));
			$artistmodal->setTopAlbuns($lastfm->getTopAlbuns($artist->name, '5'));
			
			
			$artistsParsed[] = $artistmodal;
		}
		
		// echo '<pre>';var_dump($artistsParsed);die();
		
		return $artistsParsed;
	}
}