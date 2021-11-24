<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Petrik\Rajzfilmek\Rajzfilm;

return function(Slim\App $app){
    $app->get('/rajzfilmek',function(Request $request,Response $response){
        $rajzfilmek=Rajzfilm::all();
        $kimenet= $rajzfilmek->toJson();
        
        $response->getBody()->write($kimenet);
        return $response
            ->withHeader('Content-type','application/json');

    });

    $app->post('/rajzfilmek',function(Request $request,Response $response){
        $input=json_decode($request-> getBody(),true);
        $rajzfilm=Rajzfilm::create($input);
        
        $rajzfilm->save();

        $kimenet=$rajzfilm->toJson();

        $response->getBody()->write($kimenet);
        return $response
            ->withStatus(201)
            ->withHeader('Content-type','application/json');

    });

    $app->delete('/rajzfilmek/{id}', function(Request $request,Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error ' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $rajzfilm = Rajzfilm::find($args['id']);
        if ($rajzfilm === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-val rajzfilm']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type','application/json')
                ->withStatus(404);
        }
        $rajzfilm->delete();
        return $response
            ->withStatus(204);
    });
};