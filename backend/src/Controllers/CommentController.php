<?php

namespace App\Controllers;

use App\Models\Comment;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CommentController
{
    public static function add($request, $response) {
        $data = json_decode($request->getBody(), true);
        $comment = new Comment();
        $comment->setName($data['name']);
        $comment->setContent($data['content']);
        Comment::save($comment);
        
        return $response->withStatus(201);
    }

    public static function delete($request, $response, $args) {
        $id = $args['id'];
        Comment::delete($id);
        return $response->withStatus(204);
    }

    public static function get($request, $response, $args) {
        $id = $args['id'];
        $comment = Comment::find($id);
        if ($comment) {
            return $response->withJson([
                'id' => $comment->getId(),
                'name' => $comment->getName(),
                'content' => $comment->getContent(),
                'createdAt' => $comment->getCreatedAt()
            ], 200);
        }
        return $response->withStatus(404);
    }

    public static function getAll($request, $response) {
        $comments = Comment::all();
        $result = array_map(function($comment) {
            return [
                'id' => $comment->getId(),
                'name' => $comment->getName(),
                'content' => $comment->getContent(),
                'createdAt' => $comment->getCreatedAt()
            ];
        }, $comments);
        
        return $response->withJson($result, 200);

        // return 100;
    }
} 