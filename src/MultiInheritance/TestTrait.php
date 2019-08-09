<?php
/**
 * Created by PhpStorm.
 * Date: 8/9/19
 * Time: 10:10 AM
 */

namespace Modularization\src\MultiInheritance;


use Illuminate\Support\Facades\DB;

trait TestTrait
{
    protected $model;
    protected $token;

    protected function getId()
    {
        return $this->model->value('id');
    }

    protected function getHeader()
    {
        if(!$this->token) {
            $this->token = $this->getToken();
        }

        return [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ];
    }

    protected function getToken()
    {
        $oauth_clients = $this->getOauthClient();

        $params = [
            "grant_type" => "password",
            "client_id" => $oauth_clients->id,
            "client_secret" => $oauth_clients->secret,
            "refresh_token" => "refresh-token",

            "username" => 'i.am.m.cuong@gmail.com',
            "password" => "123123"
        ];

        $res = $this->post('/oauth/token', $params);

        return json_decode($res->content(), true)['access_token'];
    }

    protected function getOauthClient()
    {
        return DB::table('oauth_clients')
            ->where('password_client', 1)
            ->first();
    }
}