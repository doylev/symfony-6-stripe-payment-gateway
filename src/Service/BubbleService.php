<?php

namespace App\Service;

use Monolog\Logger;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BubbleService
{

    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getAllUsers(): array
    {
        $response = $this->client->request(
            'GET',
            'https://www.lifesafelegacy.net/version-test/api/1.1/obj/user',
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer 7efd69af3bfc7c74b69e28f220b0a50f'
                ],
            ]
        );
        return $response->toArray()["response"];
    }

    public function getSalesById(string $Id): array
    {
        $url = 'https://www.lifesafelegacy.net/version-test/api/1.1/obj/sales/' . $Id;
        $response = $this->client->request(
            'GET',
            $url,
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer 7efd69af3bfc7c74b69e28f220b0a50f'
                ],
            ]
        );
        return $response->toArray()["response"];
    }

    public function getSubscriberById(string $Id): array
    {
        $url = 'https://www.lifesafelegacy.net/version-test/api/1.1/obj/usersubscriber/' . $Id;
        $response = $this->client->request(
            'GET',
            $url,
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer 7efd69af3bfc7c74b69e28f220b0a50f'
                ],
            ]
        );
        return $response->toArray()["response"];
    }
}