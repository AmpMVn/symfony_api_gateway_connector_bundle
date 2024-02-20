<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Setting\AdditionalField;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class Group
{
    protected int $id;

    protected string $name;

    protected int $status;

    protected Collection $entries;

    /**
     * @param array $entries
     */
    public function setEntries(array $entries): void
    {
        $serializer = new Serializer(
            [ new GetSetMethodNormalizer(), new ArrayDenormalizer() ],
            [ new JsonEncoder() ]
        );

        $this->entries = new ArrayCollection($serializer->deserialize(json_encode($entries), Entry::class . '[]', 'json'));
    }

    public function __construct(){
        $this->entries = new ArrayCollection();
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
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getEntries(): ArrayCollection|Collection
    {
        return $this->entries;
    }

}
