<?php

declare(strict_types=1);

namespace App\Repository\OAuth;

use App\Entity\OAuth\AuthCode;
use Doctrine\ORM\EntityManagerInterface;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;

readonly class AuthCodeRepository implements AuthCodeRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function getNewAuthCode(): AuthCodeEntityInterface
    {
        return new AuthCode();
    }

    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity): void
    {
        $this->entityManager->persist($authCodeEntity);
        $this->entityManager->flush();
    }

    public function revokeAuthCode($codeId): void
    {
        $authCode = $this->entityManager->getRepository(AuthCode::class)->find($codeId);
        if ($authCode instanceof AuthCode) {
            $authCode->setRevoked(true);
            $this->entityManager->flush();
        }
    }

    public function isAuthCodeRevoked($codeId): bool
    {
        $authCode = $this->entityManager->getRepository(AuthCode::class)->find($codeId);
        return $authCode === null || $authCode->isRevoked();
    }
}
