<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\InvoiceMicroservice\Settings;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Rentsoft\ApiGatewayConnectorBundle\Entity\InvoiceMicroservice\Settings\Invoice\Letterhead;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class Settings
{
    private int $id;

    private ?string $clientId = null;

    private string $bankAccount;

    private int $numberOfDaysUntilDueDate;

    private int $maxReminders;

    private ?string $clientName = null;

    private ?string $clientStreet = null;

    private ?string $clientZip = null;

    private ?string $clientCity = null;

    private ?string $clientCountry = null;

    private ?string $clientPhone = null;

    private ?string $clientEmail = null;

    private ?string $clientCompanyIdentificationNumber = null; // IČ, Wirtschafts-Identifikationsnummer

    private ?string $clientTaxIdentificationNumber = null; // DIČ, Steuerliche Identifikationsnummer

    private ?string $clientBankAccount = null;

    private ArrayCollection $letterheads;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Settings
    {
        $this->id = $id;
        return $this;
    }

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    public function setClientId(?string $clientId): Settings
    {
        $this->clientId = $clientId;
        return $this;
    }

    public function getBankAccount(): string
    {
        return $this->bankAccount;
    }

    public function setBankAccount(string $bankAccount): Settings
    {
        $this->bankAccount = $bankAccount;
        return $this;
    }

    public function getNumberOfDaysUntilDueDate(): int
    {
        return $this->numberOfDaysUntilDueDate;
    }

    public function setNumberOfDaysUntilDueDate(int $numberOfDaysUntilDueDate): Settings
    {
        $this->numberOfDaysUntilDueDate = $numberOfDaysUntilDueDate;
        return $this;
    }

    public function getMaxReminders(): int
    {
        return $this->maxReminders;
    }

    public function setMaxReminders(int $maxReminders): Settings
    {
        $this->maxReminders = $maxReminders;
        return $this;
    }

    public function getLetterheads(): Collection
    {
        return $this->letterheads;
    }

    public function getActiveLetterhead(): ?Letterhead
    {
        $letterHeads = $this->letterheads->matching(
            Criteria::create()
                ->where(Criteria::expr()->eq("active", true))
                ->setMaxResults(1)
        );
        return !$letterHeads->isEmpty() ? $letterHeads->first() : null;
    }

    public function setLetterheads($letterheads): Settings
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->letterheads = new ArrayCollection($serializer->deserialize(json_encode($letterheads), Letterhead::class . '[]', 'json'));
        return $this;
    }

    public function getClientName(): ?string
    {
        return $this->clientName;
    }

    public function setClientName(?string $clientName): Settings
    {
        $this->clientName = $clientName;
        return $this;
    }

    public function getClientStreet(): ?string
    {
        return $this->clientStreet;
    }

    public function setClientStreet(?string $clientStreet): Settings
    {
        $this->clientStreet = $clientStreet;
        return $this;
    }

    public function getClientZip(): ?string
    {
        return $this->clientZip;
    }

    public function setClientZip(?string $clientZip): Settings
    {
        $this->clientZip = $clientZip;
        return $this;
    }

    public function getClientCity(): ?string
    {
        return $this->clientCity;
    }

    public function setClientCity(?string $clientCity): Settings
    {
        $this->clientCity = $clientCity;
        return $this;
    }

    public function getClientCountry(): ?string
    {
        return $this->clientCountry;
    }

    public function setClientCountry(?string $clientCountry): Settings
    {
        $this->clientCountry = $clientCountry;
        return $this;
    }

    public function getClientPhone(): ?string
    {
        return $this->clientPhone;
    }

    public function setClientPhone(?string $clientPhone): Settings
    {
        $this->clientPhone = $clientPhone;
        return $this;
    }

    public function getClientEmail(): ?string
    {
        return $this->clientEmail;
    }

    public function setClientEmail(?string $clientEmail): Settings
    {
        $this->clientEmail = $clientEmail;
        return $this;
    }

    public function getClientCompanyIdentificationNumber(): ?string
    {
        return $this->clientCompanyIdentificationNumber;
    }

    public function setClientCompanyIdentificationNumber(?string $clientCompanyIdentificationNumber): Settings
    {
        $this->clientCompanyIdentificationNumber = $clientCompanyIdentificationNumber;
        return $this;
    }

    public function getClientTaxIdentificationNumber(): ?string
    {
        return $this->clientTaxIdentificationNumber;
    }

    public function setClientTaxIdentificationNumber(?string $clientTaxIdentificationNumber): Settings
    {
        $this->clientTaxIdentificationNumber = $clientTaxIdentificationNumber;
        return $this;
    }

    public function getClientBankAccount(): ?string
    {
        return $this->clientBankAccount;
    }

    public function setClientBankAccount(?string $clientBankAccount): Settings
    {
        $this->clientBankAccount = $clientBankAccount;
        return $this;
    }

}
