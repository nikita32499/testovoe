<?php



use Slim\Routing\RouteCollectorProxy;
use App\Controllers\CommentController;
use App\Controllers\CaptchaController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->group('/comments', function (RouteCollectorProxy $group) {
    $group->get('/getAll', function (Request $request, Response $response) {
        return CommentController::getAll($request, $response);
         
    });

    $group->post('/add', function (Request $request, Response $response) {
        return CommentController::add($request, $response);
         
    });

    $group->delete('/', function (Request $request, Response $response) {
        return CommentController::delete($request, $response);
         
    });
});


$app->group('/captcha', function (RouteCollectorProxy $group) {
    $group->get('/create', function (Request $request, Response $response) {
        return CaptchaController::create($request, $response);
    });

    $group->post('/validate', function (Request $request, Response $response) {
        return CaptchaController::validate($request, $response);
    });

   
});