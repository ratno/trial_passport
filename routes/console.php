<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('token',function(){
    $client = new GuzzleHttp\Client();
    $this->info("Lets get new Access Token");
    $res = $client->request('POST', 'http://localhost:8000/oauth/token', [
        'form_params' => [
            'client_id' => '2',
            'client_secret' => 'H3HNDkZ2gWh13tZ4z0xwThecfW37m7NIhRULf3mY',
            'username' => 'ratno@me.com',
            'password' => '123123',
            'scope' => '*',
            'grant_type' => 'password'
        ]
    ]);

    $data = json_decode($res->getBody(),true);
    $this->info("Access Token: ". substr($data['access_token'],0,10) . "..." . substr($data['access_token'],-10));
    $this->info("Refresh Token: ". substr($data['refresh_token'],0,10) . "..." . substr($data['refresh_token'],-10));

    $this->warn("Lets get Refresh Token");
    $res = $client->request('POST', 'http://localhost:8000/oauth/token', [
        'form_params' => [
            'client_id' => '2',
            'client_secret' => 'H3HNDkZ2gWh13tZ4z0xwThecfW37m7NIhRULf3mY',
            'refresh_token' => $data['refresh_token'],
            'scope' => '*',
            'grant_type' => 'refresh_token'
        ]
    ]);
    $data = json_decode($res->getBody(),true);
    $this->warn("Access Token: ". substr($data['access_token'],0,10) . "..." . substr($data['access_token'],-10));
    $this->warn("Refresh Token: ". substr($data['refresh_token'],0,10) . "..." . substr($data['refresh_token'],-10));
})->describe('Try to get new access token');