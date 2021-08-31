<?php

namespace App\Models\Dal;

use App\Models\Albummodel;
use App\Libraries\Lastfm;

class Albumdal {
	
	public function search($value) {

		/*
			TODO: WERNECK - Questão 7
			Poderia realizar o tratamento dos espaços, utilizando
			preg_replace e expressão regular com regex. Como foi testado
			que a função "rawurlencode" trata este tipo de situação, foi inserido na
			Librery Lastfm.php, onde pude realizra os testes normalmente
		*/

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
			
			/*
				TODO: WERNECK - Questão 4
			   Foi criada a função returnImageSite para tratar o tamanho padrão 
			   para o retorno da imagem. Por default, a função utiliza o valor "small".

			   O intuito, é quando a função for chamada, basta informar o tamanho desejado
			   como segundo parâmetro, para utilizar este tamanho desejado.

			   A função também é chamada em Artstdal.php, por isso, o ideal seria colocar
			   essa função em um util.php para ambos ou mais (futuros), chamassem de um
			   único local e com a governança correta.
			*/
			$albummodel->setCover($this->returnImageSite($album->image));

			$albumsParsed[] = $albummodel;

			/*
				TODO: WERNECK - Questão 2
			  Por causa do break, está sendo pausado o fluxo 
			  do foreach e por isso está passando somente um resultado
			*/

			// break;
			
		}


		return $albumsParsed;
	}

	public function searchTopAlbuns($value) {
		$lastfm = new Lastfm();
		/*
			TODO: WERNECK - Questão 5
			Foi criada uma nova função para listagem de top Albuns.
			Desejável que fosse criado um crud de configuração 
			ou uma configuração no .env para receber o número correto 
			para o limit de registros a serem listados
		*/

		$albumsReturned = $lastfm->getTopAlbuns($value);
		
		foreach($albumsReturned as $album) {
			
			unset($albummodel);
			
			$albummodel = new Albummodel();
			$albummodel->setName($album->name);
			$albummodel->setUrl($album->url);
			$albummodel->setArtist($album->artist->name);
			$albummodel->setPlaycount($album->playcount);
			$albummodel->setImage($this->returnImageSite($album->image));
			
			$albumsParsed[] = $albummodel;
		}
		
		return $albumsParsed;
		
	}
	
	public function returnImageSite(array $arrayImage, $size = 'small'){
		foreach ($arrayImage as $value) {
			if($value->size==$size){
				return $value->{'#text'};
			}
		}
	}
}