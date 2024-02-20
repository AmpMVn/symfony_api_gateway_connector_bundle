<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Process;

use DateTime;
use Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\OnlineBooking\OnlineBooking;
use Rentsoft\ApiGatewayConnectorBundle\Microservice\OnlineBookingMicroservice;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Process
{
    protected $id;

    protected DateTime $createdAt;

    protected ?string $customerData = null;

    protected ?string $bookingData = null;

    protected ?string $deliveryData = null;

    protected ?string $retoureData = null;

    protected ?string $paymentData = null;

    protected ?string $voucherData = null;

    protected int $status = 0;

    protected ?string $uniqueHash = null;

    protected OnlineBooking|string $onlineBooking;

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

    public function setOnlineBookingString(OnlineBooking $onlineBooking)
    {
        $this->onlineBooking = OnlineBookingMicroservice::URI_ONLINE_BOOKINGS . '/' . $onlineBooking->getId();
    }

    public function setCreatedAt(DateTime|string $createdAt)
    {
        if (is_string($createdAt)) {
            $this->createdAt = new DateTime($createdAt);
        } else {
            $this->createdAt = $createdAt;
        }
    }

    public function __construct() {
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
     * @return string|null
     */
    public function getCustomerData(): ?string
    {
        return $this->customerData;
    }

    /**
     * @param string|null $customerData
     */
    public function setCustomerData(?string $customerData): void
    {
        $this->customerData = $customerData;
    }

    /**
     * @return string|null
     */
    public function getBookingData(): ?string
    {
        return $this->bookingData;
    }

    /**
     * @param string|null $bookingData
     */
    public function setBookingData(?string $bookingData): void
    {
        $this->bookingData = $bookingData;
    }

    /**
     * @return string|null
     */
    public function getDeliveryData(): ?string
    {
        return $this->deliveryData;
    }

    /**
     * @param string|null $deliveryData
     */
    public function setDeliveryData(?string $deliveryData): void
    {
        $this->deliveryData = $deliveryData;
    }

    /**
     * @return string|null
     */
    public function getRetoureData(): ?string
    {
        return $this->retoureData;
    }

    /**
     * @param string|null $retoureData
     */
    public function setRetoureData(?string $retoureData): void
    {
        $this->retoureData = $retoureData;
    }

    /**
     * @return string|null
     */
    public function getPaymentData(): ?string
    {
        return $this->paymentData;
    }

    /**
     * @param string|null $paymentData
     */
    public function setPaymentData(?string $paymentData): void
    {
        $this->paymentData = $paymentData;
    }

    /**
     * @return string|null
     */
    public function getVoucherData(): ?string
    {
        return $this->voucherData;
    }

    /**
     * @param string|null $voucherData
     */
    public function setVoucherData(?string $voucherData): void
    {
        $this->voucherData = $voucherData;
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
     * @return string|null
     */
    public function getUniqueHash(): ?string
    {
        return $this->uniqueHash;
    }

    /**
     * @param string|null $uniqueHash
     */
    public function setUniqueHash(?string $uniqueHash): void
    {
        $this->uniqueHash = $uniqueHash;
    }

    /**
     * @return OnlineBooking|string
     */
    public function getOnlineBooking(): OnlineBooking|string
    {
        return $this->onlineBooking;
    }

}
