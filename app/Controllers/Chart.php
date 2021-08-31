<?php

namespace App\Controllers;

use App\Models\Artistmodel;

class Chart extends BaseController
{
	/*
	* TODO: Return top 5 artists and embed top 1 album of each one
	* TODO: Generate a 1h cache of this response
	*/
	public function top() {
		$artists = new Artistmodel();
		$result = $artists->topArtists();

		$parsedResult = [];
		
		if ($result && count($result) > 0) {			
			foreach ($result as $artistmodel) {
				$parsedResult[] = $artistmodel->toArray();
			}
		}
		// Response
		$this->response->setStatusCode(200);
		return $this->response->setJSON([ 
			'success' 	=> true, 
			'code' 		=> HTTP_CODE_OK, 
			'result' 	=> $parsedResult
		]);
	}
}