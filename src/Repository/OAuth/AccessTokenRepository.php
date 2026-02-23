<?php

declare(strict_types=1);

namespace App\Repository\OAuth;

use App\Entity\OAuth\AccessToken;
use Doctrine\ORM\EntityManagerInterface;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;

readonly class AccessTokenRepository implements AccessTokenRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null): AccessTokenEntityInterface
    {
        $accessToken = new AccessToken();
        $accessToken->setClient($clientEntity);
        $accessToken->setUserIdentifier((string) $userIdentifier);

        foreach ($scopes as $scope) {
            $accessToken->addScope($scope);
        }

        return $accessToken;
    }

    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity): void
    {
        $this->entityManager->persist($accessTokenEntity);
        $this->entityManager->flush();
    }

    public function revokeAccessToken($tokenId): void
    {
        $token = $this->entityManager->getRepository(AccessToken::class)->find($tokenId);
        if ($token instanceof AccessToken) {
            $token->setRevoked(true);
            $this->entityManager->flush();
        }
    }

    public function isAccessTokenRevoked($tokenId): bool
    {
        $token = $this->entityManager->getRepository(AccessToken::class)->find($tokenId);
        return $token === null || $token->isRevoked();
    }
}
