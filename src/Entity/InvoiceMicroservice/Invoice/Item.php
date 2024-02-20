<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\InvoiceMicroservice\Invoice;

use Rentsoft\ApiGatewayConnectorBundle\Microservice\InvoiceMicroservice;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class Item implements \JsonSerializable
{

    protected int $id;

    protected int $position;

    protected Invoice|string $invoice;

    protected string $title;

    protected int $quantity;

    protected string $unit;

    protected int $netPrice;

    protected float $vatRate;

    protected int $vat;

    protected int $grossPrice;

    public function setId(int $id): Item
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getInvoice(): Invoice|string
    {
        return $this->invoice;
    }

    public function setInvoice($invoice): Item
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->invoice = $serializer->deserialize(json_encode($invoice), Invoice::class, 'json');

        return $this;
    }

    public function setInvoiceString(Invoice $invoice): Item
    {
        $this->invoice = InvoiceMicroservice::URI_INVOICES . '/' . $invoice->getId();

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Item
    {
        $this->title = $title;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): Item
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getNetPrice(): int
    {
        return $this->netPrice;
    }

    public function setNetPrice(int $netPrice): Item
    {
        $this->netPrice = $netPrice;
        return $this;
    }

    public function getVatRate(): float
    {
        return $this->vatRate;
    }

    public function setVatRate(float $vatRate): Item
    {
        $this->vatRate = $vatRate;
        return $this;
    }

    public function getVat(): int
    {
        return $this->vat;
    }

    public function setVat(int $vat): Item
    {
        $this->vat = $vat;
        return $this;
    }

    public function getGrossPrice(): int
    {
        return $this->grossPrice;
    }

    public function setGrossPrice(int $grossPrice): Item
    {
        $this->grossPrice = $grossPrice;
        return $this;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): Item
    {
        $this->unit = $unit;
        return $this;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): Item
    {
        $this->position = $position;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "title" => $this->getTitle(),
            "vatRate" => $this->getVatRate(),
            "quantity" => $this->getQuantity(),
            "netPrice" => $this->getNetPrice(),
            "unit" => $this->getUnit(),
        ];
    }


}
