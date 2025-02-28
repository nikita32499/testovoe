<?php

use Slim\Routing\RouteCollectorProxy;



$app->group('/comments', function (RouteCollectorProxy $group) {
    $group->get('/getAll', 'CommentController:getAll');
    $group->post('/{imageId}', 'CommentController:create');
});

// $app->post('/comments', [CommentController::class, 'addComment']);

// $app->delete('/comments/{id}', [CommentController::class, 'deleteComment']); 