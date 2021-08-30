<?php

namespace App\Models\Dal;

use App\Models\Artistmodel;
use App\Libraries\Lastfm;

class Artistdal {
	
	public function search($value) {
		
		$lastfm = new Lastfm();
		
		$artistsReturned = $lastfm->getDetails($value);
		
		$artistsParsed = [];

		if (!$artistsReturned)
			return $artistsParsed;

			
		foreach($artistsReturned as $artist) {
			
			foreach($artist as $projectArtist) {
				
				unset($artistmodel);
				
				$artistmodel = new Artistmodel();
				$artistmodel->setName($projectArtist->name);
				$artistmodel->setUrl($projectArtist->url);
				
				$artistsParsed[] = $artistmodel;
			}
		}
		
		return $artistsParsed;
	}

}