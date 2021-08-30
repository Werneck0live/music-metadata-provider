<?php

namespace App\Controllers;

use App\Models\Artistmodel;

class Artist extends BaseController
{
	/*
	* TODO: Develop artist details API (append top 10 albums data)
	*/
	public function details($value) {
		// dd($value);

		// Do search
		$artistmodel = new Artistmodel();
		$result = $artistmodel->search((string) $value);
		
		// Parsed album to json
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