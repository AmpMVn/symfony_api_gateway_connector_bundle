<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Setting\OpenTime;

class OpenTime
{

    protected int $id;

    protected string $takeoverTakeback;

    protected string $rentalTime;

    protected ?string $defaultTime;

    protected int $day;

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
    public function getTakeoverTakeback(): string
    {
        return $this->takeoverTakeback;
    }

    /**
     * @param string $takeoverTakeback
     */
    public function setTakeoverTakeback(string $takeoverTakeback): void
    {
        $this->takeoverTakeback = $takeoverTakeback;
    }

    /**
     * @return string
     */
    public function getRentalTime(): string
    {
        return $this->rentalTime;
    }

    /**
     * @param string $rentalTime
     */
    public function setRentalTime(string $rentalTime): void
    {
        $this->rentalTime = $rentalTime;
    }

    /**
     * @return string|null
     */
    public function getDefaultTime(): ?string
    {
        return $this->defaultTime;
    }

    /**
     * @param string|null $defaultTime
     */
    public function setDefaultTime(?string $defaultTime): void
    {
        $this->defaultTime = $defaultTime;
    }

    /**
     * @return int
     */
    public function getDay(): int
    {
        return $this->day;
    }

    /**
     * @param int $day
     */
    public function setDay(int $day): void
    {
        $this->day = $day;
    }

}
