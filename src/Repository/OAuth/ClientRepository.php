<?php

declare(strict_types=1);

namespace App\Repository\OAuth;

use App\Entity\OAuth\Client;
use Doctrine\ORM\EntityManagerInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;

readonly class ClientRepository implements ClientRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function getClientEntity($clientIdentifier): ?ClientEntityInterface
    {
        return $this->entityManager->getRepository(Client::class)->find($clientIdentifier);
    }

    public function validateClient($clientIdentifier, $clientSecret, $grantType): bool
    {
        /** @var Client|null $client */
        $client = $this->entityManager->getRepository(Client::class)->find($clientIdentifier);

        if (!$client instanceof Client) {
            return false;
        }

        if ($client->isConfidential()) {
            return hash_equals((string) $client->getSecret(), (string) $clientSecret);
        }

        return true;
    }
}
