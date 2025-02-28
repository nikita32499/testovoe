<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Service\CaptchaService;

class CaptchaController
{


	
    public static function create($request, $response) {
			$output = CaptchaService::createImage();


			 
			
			 
    
			 
			$response = $response->withHeader('Content-Type', 'application/json');
    $response->getBody()->write(json_encode($output));
    return $response;
		}

		

		 
		 

			


		 
		 
		 
		 
		 
		 
			
		 
} 