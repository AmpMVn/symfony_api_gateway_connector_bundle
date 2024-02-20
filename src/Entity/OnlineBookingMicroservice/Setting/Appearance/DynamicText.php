<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Setting\Appearance;

class DynamicText
{

    protected ?string $paymentBanktransfer = null;
    protected ?string $paymentPaypalManuel = null;
    protected ?string $paymentByPickup = null;
    protected ?string $welcomeTeaser = null;
    protected ?string $articleInfo = null;

    /**
     * @return string|null
     */
    public function getPaymentBanktransfer(): ?string
    {
        return $this->paymentBanktransfer;
    }

    /**
     * @param string|null $paymentBanktransfer
     */
    public function setPaymentBanktransfer(?string $paymentBanktransfer): void
    {
        $this->paymentBanktransfer = $paymentBanktransfer;
    }

    /**
     * @return string|null
     */
    public function getPaymentPaypalManuel(): ?string
    {
        return $this->paymentPaypalManuel;
    }

    /**
     * @param string|null $paymentPaypalManuel
     */
    public function setPaymentPaypalManuel(?string $paymentPaypalManuel): void
    {
        $this->paymentPaypalManuel = $paymentPaypalManuel;
    }

    /**
     * @return string|null
     */
    public function getWelcomeTeaser(): ?string
    {
        return $this->welcomeTeaser;
    }

    /**
     * @param string|null $welcomeTeaser
     */
    public function setWelcomeTeaser(?string $welcomeTeaser): void
    {
        $this->welcomeTeaser = $welcomeTeaser;
    }

    /**
     * @return string|null
     */
    public function getPaymentByPickup(): ?string
    {
        return $this->paymentByPickup;
    }

    /**
     * @param string|null $paymentByPickup
     */
    public function setPaymentByPickup(?string $paymentByPickup): void
    {
        $this->paymentByPickup = $paymentByPickup;
    }

    /**
     * @return string|null
     */
    public function getArticleInfo(): ?string
    {
        return $this->articleInfo;
    }

    /**
     * @param string|null $articleInfo
     */
    public function setArticleInfo(?string $articleInfo): void
    {
        $this->articleInfo = $articleInfo;
    }
}
