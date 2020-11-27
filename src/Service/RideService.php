<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class RideService
{
    /**
     * @return array
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    private function callRidesCollection(): array
    {
        $client = HttpClient::create();

        $response = $client->request(Request::METHOD_GET, 'http://webserver/api/rides');

        $response = json_decode($response->getContent(), true);

        return $response['hydra:member'];
    }

    /**
     * @param int $userId
     *
     * @return array
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    private function callRidesOfUserCollection(int $userId): array
    {
        $client = HttpClient::create();

        $response = $client->request(
            Request::METHOD_GET,
            sprintf('http://webserver/api/users/%d/rides', $userId)
        );

        $response = json_decode($response->getContent(), true);

        return $response['hydra:member'];
    }

    /**
     * @return array
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getRidesFromAPI(): array
    {
        try {
            $rides = $this->callRidesCollection();
        } catch (\Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        return $rides;
    }

    /**
     * @param int $userId
     *
     * @return array
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getRidesOfUserFromAPI(int $userId): array
    {
        try {
            $rides = $this->callRidesOfUserCollection($userId);
        } catch (\Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        return $rides;
    }
}
