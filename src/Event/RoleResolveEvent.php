<?php

declare(strict_types=1);

namespace League\Bundle\OAuth2ServerBundle\Event;

use League\OAuth2\Server\Entities\ClientEntityInterface;

/**
 * @author Quentin Schuler aka Sukei <qschuler@neosyne.com>
 */
class RoleResolveEvent
{
    /**
     * @var ClientEntityInterface
     */
    private $client;

    /**
     * @var string|null
     */
    private $userIdentifier;

    /**
     * @var string[]
     */
    private $roles = [];

    /**
     * @param ClientEntityInterface $client
     * @param string|null           $userIdentifier
     */
    public function __construct(ClientEntityInterface $client, ?string $userIdentifier)
    {
        $this->client = $client;
        $this->userIdentifier = $userIdentifier;

        if ($userIdentifier === null) {
            $this->roles[] = 'ROLE_CLIENT';
        } else {
            $this->roles[] = 'ROLE_USER';
        }
    }

    /**
     * @return ClientEntityInterface
     */
    public function getClient(): ClientEntityInterface
    {
        return $this->client;
    }

    /**
     * @return string|null
     */
    public function getUserIdentifier(): ?string
    {
        return $this->userIdentifier;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return array_unique($this->roles);
    }

    /**
     * @param string $role
     */
    public function addRole(string $role): void
    {
        $this->roles[] = $role;
    }

    /**
     * @param string[] $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }
}
