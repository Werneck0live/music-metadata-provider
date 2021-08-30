<?php

namespace App\Controllers;

use App\Models\Albummodel;

class Album extends BaseController
{
	/*
	* TODO: Validate value param and return HTTP_CODE_PARAM_ERROR code on error
	* TODO: Album cover is returning null
	*/
	public function search($value)
	{

		// Do search
		$albummodel = new Albummodel();
		$result = $albummodel->search((string) $value);

		// Parsed album to json
		$parsedResult = [];

		if ($result && count($result) > 0) {
			foreach ($result as $albummodel) {
				$parsedResult[] = $albummodel->toArray();
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