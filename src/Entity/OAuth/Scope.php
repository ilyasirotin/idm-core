<?php

declare(strict_types=1);

namespace App\Entity\OAuth;

use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities\ScopeEntityInterface;

#[ORM\Entity]
#[ORM\Table(name: 'oauth_scopes')]
class Scope implements ScopeEntityInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 100)]
    private string $identifier;

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function jsonSerialize(): string
    {
        return $this->getIdentifier();
    }
}
