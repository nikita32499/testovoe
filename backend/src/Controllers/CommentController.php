<?php

namespace App\Controllers;


use App\Service\CaptchaService;
use App\Service\CommentService;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CommentController
{
    public static function add($request, $response) {
        $data = json_decode($request->getBody(), true);

        if (empty($data['name']) || empty($data['content'])) {
            $response->getBody()->write(json_encode([
                'error' => 'Не указано имя или тело сообщения'
            ]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }

        if (empty($data["captcha"]['id']) || empty($data["captcha"]['text'])) {
            $response->getBody()->write(json_encode([
                'error' => 'Нужно решить капчу'
            ]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }


        $success = CaptchaService::validate($data["captcha"]["id"],$data["captcha"]["text"]);
        if($success){ 
            $response->getBody()->write(json_encode([
                'error' => 'Не верная капча!!!'
            ]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }


        $comment = CommentService::add($data["name"],$data["content"]);



        $response->getBody()->write(json_encode($comment));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);

    }

    public static function delete($request, $response) {
        $data = json_decode($request->getBody(), true);


        CommentService::delete($data["id"]);
        
        return $response->withStatus(200);
    }



    public static function getAll($request, $response) {
        $comments = CommentService::getAll();
        
        
        $response->getBody()->write(json_encode($comments));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);

    }
} 