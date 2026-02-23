<?php

declare(strict_types=1);

namespace App\Repository\OAuth;

use App\Entity\OAuth\Scope;
use Doctrine\ORM\EntityManagerInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;

readonly class ScopeRepository implements ScopeRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function getScopeEntityByIdentifier($identifier): ?ScopeEntityInterface
    {
        return $this->entityManager->getRepository(Scope::class)->find($identifier);
    }

    public function finalizeScopes(
        array $scopes,
        string $grantType,
        ClientEntityInterface $clientEntity,
        ?string $userIdentifier = null,
        ?string $authCodeId = null
    ): array {
        return $scopes;
    }
}
