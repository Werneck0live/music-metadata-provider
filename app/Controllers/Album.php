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
		/* 
			TODO: Werneck
			O ideial fosse tratar o input com uma ferramento do framework
			como middleware e entre outros. Devida a tempo a falta de tempo hábil
			para desenvolver todas a funcionalidades, foi feita uma forma mais procedural
			com o código abaixo:
		*/
		if((!isset($value) || trim($value)=='""' || trim($value)=='\'\'')){			
			/*
				O desejável fosse isoltar o este response em uma função separada,
				E somente enviar os parâmetros(constantes) desejáveis, devido à
				boas práticas de programação, repetir trecho de código.
			*/ 
			$this->response->setStatusCode(400);
			return $this->response->setJSON([ 
				'success' 	=> true, 
				'code' 		=> HTTP_CODE_PARAM_ERROR, 
				'result' 	=> 'O campo de busca não pode estar vazio'
			]);
		}

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

	public function searchTopAlbuns($value)
	{
		$albummodel = new Albummodel();
		$result = $albummodel->searchTopAlbuns((string) $value);
	}
}