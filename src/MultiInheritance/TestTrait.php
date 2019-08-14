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
    protected $username, $password, $provider;

    protected function getId()
    {
        return $this->model->value('id');
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    protected function getHeader($auth = true)
    {
        if (!$this->token) {
            $this->token = $this->getToken();
        }

        $header = [
            'Accept' => 'application/json',
        ];

        if ($auth) {
            $header['Authorization'] = 'Bearer ' . $this->token;
        }

        return $header;
    }

    protected function getToken()
    {
        if ($this->username && $this->password) {
            $oauth_clients = $this->getOauthClient();

            if ($oauth_clients) {
                return $this->cacheToken($oauth_clients->id, $oauth_clients->secret);
            }
        }

        return '';
    }

    private function cacheToken($client_id, $client_secret)
    {
//        return cache()->remember('token', 0, function () use ($client_id, $client_secret) {
        $params = [
            "grant_type" => "password",
            "client_id" => $client_id,
            "client_secret" => $client_secret,
            "provider" => $this->provider,
            "username" => $this->username,
            "password" => $this->password
        ];

        $res = $this->post('/oauth/token', $params);

        return json_decode($res->content(), true)['access_token'];
//        });
    }

    protected function getOauthClient()
    {
        return DB::table('oauth_clients')
            ->where('password_client', 1)
            ->first();
    }
}