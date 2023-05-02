<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;

class RanksApiService
{
    private $client;

    public function __construct()
    {
        $this->client = HttpClient::create();
    }

    public function getCompetitiveTiers()
    {
        $response = $this->client->request('GET', 'https://valorant-api.com/v1/competitivetiers');

        $statusCode = $response->getStatusCode();

        if ($statusCode === 200) {
            $content = $response->getContent();
            $data = json_decode($content, true);

            $episodes = $data['data'];

            // Obtenemos los datos del último episodio
            $lastEpisode = end($episodes);

            // Obtenemos los datos de los rangos competitivos
            return $lastEpisode['tiers'];
        } else {
            return null;
        }
    }
}
