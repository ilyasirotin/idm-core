<?php

declare(strict_types=1);

namespace App\Entity\OAuth;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;

#[ORM\Entity]
#[ORM\Table(name: 'oauth_auth_codes')]
class AuthCode implements AuthCodeEntityInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 100)]
    private string $identifier;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $expiryDateTime;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $userIdentifier = null;

    #[ORM\ManyToOne(targetEntity: Client::class)]
    #[ORM\JoinColumn(name: 'client_identifier', referencedColumnName: 'identifier', nullable: false)]
    private ClientEntityInterface $client;

    #[ORM\ManyToMany(targetEntity: Scope::class)]
    #[ORM\JoinTable(
        name: 'oauth_auth_code_scopes',
        joinColumns: [new ORM\JoinColumn(name: 'auth_code_identifier', referencedColumnName: 'identifier')],
        inverseJoinColumns: [new ORM\JoinColumn(name: 'scope_identifier', referencedColumnName: 'identifier')]
    )]
    private Collection $scopes;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $redirectUri = null;

    #[ORM\Column(type: 'boolean')]
    private bool $revoked = false;

    public function __construct()
    {
        $this->scopes = new ArrayCollection();
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier($identifier): void
    {
        $this->identifier = (string) $identifier;
    }

    public function getExpiryDateTime(): DateTimeImmutable
    {
        return $this->expiryDateTime;
    }

    public function setExpiryDateTime(DateTimeImmutable $dateTime): void
    {
        $this->expiryDateTime = $dateTime;
    }

    public function getUserIdentifier(): ?string
    {
        return $this->userIdentifier;
    }

    public function setUserIdentifier($identifier): void
    {
        $this->userIdentifier = (string) $identifier;
    }

    public function getClient(): ClientEntityInterface
    {
        return $this->client;
    }

    public function setClient(ClientEntityInterface $client): void
    {
        $this->client = $client;
    }

    public function addScope(ScopeEntityInterface $scope): void
    {
        if (!$this->scopes->contains($scope)) {
            $this->scopes->add($scope);
        }
    }

    public function getScopes(): array
    {
        return $this->scopes->toArray();
    }

    public function getRedirectUri(): ?string
    {
        return $this->redirectUri;
    }

    public function setRedirectUri($uri): void
    {
        $this->redirectUri = (string) $uri;
    }

    public function isRevoked(): bool
    {
        return $this->revoked;
    }

    public function setRevoked(bool $revoked): void
    {
        $this->revoked = $revoked;
    }
}
