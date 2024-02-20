<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Article;

use DateTime;

class Stock
{

    protected int $id;

    protected string $createdAt;

    protected ?string $updatedAt;

    protected ?string $refrenceNumber;

    protected ?string $serialCode;

    protected ?string $description;

    protected ?string $codeContent;

    protected int $status;

    public function __construct() {
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
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @param string|null $updatedAt
     */
    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string|null
     */
    public function getRefrenceNumber(): ?string
    {
        return $this->refrenceNumber;
    }

    /**
     * @param string|null $refrenceNumber
     */
    public function setRefrenceNumber(?string $refrenceNumber): void
    {
        $this->refrenceNumber = $refrenceNumber;
    }

    /**
     * @return string|null
     */
    public function getSerialCode(): ?string
    {
        return $this->serialCode;
    }

    /**
     * @param string|null $serialCode
     */
    public function setSerialCode(?string $serialCode): void
    {
        $this->serialCode = $serialCode;
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

    /**
     * @return string|null
     */
    public function getCodeContent(): ?string
    {
        return $this->codeContent;
    }

    /**
     * @param string|null $codeContent
     */
    public function setCodeContent(?string $codeContent): void
    {
        $this->codeContent = $codeContent;
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

}
