<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\ClientMicroservice\Group;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;


class Group
{

    /**
     * @var string
     */
    protected string $id;

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var array<int, Group>
     */
    protected array $subGroups;

    /**
     * @var array
     */
    protected array $attributes;

    /** !!! START NOT GENERATED !!! */

    public function getRentsoftClientId() {
        return $this->getAttributes()["rs_client_id"][0];
    }

    /** !!! END NOT GENERATED !!! */

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Group[]
     */
    public function getSubGroups(): array
    {
        return $this->subGroups;
    }

    /**
     * @param Group[] $subGroups
     */
    public function setSubGroups(array $subGroups): void
    {
        $this->subGroups = $subGroups;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }


}
