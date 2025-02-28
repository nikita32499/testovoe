<?php

namespace App\Controllers;

use App\Models\Comment;
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


        $comment = new Comment($data["name"],$data["content"]);
         
        Comment::save($comment);



        $response->getBody()->write(json_encode($comment));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);

    }

    public static function delete($request, $response) {
        $data = json_decode($request->getBody(), true);



        Comment::delete($data["id"]);
        return $response->withStatus(200);
    }



    public static function getAll($request, $response) {
        $comments = Comment::all();
        
        
        $response->getBody()->write(json_encode($comments));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);

    }
} 