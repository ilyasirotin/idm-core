<?php

declare(strict_types=1);

namespace App\Entity\OAuth;

use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities\ClientEntityInterface;

#[ORM\Entity]
#[ORM\Table(name: 'oauth_clients')]
class Client implements ClientEntityInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 100)]
    private string $identifier;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'json')]
    private array $redirectUri = [];

    #[ORM\Column(type: 'boolean')]
    private bool $isConfidential = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $secret = null;

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getRedirectUri(): string|array
    {
        return $this->redirectUri;
    }

    public function setRedirectUri(array $redirectUri): void
    {
        $this->redirectUri = $redirectUri;
    }

    public function isConfidential(): bool
    {
        return $this->isConfidential;
    }

    public function setIsConfidential(bool $isConfidential): void
    {
        $this->isConfidential = $isConfidential;
    }

    public function getSecret(): ?string
    {
        return $this->secret;
    }

    public function setSecret(?string $secret): void
    {
        $this->secret = $secret;
    }
}
