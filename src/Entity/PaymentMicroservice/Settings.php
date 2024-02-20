<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\PaymentMicroservice;

class Settings
{
    private ?int $id;

    private ?string $clientId;

    private ?string $merchantId;

    private ?string $apiKey;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    public function setClientId($clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function getMerchantId(): ?string
    {
        return $this->merchantId;
    }

    public function setMerchantId(string $merchantId): self
    {
        $this->merchantId = $merchantId;

        return $this;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }
}
