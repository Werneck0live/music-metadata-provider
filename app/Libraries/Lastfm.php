<?php

namespace App\Libraries;

class Lastfm 
{
	// TODO: Generate custom api key for Last.fm API
	// private $apiKey = '0592ad31249201dd89c250fa7062af4a';

	/*
		TODO: WERNECK
		Substituicao da ApiKey para api do candidato Werneck Oliveira
	*/ 
	private $apiKey = '21fbf6b46882e68e78ad6857b4092898';
	private $endpoint = 'https://ws.audioscrobbler.com/2.0/?';
	private $format = 'json';

	private function getBaseUrl() {
		return $this->endpoint . 
			'api_key=' . $this->apiKey . 
			'&format=' . $this->format . 
			'&';
	}

	// TODO: Customize method to search for multiple words
	public function searchAlbum($value) {
		/*
			TODO: WERNECK - Questão 2
			Por causa do limit 1, está sendo limitado 1 resultado somente. 
			O ideal, é criar uma constante, recebendo a configuração de um limite
			padrão ou algo semelhante a regra de negócio do projeto.
		*/
		// $url = $this->getBaseUrl() . "method=album.search&album=$value&limit=1";
		$url = $this->getBaseUrl() . "method=album.search&album=$value";

		$client = \Config\Services::curlrequest();

		$response = $client->request('GET', $url);
		$responseArray = json_decode($response->getBody());

		$responseParsed = [];

		if (!$responseArray || 
			!$responseArray->results ||
			!$responseArray->results->albummatches || 
			!$responseArray->results->albummatches->album)
			return $responseParsed;

		$responseParsed = $responseArray->results->albummatches->album;

		return $responseParsed;
	}	

	public function getArtistDetails($value) {
		$url = $this->getBaseUrl() . "method=artist.getinfo&artist=$value";
		$client = \Config\Services::curlrequest();
		
		$response = $client->request('GET', $url);
		$responseArray = json_decode($response->getBody());		
		$responseParsed = [];

		if (!$responseArray || 
			!$responseArray->artist )
			return $responseParsed;

		$responseParsed = $responseArray->artist;

		return $responseParsed;
	}
	
	public function getTopAlbuns($value, $limit='') {
		
		$limit = ($limit!='') ? 'limit='.$limit : '';
		$url = $this->getBaseUrl() . "method=artist.gettopalbums&artist=".urlencode($value)."&$limit";
		$client = \Config\Services::curlrequest();
		
		$response = $client->request('GET', $url);
		$responseArray = json_decode($response->getBody());
		$responseParsed = [];

		if (!$responseArray || 
			!$responseArray->topalbums ||
			!$responseArray->topalbums->album )
			return $responseParsed;

		$responseParsed = $responseArray->topalbums->album;

		return $responseParsed;
	}

	public function getTopArtists($limit=''){
		$limit = ($limit!='') ? 'limit='.$limit : '';
		$url = $this->getBaseUrl() . "method=chart.gettopartists&$limit";
		

		$client = \Config\Services::curlrequest();

		$response = $client->request('GET', $url);
		$responseArray = json_decode($response->getBody());

		$responseParsed = [];

		if (!$responseArray || 
			!$responseArray->artists ||
			!$responseArray->artists->artist )
			return $responseParsed;

		$responseParsed = $responseArray->artists->artist;

		return $responseParsed;
	}
}