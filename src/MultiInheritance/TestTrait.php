<?php
/**
 * Created by cuongpm/modularization.
 * Date: 8/9/19
 * Time: 10:10 AM
 */

namespace Modularization\MultiInheritance;

use Illuminate\Support\Facades\DB;

trait TestTrait
{
    protected $model;
    protected $token;

    protected function getId()
    {
        return $this->model->value('id');
    }

    protected function getHeader($auth = true)
    {
        if(!$this->token) {
            $this->token = $this->getToken();
        }

        $header = [
            'Accept' => 'application/json',
        ];

        if($auth) {
            $header['Authorization'] = 'Bearer ' . $this->token;
        }

        return $header;
    }

    protected function getToken($username = null, $password = null)
    {
        if($username && $password) {
            $oauth_clients = $this->getOauthClient();
            if($oauth_clients) {
                return $this->cacheToken($username, $password, $oauth_clients->id, $oauth_clients->secret);
            }
        }

        return '';
    }

    private function cacheToken($username, $password, $client_id, $client_secret)
    {
        return cache()->remember('token', 999, function () use ($username, $password, $client_id, $client_secret) {
            $params = [
                "grant_type" => "password",
                "client_id" => $client_id,
                "client_secret" => $client_secret,
                "refresh_token" => "refresh-token",

                "username" => $username,
                "password" => $password
            ];

            $res = $this->post('/oauth/token', $params);

            return json_decode($res->content(), true)['access_token'];
        });
    }

    protected function getOauthClient()
    {
        return DB::table('oauth_clients')
            ->where('password_client', 1)
            ->first();
    }
}