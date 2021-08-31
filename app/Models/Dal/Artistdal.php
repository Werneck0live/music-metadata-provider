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

		// foreach ($artistsReturned as $key => $value) {
		// 	echo '<pre>';var_dump($value);die();
		// }
		
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
	
	/*
		TODO: WERNECK
		Comentário sobre essa função "returnImageSite", já inserido
		no arquivo Albumdal.php.
	*/ 
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
			/*
				TODO: WERNECK - Questão 6
				Recebento o álbum mais popular e fazendo o tratamento da imagem,
				utilizando como padrão small, que é o valor default da função
			*/ 
			$allAlbuns = $lastfm->getTopAlbuns($artist->name, '1');
			$albuns = [];
			foreach ( $allAlbuns as $value) {
				$value->image = $this->returnImageSite($value->image);
				$albuns = $value;
			}
			$artistmodal->setTopAlbuns($albuns);
			
			$artistsParsed[] = $artistmodal;
		}
		
		return $artistsParsed;
	}
}