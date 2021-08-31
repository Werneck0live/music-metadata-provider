<?php

namespace App\Controllers;

use App\Models\Artistmodel;
use App\Models\Albummodel;

class Artist extends BaseController
{
	/*
	* TODO: Develop artist details API (append top 10 albums data)
	*/
	public function details($value) {
		
		$artistmodel = new Artistmodel();
		$result = $artistmodel->search((string) $value);
		
		
		$parsedResult = [];
		
		$albummodel = new Albummodel();
		// $result = $albummodel->searchTopAlbuns((string) $value);
		
		if ($result && count($result) > 0) {			
			foreach ($result as $artistmodel) {;
				$artistmodel->top_albuns=$albummodel->searchTopAlbuns($value);
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