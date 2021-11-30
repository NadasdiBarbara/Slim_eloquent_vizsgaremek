<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Petrik\Vizsgaremek\VirtualisOrokbe;
use Petrik\Vizsgaremek\Macska;
use Petrik\Vizsgaremek\Admin;

return function(Slim\App $app){
    $app->get('/virtualis_orokbefogadas',function(Request $request,Response $response){
        $virtualis_orokbefogadas=VirtualisOrokbe::all();
        $kimenet= $virtualis_orokbefogadas->toJson();
        
        $response->getBody()->write($kimenet);
        return $response
            ->withHeader('Content-type','application/json');

    });

    $app->post('/virtualis_orokbefogadas',function(Request $request,Response $response){
        $input=json_decode($request-> getBody(),true);
        $virtualis=VirtualisOrokbe::create($input);
        
        $virtualis->save();

        $kimenet=$virtualis->toJson();

        $response->getBody()->write($kimenet);
        return $response
            ->withStatus(201)
            ->withHeader('Content-type','application/json');

    });

    $app->delete('/virtualis_orokbefogadas/{id}', function(Request $request,Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error ' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $virtualis = VirtualisOrokbe::find($args['id']);
        if ($virtualis === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-val örökbefogadás']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type','application/json')
                ->withStatus(404);
        }
        $virtualis->delete();
        return $response
            ->withStatus(204);
    });

    $app->put('/virtualis_orokbefogadas/{id}', function(Request $request,Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error ' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $virtualis = VirtualisOrokbe::find($args['id']);
        if ($virtualis === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-val örökbefogadás']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type','application/json')
                ->withStatus(404);
        }
        $input=json_decode($request->getBody(),true);
        $virtualis->fill($input);
        $virtualis->save();
        $response->getBody()->write($virtualis->toJson());
        return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(200);
    });

    $app->get('/virtualis_orokbefogadas/{id}', function(Request $request,Response $response, array $args){
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error ' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $virtualis = VirtualisOrokbe::find($args['id']);
        if ($virtualis === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-val örökbefogadás']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-type','application/json')
                ->withStatus(404);
        }
        $kimenet= $virtualis->toJson();
        
        $response->getBody()->write($kimenet);
        return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(200);
    });

    //------------------------------------Macska tábla---------------------------------------

    $app->get('/macska', function(Request $request, Response $response, array $args){
        $macska =Macska::all();
        $kimenet=$macska->toJson();
        
        $response->getBody()->write($kimenet);

        return $response->withHeader('Content-type','application/json');
    });

    $app->post('/macska', function(Request $request, Response $response){
        $input= json_decode($request->getBody(), true);

        $macskak =Macska::create($input);
        $macskak->save();
        
        $kimenet=$macskak->toJson();

        $response->getBody()->write($kimenet);
        return $response
            ->withStatus(201)
            ->withHeader('Content-type','application/json');
    });
    $app->delete('/macska/{id}',function(Request $request, Response $response, array $args){
    
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki =json_encode(['error' => "Az id pozitv egész számnak kell legyen!"]);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(400);
        }
        $macskak = Macska::find($args['id']);
        if ($macskak === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű macska']);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(404);
        }
        $macskak->delete();
        return $response
        
            ->withStatus(204);
    });

    $app->put('/macska/{id}', function(Request $request, Response $response, array $args){

        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki =json_encode(['error' => "Az id pozitv egész számnak kell legyen!"]);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(400);
        }
        $macskak = Macska::find($args['id']);
        if ($macskak === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű macska']);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(404);
        }
        $input = json_decode($request->getBody(), true);
        $macskak->fill($input);
        $macskak->save();
        $response->getBody()->write($macskak->toJson());
        return $response
        ->withHeader('Content-type','application/json')
        ->withStatus(200);

    });
    $app->get('/macska/{id}', function(Request $request, Response $response, array $args){
        
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki =json_encode(['error' => "Az id pozitv egész számnak kell legyen!"]);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(400);
        }
        $macskak = Macska::find($args['id']);
        if ($macskak === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű macska']);
            $response->getBody()->write($ki);
            return $response
            ->withHeader('Content-type','application/json')
            ->withStatus(404);
        }
        $response->getBody()->write($macskak->toJson());
        return $response
        ->withHeader('Content-type','application/json')
        ->withStatus(200);
    });
    //---------------------------------------Admin------------------------------------

    $app->get('/admin', function(Request $request, Response $response, $args){
        $admin = Admin::all();
        $kimenet=$admin->toJson();

        $response->getBody()->write($kimenet);
        return $response->withHeader('Content-type', 'application/json'); 
        });

    $app->post('/admin', function(Request $request, Response $response, $args){
            $input = json_decode($request->getBody(),true);
            //Bemenet validáció
            $admin=Admin::create($input);
            $admin->save();
            $kimenet= $admin->toJson();
            $response->getBody()->write($kimenet);
            return $response
                ->withStatus(201)
                ->withHeader('Content-type', 'application/json');
        });

    $app->delete('/admin/{id}',function(Request $request, Response $response, $args){
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
               $ki=json_encode(['error'=>'Az ID potizv egész számnak kell lennie!']);
               $response->getBody()->write($ki);
               return $response
                    ->withHeader('Content-type', 'application/json')
                    ->withStatus(400);
            }
            $admin=Admin::find($args['id']);
            if ($admin===null) {
                $ki=json_encode(['error'=>'Nincs ilyen ID-jű admin!']);
                $response->getBody()->write($ki);
               return $response
                    ->withHeader('Content-type', 'application/json')
                    ->withStatus(404);
            }
            $admin->delete();
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(204);
        });

    $app->put('/admin/{id}', function(Request $request, Response $response, $args){
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki=json_encode(['error'=>'Az ID potizv egész számnak kell lennie!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-type', 'application/json')
                    ->withStatus(400);
            }
            $admin=Admin::find($args['id']);
            if ($admin===null) {
                $ki=json_encode(['error'=>'Nincs ilyen ID-jű admin!']);
                $response->getBody()->write($ki);
            return $response
                    ->withHeader('Content-type', 'application/json')
                    ->withStatus(404);
            }
            $input = json_decode($request->getBody(),true);
            $admin->fill($input);
            $admin->save();
            $response->getBody()->write($admin->toJson());
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);
        });

    $app->get('/admin/{id}', function(Request $request, Response $response, $args){
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki =json_encode(['error' => "Az id pozitv egész számnak kell legyen!"]);
                $response->getBody()->write($ki);
                return $response
                ->withHeader('Content-type','application/json')
                ->withStatus(400);
            }
            $admin = Admin::find($args['id']);
            if ($admin === null) {
                $ki = json_encode(['error' => 'Nincs ilyen ID-jű admin']);
                $response->getBody()->write($ki);
                return $response
                ->withHeader('Content-type','application/json')
                ->withStatus(404);
            }
            $response->getBody()->write($admin->toJson());
            return $response
                ->withHeader('Content-type','application/json')
                ->withStatus(200);
        });
};