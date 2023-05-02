<?php
namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;

class ValorantApiService 
{
    public function getAgents()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://valorant-api.com/v1/agents?isPlayableCharacter=true');
        $statusCode = $response->getStatusCode();

        if ($statusCode === 200) {
            $content = $response->getContent();
            return json_decode($content, true);
        } else {
            return null;
        }
    }
}
