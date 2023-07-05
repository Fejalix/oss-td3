<?php

declare(strict_types=1);

namespace Felixjanot\OssTd3;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Api
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getAllCharacters(): array
    {
        $response = $this->client->request(
            'GET',
            'https://myheroacademia.fandom.com/wiki/List_of_Characters'
        );

        $content = $response->getContent();

        $crawler = new Crawler($content);

        $classElements = $crawler->filter('.theme-affiliation-ua_high');

        $characters = [];

        foreach ($classElements as $classElement) {
            $class = $classElement->textContent;

            $students = $this->extractStudentsFromElement($classElement);

            $characters[$class] = $students;
        }

        return $characters;
    }

    private function extractStudentsFromElement($element): array
    {
        $students = [];

        $crawler = new Crawler($element);

        $studentElements = $crawler->filter('.chargallery-profile-caption');

        foreach ($studentElements as $studentElement) {
            $students[] = $studentElement->textContent;
        }

        return $students;
    }
}

// Exemple d'utilisation de la classe Api

// Inclure l'autoloader de Composer
require_once 'vendor/autoload.php';

use Symfony\Component\HttpClient\HttpClient;

// Créer une instance du client HTTP
$client = HttpClient::create();

// Créer une instance de la classe Api en lui passant le client HTTP
$api = new Api($client);

// Appeler la méthode getAllCharacters() pour obtenir tous les personnages
$characters = $api->getAllCharacters();

// Afficher les personnages
foreach ($characters as $class => $students) {
    echo "Classe: $class\n";
    echo "Élèves:\n";
    foreach ($students as $student) {
        echo "- $student\n";
    }
    echo "\n";
}
