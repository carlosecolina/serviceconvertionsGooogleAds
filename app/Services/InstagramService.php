<?php

namespace App\Services;

use App\Models\General;
use GuzzleHttp\Client;

class InstagramService
{
    protected $client;
    protected $accessToken;

    public function __construct()
    {
        $general = General::find(1);

        $this->client = new Client();
        $this->accessToken = $general->ig_token;
    }

    public function getUserMedia()
    {
        return [];
        $url = "https://graph.instagram.com/me/media";
        $params = [
            'fields' => 'id,caption,media_type,media_url,thumbnail_url,permalink',
            'access_token' => $this->accessToken
        ];

        try {
            $response = $this->client->get($url, ['query' => $params]);
            $body = $response->getBody();
            $data = json_decode($body, true);

            return $data['data'];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Log the detailed error message from Instagram API
            error_log($e->getResponse()->getBody()->getContents());
            return []; // Or handle the error as appropriate for your application
        }
    }
}
