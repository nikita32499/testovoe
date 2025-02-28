<?php



use Slim\Routing\RouteCollectorProxy;
use App\Controllers\CommentController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->group('/comments', function (RouteCollectorProxy $group) {
    $group->get('/getAll', function (Request $request, Response $response) {
        return CommentController::getAll($request, $response);
        // return $response;
    });
});