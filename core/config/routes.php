<?php

/** @var FastRoute\RouteCollector  $router */
/** @var modX  $modx */

$router->get('api/pages/{id}', [Zoomx\Controllers\Api\Pages\GetController::class]);
$router->post('api/pages/', [Zoomx\Controllers\Api\Pages\CreateController::class]);
$router->put('api/pages/{id}', [Zoomx\Controllers\Api\Pages\UpdateController::class]);
$router->delete('api/pages/{id}', [Zoomx\Controllers\Api\Pages\DeleteController::class]);
