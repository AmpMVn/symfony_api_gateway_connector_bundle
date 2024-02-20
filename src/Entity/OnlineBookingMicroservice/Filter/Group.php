<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Filter;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\OnlineBooking\OnlineBooking;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Group
{
    CONST TYPE_PROPERTY = 1;
    CONST TYPE_TAG = 4;
    CONST TYPES = array(self::TYPE_PROPERTY, self::TYPE_TAG);

    CONST STATUS_ACTIVE = 10;
    CONST STATUS_INACTIVE = 20;
    CONST STATUTES = array(self::STATUS_ACTIVE, self::STATUS_INACTIVE);

    CONST VALUE_TYPE_EXIST = 1;
    CONST VALUE_TYPE_NUMERIC = 4;
    CONST VALUE_TYPE_RANGE = 8;
    CONST VALUE_TYPE_ARRAY = 12;
    CONST VALUE_TYPES = array(self::VALUE_TYPE_EXIST, self::VALUE_TYPE_NUMERIC, self::VALUE_TYPE_RANGE, self::VALUE_TYPE_ARRAY);

    protected int $id;

    protected string $name;

    protected OnlineBooking $onlineBooking;

    protected ?int $type;

    protected ?int $valueType;

    protected ?int $position;

    protected int $status;

    protected Collection $filters;

    /**
     * @param OnlineBooking $onlineBooking
     */
    public function setOnlineBooking($onlineBooking)
    {
        $serializer = new Serializer(
            [ new ObjectNormalizer() ],
            [ new JsonEncoder() ]
        );

        $this->onlineBooking = $serializer->deserialize(json_encode($onlineBooking), OnlineBooking::class, 'json');
    }


    /**
     * @param array $filters
     */
    public function setFilters(array $filters): void
    {
        $serializer = new Serializer(
            [ new GetSetMethodNormalizer(), new ArrayDenormalizer() ],
            [ new JsonEncoder() ]
        );

        $this->filters = new ArrayCollection($serializer->deserialize(json_encode($filters), Filter::class . '[]', 'json'));
    }

    public function addFilter(Filter $filter) {
        $this->filters[] = $filter;
    }

    public function __construct(){
        $this->filters = new ArrayCollection();
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
     * @return OnlineBooking
     */
    public function getOnlineBooking(): OnlineBooking
    {
        return $this->onlineBooking;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int|null $type
     */
    public function setType(?int $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int|null
     */
    public function getValueType(): ?int
    {
        return $this->valueType;
    }

    /**
     * @param int|null $valueType
     */
    public function setValueType(?int $valueType): void
    {
        $this->valueType = $valueType;
    }

    /**
     * @return int|null
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @param int|null $position
     */
    public function setPosition(?int $position): void
    {
        $this->position = $position;
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
    public function getFilters(): ArrayCollection|Collection
    {
        return $this->filters;
    }

}

