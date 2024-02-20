<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\ArticleGroup;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class ArticleGroup
{
    protected int $id;

    protected string $clientId;

    protected string $name;

    protected ?float $priceDisplay;

    protected ?float $priceDeposit;

    protected ?string $description;

    protected Collection $images;

    protected Collection $attributes;

    protected Collection $accessories;

    protected bool $enabledMsOnlineBooking;

    /**
     * @param Collection $attributes
     */
    public function setAttributes($attributes)
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->attributes = new ArrayCollection($serializer->deserialize(json_encode($attributes), Attributte::class. '[]', 'json'));
    }

    /**
     * @param Collection $images
     */
    public function setImages($images)
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->images = new ArrayCollection($serializer->deserialize(json_encode($images), Image::class . '[]', 'json'));
    }

    /**
     * @param Collection $accessories
     */
    public function setAccessories($accessories)
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->accessories = new ArrayCollection($serializer->deserialize(json_encode($accessories), Accessories::class . '[]', 'json'));
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
     * @return Collection
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @return Collection
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    /**
     * @return Collection
     */
    public function getAccessories(): Collection
    {
        return $this->accessories;
    }

    /**
     * @return bool
     */
    public function isEnabledMsOnlineBooking(): bool
    {
        return $this->enabledMsOnlineBooking;
    }

    /**
     * @param bool $enabledMsOnlineBooking
     */
    public function setEnabledMsOnlineBooking(bool $enabledMsOnlineBooking): void
    {
        $this->enabledMsOnlineBooking = $enabledMsOnlineBooking;
    }

    /**
     * @return float|null
     */
    public function getPriceDisplay(): ?float
    {
        return $this->priceDisplay;
    }

    /**
     * @param float|null $priceDisplay
     */
    public function setPriceDisplay(?float $priceDisplay): void
    {
        $this->priceDisplay = $priceDisplay;
    }

    /**
     * @return float|null
     */
    public function getPriceDeposit(): ?float
    {
        return $this->priceDeposit;
    }

    /**
     * @param float|null $priceDeposit
     */
    public function setPriceDeposit(?float $priceDeposit): void
    {
        $this->priceDeposit = $priceDeposit;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }


}
