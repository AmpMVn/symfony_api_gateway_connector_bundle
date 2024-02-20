<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\PaymentMicroservice;

class OrderIntent
{
    private ?string $processId = null;

    private ?string $clientId = null;

    private ?string $ipAddress = null;

    private int $amount;

    private string $currency;

    private string $locale;

    private ?string $title = null;

    private string $firstName;

    private string $lastName;

    private string $street;

    private string $houseNumber;

    private string $city;

    private string $zip;

    private string $country;

    private ?string $state = null;

    private string $phone;

    private ?string $fax = null;

    private ?string $mobile = null;

    private ?string $additionalDetails = null;

    private string $email;

    private ?string $customerType = null;

    private ?string $organizationRegistrationId = null;

    private ?string $organizationVatId = null;

    private ?string $organizationRegistrationRegister = null;

    private ?string $organizationEntityType = null;

    private ?string $companyName = null;

    private ?string $reference = null;

    private ?int $birthday = null;

    private ?string $gender = null;

    private string $successUrl;

    private string $failureUrl;

    private string $cancelUrl;

    private ?array $items = null;

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    public function setClientId(?string $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }

    public function setIpAddress(?string $ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(string $houseNumber): void
    {
        $this->houseNumber = $houseNumber;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function setZip(string $zip): void
    {
        $this->zip = $zip;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): void
    {
        $this->fax = $fax;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): void
    {
        $this->mobile = $mobile;
    }

    public function getAdditionalDetails(): ?string
    {
        return $this->additionalDetails;
    }

    public function setAdditionalDetails(?string $additionalDetails): void
    {
        $this->additionalDetails = $additionalDetails;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getCustomerType(): ?string
    {
        return $this->customerType;
    }

    public function setCustomerType(?string $customerType): void
    {
        $this->customerType = $customerType;
    }

    public function getOrganizationRegistrationId(): ?string
    {
        return $this->organizationRegistrationId;
    }

    public function setOrganizationRegistrationId(?string $organizationRegistrationId): void
    {
        $this->organizationRegistrationId = $organizationRegistrationId;
    }

    public function getOrganizationVatId(): ?string
    {
        return $this->organizationVatId;
    }

    public function setOrganizationVatId(?string $organizationVatId): void
    {
        $this->organizationVatId = $organizationVatId;
    }

    public function getOrganizationRegistrationRegister(): ?string
    {
        return $this->organizationRegistrationRegister;
    }

    public function setOrganizationRegistrationRegister(?string $organizationRegistrationRegister): void
    {
        $this->organizationRegistrationRegister = $organizationRegistrationRegister;
    }

    public function getOrganizationEntityType(): ?string
    {
        return $this->organizationEntityType;
    }

    public function setOrganizationEntityType(?string $organizationEntityType): void
    {
        $this->organizationEntityType = $organizationEntityType;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): void
    {
        $this->companyName = $companyName;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): void
    {
        $this->reference = $reference;
    }

    public function getBirthday(): ?int
    {
        return $this->birthday;
    }

    public function setBirthday(?int $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    public function getSuccessUrl(): string
    {
        return $this->successUrl;
    }

    public function setSuccessUrl(string $successUrl): void
    {
        $this->successUrl = $successUrl;
    }

    public function getFailureUrl(): string
    {
        return $this->failureUrl;
    }

    public function setFailureUrl(string $failureUrl): void
    {
        $this->failureUrl = $failureUrl;
    }

    public function getCancelUrl(): string
    {
        return $this->cancelUrl;
    }

    public function setCancelUrl(string $cancelUrl): void
    {
        $this->cancelUrl = $cancelUrl;
    }

    public function getItems(): ?array
    {
        return $this->items;
    }

    public function setItems(?array $items): void
    {
        $this->items = $items;
    }

    public function getProcessId(): ?string
    {
        return $this->processId;
    }

    public function setProcessId(?string $processId): void
    {
        $this->processId = $processId;
    }

}
