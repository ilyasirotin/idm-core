<?php

declare(strict_types=1);

namespace App\Repository\OAuth;

use App\Entity\OAuth\RefreshToken;
use Doctrine\ORM\EntityManagerInterface;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;

readonly class RefreshTokenRepository implements RefreshTokenRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function getNewRefreshToken(): RefreshTokenEntityInterface
    {
        return new RefreshToken();
    }

    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity): void
    {
        $this->entityManager->persist($refreshTokenEntity);
        $this->entityManager->flush();
    }

    public function revokeRefreshToken($tokenId): void
    {
        $token = $this->entityManager->getRepository(RefreshToken::class)->find($tokenId);
        if ($token instanceof RefreshToken) {
            $token->setRevoked(true);
            $this->entityManager->flush();
        }
    }

    public function isRefreshTokenRevoked($tokenId): bool
    {
        $token = $this->entityManager->getRepository(RefreshToken::class)->find($tokenId);
        return $token === null || $token->isRevoked();
    }
}
