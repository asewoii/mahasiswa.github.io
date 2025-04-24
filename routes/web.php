<?php

$router->get('/', function () use ($router) {
    return redirect('plus_mahasiswa.php');
});

$router->get('/mahasiswa', 'Control_Mahasiswa@index');
$router->get('/mahasiswa/{$id}', 'Control_Mahasiswa@show');
$router->post('/mahasiswa', 'Control_Mahasiswa@create');
$router->put('/mahasiswa/{$id}', 'Control_Mahasiswa@update');
$router->delete('/mahasiswa/{$id}', 'Control_Mahasiswa@delete');
