<?php

declare(strict_types=1);

namespace App\Entity\OAuth;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;

#[ORM\Entity]
#[ORM\Table(name: 'oauth_refresh_tokens')]
class RefreshToken implements RefreshTokenEntityInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 100)]
    private string $identifier;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $expiryDateTime;

    #[ORM\ManyToOne(targetEntity: AccessToken::class)]
    #[ORM\JoinColumn(name: 'access_token_identifier', referencedColumnName: 'identifier', nullable: false)]
    private AccessTokenEntityInterface $accessToken;

    #[ORM\Column(type: 'boolean')]
    private bool $revoked = false;

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

    public function getAccessToken(): AccessTokenEntityInterface
    {
        return $this->accessToken;
    }

    public function setAccessToken(AccessTokenEntityInterface $accessToken): void
    {
        $this->accessToken = $accessToken;
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
