<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GithubService
{
    private $credentials = ['login', 'password'];

    /**
     * Check login and password for Auth
     * @param $login
     * @param $password
     *
     * @return array
     */
    public function checkAuth($login, $password)
    {
        $request = $this->getClient();
        try {
            $response = $request->get('/', ['auth' => [$login, $password]]);
        } catch (RequestException $e) {
            return [
                'success' => false,
                'response' => $e->getResponse()
            ];
        }

        return [
            'success' => true,
            'response' => $response->getBody()
        ];
    }


    /**
     * Get Issues from GitHub
     *
     * @return array
     */
    public function getIssues()
    {
        try {
            $response = $this->getClient()->get('/user/issues',[
                'auth'  =>  $this->getCredentials()
            ]);
        } catch (RequestException $e) {
            return [
                'success'   =>  false,
                'response'  =>  $e->getResponse()
            ];
        }

        return $response->getBody();
    }

    /**
     * Get Repositories from GitHub
     *
     * @return mixed
     * @throws \Exception
     * @throws \RequestException
     */
    public function getRepositories()
    {
        $request = $this->getClient();

        try {
            $response = $request->get('/user/repos', [
                'auth' => $this->getCredentials()
            ]);
        } catch (\RequestException $e) {
            throw $e;
        }

        return $response->getBody();
    }

    /**
     * Get instance of the Client class
     *
     * @return Client
     */
    private function getClient()
    {
        return new Client([
            'base_uri' => 'https://api.github.com'
        ]);
    }

    /**
     * Get credentials
     *
     * @return array
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Set credentials
     *
     * @param $login
     * @param $password
     */
    public function setCredentials($login, $password)
    {
        $this->credentials = [$login, $password];
    }

}