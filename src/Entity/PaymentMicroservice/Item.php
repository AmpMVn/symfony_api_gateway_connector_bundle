<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\PaymentMicroservice;

class Item
{

    private string $name;

    private string $articleNumber;

    private int $totalPrice;

    private int $totalPriceWithTax;

    private int $unitPrice;

    private int $unitPriceWithTax;

    private int $tax;

    private int $quantity;

    private string $articleType;

    private int $discount;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getArticleNumber(): string
    {
        return $this->articleNumber;
    }

    public function setArticleNumber(string $articleNumber)
    {
        $this->articleNumber = $articleNumber;
    }

    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(int $totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    public function getTotalPriceWithTax(): int
    {
        return $this->totalPriceWithTax;
    }

    public function setTotalPriceWithTax(int $totalPriceWithTax)
    {
        $this->totalPriceWithTax = $totalPriceWithTax;
    }

    public function getUnitPrice(): int
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(int $unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }

    public function getUnitPriceWithTax(): int
    {
        return $this->unitPriceWithTax;
    }

    public function setUnitPriceWithTax(int $unitPriceWithTax)
    {
        $this->unitPriceWithTax = $unitPriceWithTax;
    }

    public function getTax(): int
    {
        return $this->tax;
    }

    public function setTax(int $tax)
    {
        $this->tax = $tax;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function getArticleType(): string
    {
        return $this->articleType;
    }

    public function setArticleType(string $articleType): string
    {
        return $this->articleType = $articleType;
    }

    public function getDiscount(): int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): int
    {
        return $this->discount = $discount;
    }

}
