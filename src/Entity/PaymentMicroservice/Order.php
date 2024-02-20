<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\PaymentMicroservice;

use DateTime;

class Order
{
    private ?int $id;

    private ?string $clientId;

    private ?string $orderId;

    private ?string $product;

    private ?string $status;

    private DateTime|string $createdAt;

    private DateTime|string|null $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getCreatedAt(): DateTime|string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime|string $createdAt): Order
    {
        $this->createdAt = is_string($createdAt) ? new DateTime($createdAt) : $createdAt;
        return $this;
    }

    public function setCreatedAtString(string $createdAt): Order
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): DateTime|string|null
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime|string|null $updatedAt): Order
    {
        $this->updatedAt = is_string($updatedAt) ? new DateTime($updatedAt) : $updatedAt;
        return $this;
    }

    public function setUpdatedAtString(string|null $updatedAt): Order
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    public function setClientId(?string $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function setOrderId(?string $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getProduct(): ?string
    {
        return $this->product;
    }

    public function setProduct(?string $product): void
    {
        $this->product = $product;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }
}
