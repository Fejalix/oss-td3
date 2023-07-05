<?php

use PHPUnit\Framework\TestCase;
use Felixjanot\OssTd3\Api;
use Symfony\Component\HttpClient\HttpClient;

class ApiTest extends TestCase
{
    public function testGetAllCharacters()
    {
        // Créer une instance du client HTTP
        $client = HttpClient::create();

        // Créer une instance de la classe Api en lui passant le client HTTP
        $api = new Api($client);

        // Appeler la méthode getAllCharacters() pour obtenir les personnages
        $characters = $api->getAllCharacters();

        // Vérifier que les personnages ont été obtenus avec succès
        $this->assertNotEmpty($characters);

        // Vous pouvez ajouter d'autres assertions pour vérifier les détails des personnages si nécessaire
    }
}
