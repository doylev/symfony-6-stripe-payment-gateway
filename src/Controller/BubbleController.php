<?php

namespace App\Controller;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BubbleController
{

    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getAllUsers(): array
    {
        try {
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
            $content = $response->toArray();
            return $content;
//            dd("Content is -> " . $content);
        } catch (TransportExceptionInterface $e) {
            dd("Error occurred " . $e);
        }
    }

    public function getSalesById(string $Id): array
    {
        $url = 'https://www.lifesafelegacy.net/version-test/api/1.1/obj/sales/'.$Id;
        try {
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
            $content = $response->toArray()["response"];
//            dd("Content is -> " . $response->getContent(true));
            return $content;
        } catch (TransportExceptionInterface $e) {
            dd("Error occurred " . $e);
        }
    }
    public function getSubscriberById(string $Id): array
    {
        $url = 'https://www.lifesafelegacy.net/version-test/api/1.1/obj/usersubscriber/'.$Id;
        try {
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
            $content = $response->toArray()["response"];
//            dd("Content is -> " . $response->getContent(true));
            return $content;
        } catch (TransportExceptionInterface $e) {
            dd("Error occurred " . $e);
        }
    }
} // end of BubbleController