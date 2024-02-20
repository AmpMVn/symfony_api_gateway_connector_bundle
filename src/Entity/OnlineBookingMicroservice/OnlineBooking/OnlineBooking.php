<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\OnlineBooking;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Filter\Group;
use Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Setting\Appearance\Layout;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class OnlineBooking
{

    protected $id;

    protected DateTime $createdAt;

    protected DateTime $updatedAt;

    protected ?Layout $settingsAppearanceLayout = null;

    protected bool $isPublic = false;

    protected $uri;

    protected string $name;

    protected Collection $filterGroups;

    protected string $clientId;

    ### START Manual ###

    /**
     * @param Layout $settingsAppearanceLayout
     */
    public function setSettingsAppearanceLayout($settingsAppearanceLayout)
    {
        $serializer = new Serializer(
            [ new ObjectNormalizer() ],
            [ new JsonEncoder() ]
        );

        $this->settingsAppearanceLayout = $serializer->deserialize(json_encode($settingsAppearanceLayout), Layout::class, 'json');
    }

    /**
     * @param Collection $filterGroups
     */
    public function setFilterGroups($filterGroups)
    {
        $serializer = new Serializer(
            [ new GetSetMethodNormalizer(), new ArrayDenormalizer() ],
            [ new JsonEncoder() ]
        );

        $this->filterGroups = new ArrayCollection($serializer->deserialize(json_encode($filterGroups), Group::class . '[]', 'json'));
    }

    /**
     * @param \Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Setting\AdditionalField\Group $additionalFieldGroup
     */
    public function setAdditionalFieldGroup($additionalFieldGroup)
    {
        $serializer = new Serializer(
            [ new ObjectNormalizer() ],
            [ new JsonEncoder() ]
        );

        $this->additionalFieldGroup = $serializer->deserialize(json_encode($additionalFieldGroup), \Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Setting\AdditionalField\Group::class, 'json');
    }

    ### END Manual ###

    public function __construct() {
        $this->filterGroups = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = new DateTime($createdAt);
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = new DateTime($updatedAt);
    }

    /**
     * @return string
     */
    public function getBranchType(): string
    {
        return $this->branchType;
    }

    /**
     * @param string $branchType
     */
    public function setBranchType(string $branchType): void
    {
        $this->branchType = $branchType;
    }

    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->isPublic;
    }

    /**
     * @param bool $isPublic
     */
    public function setIsPublic(bool $isPublic): void
    {
        $this->isPublic = $isPublic;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param mixed $uri
     */
    public function setUri($uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @return Layout|null
     */
    public function getSettingsAppearanceLayout(): ?Layout
    {
        return $this->settingsAppearanceLayout;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @return Collection
     */
    public function getFilterGroups(): Collection
    {
        return $this->filterGroups;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }


}
