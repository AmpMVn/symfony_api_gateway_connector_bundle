<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Setting\Appearance;

class Checkout
{

    protected bool $showNoticeField = false;

    protected bool $formShowTitle = false;

    protected bool $formShowCompany = false;

    protected bool $formShowStreetHouseNumber = false;

    protected bool $formShowZipCity = false;

    protected bool $formShowCountry = false;

    protected bool $formShowTelephone = false;

    protected bool $formShowUstid = false;

    protected bool $enablePayment = false;

    protected bool $enableCreditcard = false;

    protected bool $enableCreditcardPayzen = false;

    protected bool $enableSofort = false;

    protected bool $enableBanktransfer = false;

    protected bool $enablePaypalManuel = false;

    protected bool $enablePaypalAutomatic = false;

    protected bool $enableDeliveryOptions = false;

    protected bool $enablePayByPickup = false;

    protected bool $enableReturnOptions = false;

    /**
     * @return bool
     */
    public function isShowNoticeField(): bool
    {
        return $this->showNoticeField;
    }

    /**
     * @param bool $showNoticeField
     */
    public function setShowNoticeField(bool $showNoticeField): void
    {
        $this->showNoticeField = $showNoticeField;
    }

    /**
     * @return bool
     */
    public function isFormShowTitle(): bool
    {
        return $this->formShowTitle;
    }

    /**
     * @param bool $formShowTitle
     */
    public function setFormShowTitle(bool $formShowTitle): void
    {
        $this->formShowTitle = $formShowTitle;
    }

    /**
     * @return bool
     */
    public function isFormShowCompany(): bool
    {
        return $this->formShowCompany;
    }

    /**
     * @param bool $formShowCompany
     */
    public function setFormShowCompany(bool $formShowCompany): void
    {
        $this->formShowCompany = $formShowCompany;
    }

    /**
     * @return bool
     */
    public function isFormShowStreetHouseNumber(): bool
    {
        return $this->formShowStreetHouseNumber;
    }

    /**
     * @param bool $formShowStreetHouseNumber
     */
    public function setFormShowStreetHouseNumber(bool $formShowStreetHouseNumber): void
    {
        $this->formShowStreetHouseNumber = $formShowStreetHouseNumber;
    }

    /**
     * @return bool
     */
    public function isFormShowZipCity(): bool
    {
        return $this->formShowZipCity;
    }

    /**
     * @param bool $formShowZipCity
     */
    public function setFormShowZipCity(bool $formShowZipCity): void
    {
        $this->formShowZipCity = $formShowZipCity;
    }

    /**
     * @return bool
     */
    public function isFormShowCountry(): bool
    {
        return $this->formShowCountry;
    }

    /**
     * @param bool $formShowCountry
     */
    public function setFormShowCountry(bool $formShowCountry): void
    {
        $this->formShowCountry = $formShowCountry;
    }

    /**
     * @return bool
     */
    public function isFormShowTelephone(): bool
    {
        return $this->formShowTelephone;
    }

    /**
     * @param bool $formShowTelephone
     */
    public function setFormShowTelephone(bool $formShowTelephone): void
    {
        $this->formShowTelephone = $formShowTelephone;
    }

    /**
     * @return bool
     */
    public function isEnablePayment(): bool
    {
        return $this->enablePayment;
    }

    /**
     * @param bool $enablePayment
     */
    public function setEnablePayment(bool $enablePayment): void
    {
        $this->enablePayment = $enablePayment;
    }

    /**
     * @return bool
     */
    public function isEnableCreditcard(): bool
    {
        return $this->enableCreditcard;
    }

    /**
     * @param bool $enableCreditcard
     */
    public function setEnableCreditcard(bool $enableCreditcard): void
    {
        $this->enableCreditcard = $enableCreditcard;
    }

    /**
     * @return bool
     */
    public function isEnableSofort(): bool
    {
        return $this->enableSofort;
    }

    /**
     * @param bool $enableSofort
     */
    public function setEnableSofort(bool $enableSofort): void
    {
        $this->enableSofort = $enableSofort;
    }

    /**
     * @return bool
     */
    public function isEnableBanktransfer(): bool
    {
        return $this->enableBanktransfer;
    }

    /**
     * @param bool $enableBanktransfer
     */
    public function setEnableBanktransfer(bool $enableBanktransfer): void
    {
        $this->enableBanktransfer = $enableBanktransfer;
    }

    /**
     * @return bool
     */
    public function isEnablePaypalManuel(): bool
    {
        return $this->enablePaypalManuel;
    }

    /**
     * @param bool $enablePaypalManuel
     */
    public function setEnablePaypalManuel(bool $enablePaypalManuel): void
    {
        $this->enablePaypalManuel = $enablePaypalManuel;
    }

    /**
     * @return bool
     */
    public function isEnablePaypalAutomatic(): bool
    {
        return $this->enablePaypalAutomatic;
    }

    /**
     * @param bool $enablePaypalAutomatic
     */
    public function setEnablePaypalAutomatic(bool $enablePaypalAutomatic): void
    {
        $this->enablePaypalAutomatic = $enablePaypalAutomatic;
    }

    /**
     * @return bool
     */
    public function isEnableDeliveryOptions(): bool
    {
        return $this->enableDeliveryOptions;
    }

    /**
     * @param bool $enableDeliveryOptions
     */
    public function setEnableDeliveryOptions(bool $enableDeliveryOptions): void
    {
        $this->enableDeliveryOptions = $enableDeliveryOptions;
    }

    /**
     * @return bool
     */
    public function isEnableReturnOptions(): bool
    {
        return $this->enableReturnOptions;
    }

    /**
     * @param bool $enableReturnOptions
     */
    public function setEnableReturnOptions(bool $enableReturnOptions): void
    {
        $this->enableReturnOptions = $enableReturnOptions;
    }

    /**
     * @return bool
     */
    public function isEnablePayByPickup(): bool
    {
        return $this->enablePayByPickup;
    }

    /**
     * @param bool $enablePayByPickup
     */
    public function setEnablePayByPickup(bool $enablePayByPickup): void
    {
        $this->enablePayByPickup = $enablePayByPickup;
    }

    /**
     * @return bool
     */
    public function isFormShowUstid(): bool
    {
        return $this->formShowUstid;
    }

    /**
     * @param bool $formShowUstid
     */
    public function setFormShowUstid(bool $formShowUstid): void
    {
        $this->formShowUstid = $formShowUstid;
    }

    /**
     * @return bool
     */
    public function isEnableCreditcardPayzen(): bool
    {
        return $this->enableCreditcardPayzen;
    }

    /**
     * @param bool $enableCreditcardPayzen
     */
    public function setEnableCreditcardPayzen(bool $enableCreditcardPayzen): void
    {
        $this->enableCreditcardPayzen = $enableCreditcardPayzen;
    }


}
