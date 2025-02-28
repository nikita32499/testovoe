<?php

namespace App\Controllers;

use App\Models\Comment;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CommentController
{
    

    public function add($request, $response) {
        $data = json_decode($request->getBody(), true);
        $content = $data['content'];
        Comment::save($content);
        return $response->withStatus(201);
    }

    public function delete($request, $response, $args) {
        $id = $args['id'];
        Comment::delete($id);
        return $response->withStatus(204);
    }

    public function get($request, $response, $args) {
        $id = $args['id'];
        $comment = Comment::find($id);
        if ($comment) {
            return $response->withJson($comment, 200);
        }
        return $response->withStatus(404);
    }

    public function getAll($request, $response) {
        $comments = Comment::all(); // Assuming Comment::all() retrieves all comments
        return $response->withJson($comments, 200);
    }
} 