<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\InvoiceMicroservice\Invoice;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Rentsoft\ApiGatewayConnectorBundle\Entity\InvoiceMicroservice\Settings\Invoice\Letterhead;
use Rentsoft\ApiGatewayConnectorBundle\Microservice\InvoiceMicroservice;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class Invoice
{

    protected int $id;

    protected ?string $clientId = null;

    protected ?string $paymentIdentifier = null;

    protected Letterhead|string|null $letterhead = null;

    protected string $language;

    protected DateTime|string $invoiceDate;

    protected DateTime|string|null $invoiceDueDate;

    protected DateTime|string $remindersStartDate;

    protected ?int $daysBetweenReminders = null;

    protected ?int $maxReminders = null;

    protected ?string $clientName = null;

    protected ?string $clientStreet = null;

    protected ?string $clientZip = null;

    protected ?string $clientCity = null;

    protected ?string $clientCountry = null;

    protected ?string $clientPhone = null;

    protected ?string $clientEmail = null;

    protected ?string $clientCompanyIdentificationNumber = null;

    protected ?string $clientTaxIdentificationNumber = null;

    protected ?string $clientBankAccount = null;

    protected ?string $customerIdentifier = null;

    protected ?string $customerName = null;

    protected ?string $customerStreet = null;

    protected ?string $customerZip = null;

    protected ?string $customerCity = null;

    protected ?string $customerCountry = null;

    protected ?string $customerPhone = null;

    protected ?string $customerEmail = null;

    protected ?string $customerCompanyIdentificationNumber = null;

    protected ?string $customerTaxIdentificationNumber = null;

    protected ?int $invoiceNumber = null;

    protected int $invoiceYear;

    protected Collection $items;

    protected ?string $pdfFilename = null;

    protected ?string $pdfUrl = null;

    protected bool $paid;

    protected bool $remindersPaused;

    protected Collection $reminders;

    protected bool $overdue;

    protected array $vats;

    protected int $grossTotal;

    protected int $netTotal;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->reminders = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Invoice
    {
        $this->id = $id;
        return $this;
    }

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    public function setClientId(string $clientId): Invoice
    {
        $this->clientId = $clientId;
        return $this;
    }

    public function getLetterhead(): Letterhead|string|null
    {
        return $this->letterhead;
    }

    public function setLetterhead($letterhead): Invoice
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->letterhead = $serializer->deserialize(json_encode($letterhead), Letterhead::class, 'json');

        return $this;
    }

    public function setLetterheadString(Letterhead $letterhead): Invoice
    {
        $this->letterhead = InvoiceMicroservice::URI_LETTERHEADS . '/' . $letterhead->getId();

        return $this;
    }

    public function getInvoiceDate(): DateTime|string
    {
        return $this->invoiceDate;
    }

    public function setInvoiceDate(DateTime|string $invoiceDate): Invoice
    {
        $this->invoiceDate = is_string($invoiceDate) ? new DateTime($invoiceDate) : $invoiceDate;

        return $this;
    }

    public function setInvoiceDateString(string $invoiceDate): Invoice
    {
        $this->invoiceDate = $invoiceDate;

        return $this;
    }

    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    public function setCustomerName(?string $customerName): Invoice
    {
        $this->customerName = $customerName;

        return $this;
    }

    public function getCustomerStreet(): ?string
    {
        return $this->customerStreet;
    }

    public function setCustomerStreet(?string $customerStreet): Invoice
    {
        $this->customerStreet = $customerStreet;

        return $this;
    }

    public function getCustomerZip(): ?string
    {
        return $this->customerZip;
    }

    public function setCustomerZip(?string $customerZip): Invoice
    {
        $this->customerZip = $customerZip;

        return $this;
    }

    public function getCustomerCity(): ?string
    {
        return $this->customerCity;
    }

    public function setCustomerCity(?string $customerCity): Invoice
    {
        $this->customerCity = $customerCity;

        return $this;
    }

    public function getCustomerCountry(): ?string
    {
        return $this->customerCountry;
    }

    public function setCustomerCountry(?string $customerCountry): Invoice
    {
        $this->customerCountry = $customerCountry;

        return $this;
    }

    public function getCustomerTaxIdentificationNumber(): ?string
    {
        return $this->customerTaxIdentificationNumber;
    }

    public function setCustomerTaxIdentificationNumber(?string $customerTaxIdentificationNumber): Invoice
    {
        $this->customerTaxIdentificationNumber = $customerTaxIdentificationNumber;

        return $this;
    }

    public function getInvoiceNumber(): ?int
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(?int $invoiceNumber): Invoice
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    public function getInvoiceYear(): int
    {
        return $this->invoiceYear;
    }

    public function setInvoiceYear(int $invoiceYear): Invoice
    {
        $this->invoiceYear = $invoiceYear;

        return $this;
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function setItems($items): Invoice
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->items = new ArrayCollection($serializer->deserialize(json_encode($items), Item::class . '[]', 'json'));
        return $this;
    }

    public function getReminders(): array
    {
        return $this->reminders->getValues();
    }

    public function setReminders($reminders): Invoice
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->reminders = new ArrayCollection($serializer->deserialize(json_encode($reminders), Reminder::class . '[]', 'json'));
        return $this;
    }

    public function getPdfFilename(): ?string
    {
        return $this->pdfFilename;
    }

    public function setPdfFilename(?string $pdfFilename): Invoice
    {
        $this->pdfFilename = $pdfFilename;
        return $this;
    }

    public function getPdfUrl(): ?string
    {
        return $this->pdfUrl;
    }

    public function setPdfUrl(?string $pdfUrl): Invoice
    {
        $this->pdfUrl = $pdfUrl;
        return $this;
    }

    public function getCustomerPhone(): ?string
    {
        return $this->customerPhone;
    }

    public function setCustomerPhone(?string $customerPhone): Invoice
    {
        $this->customerPhone = $customerPhone;
        return $this;
    }

    public function getCustomerEmail(): ?string
    {
        return $this->customerEmail;
    }

    public function setCustomerEmail(?string $customerEmail): Invoice
    {
        $this->customerEmail = $customerEmail;
        return $this;
    }

    public function getPaymentIdentifier(): ?string
    {
        return $this->paymentIdentifier;
    }

    public function setPaymentIdentifier(?string $paymentIdentifier): Invoice
    {
        $this->paymentIdentifier = $paymentIdentifier;
        return $this;
    }

    public function getClientName(): ?string
    {
        return $this->clientName;
    }

    public function setClientName(?string $clientName): Invoice
    {
        $this->clientName = $clientName;
        return $this;
    }

    public function getClientStreet(): ?string
    {
        return $this->clientStreet;
    }

    public function setClientStreet(?string $clientStreet): Invoice
    {
        $this->clientStreet = $clientStreet;
        return $this;
    }

    public function getClientZip(): ?string
    {
        return $this->clientZip;
    }

    public function setClientZip(?string $clientZip): Invoice
    {
        $this->clientZip = $clientZip;
        return $this;
    }

    public function getClientCity(): ?string
    {
        return $this->clientCity;
    }

    public function setClientCity(?string $clientCity): Invoice
    {
        $this->clientCity = $clientCity;
        return $this;
    }

    public function getClientCountry(): ?string
    {
        return $this->clientCountry;
    }

    public function setClientCountry(?string $clientCountry): Invoice
    {
        $this->clientCountry = $clientCountry;
        return $this;
    }

    public function getClientPhone(): ?string
    {
        return $this->clientPhone;
    }

    public function setClientPhone(?string $clientPhone): Invoice
    {
        $this->clientPhone = $clientPhone;
        return $this;
    }

    public function getClientEmail(): ?string
    {
        return $this->clientEmail;
    }

    public function setClientEmail(?string $clientEmail): Invoice
    {
        $this->clientEmail = $clientEmail;
        return $this;
    }

    public function getClientTaxIdentificationNumber(): ?string
    {
        return $this->clientTaxIdentificationNumber;
    }

    public function setClientTaxIdentificationNumber(?string $clientTaxIdentificationNumber): Invoice
    {
        $this->clientTaxIdentificationNumber = $clientTaxIdentificationNumber;
        return $this;
    }

    public function getInvoiceDueDate(): DateTime|string|null
    {
        return $this->invoiceDueDate;
    }

    public function setInvoiceDueDate(DateTime|string|null $invoiceDueDate): Invoice
    {
        $this->invoiceDueDate = is_string($invoiceDueDate) ? new DateTime($invoiceDueDate) : $invoiceDueDate;
        return $this;
    }

    public function setInvoiceDueDateString(string|null $invoiceDueDate): Invoice
    {
        $this->invoiceDueDate = $invoiceDueDate;
        return $this;
    }

    public function getClientCompanyIdentificationNumber(): ?string
    {
        return $this->clientCompanyIdentificationNumber;
    }

    public function setClientCompanyIdentificationNumber(?string $clientCompanyIdentificationNumber): Invoice
    {
        $this->clientCompanyIdentificationNumber = $clientCompanyIdentificationNumber;
        return $this;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): Invoice
    {
        $this->language = $language;
        return $this;
    }

    public function isPaid(): bool
    {
        return $this->paid;
    }

    public function setPaid(bool $paid): Invoice
    {
        $this->paid = $paid;
        return $this;
    }

    public function getClientBankAccount(): ?string
    {
        return $this->clientBankAccount;
    }

    public function setClientBankAccount(?string $clientBankAccount): Invoice
    {
        $this->clientBankAccount = $clientBankAccount;
        return $this;
    }

    public function getCustomerIdentifier(): ?string
    {
        return $this->customerIdentifier;
    }

    public function setCustomerIdentifier(?string $customerIdentifier): Invoice
    {
        $this->customerIdentifier = $customerIdentifier;
        return $this;
    }

    public function getCustomerCompanyIdentificationNumber(): ?string
    {
        return $this->customerCompanyIdentificationNumber;
    }

    public function setCustomerCompanyIdentificationNumber(?string $customerCompanyIdentificationNumber): Invoice
    {
        $this->customerCompanyIdentificationNumber = $customerCompanyIdentificationNumber;
        return $this;
    }

    public function isRemindersPaused(): bool
    {
        return $this->remindersPaused;
    }

    public function setRemindersPaused(bool $remindersPaused): Invoice
    {
        $this->remindersPaused = $remindersPaused;
        return $this;
    }

    public function getVats(): array
    {
        return $this->vats;
    }

    public function getGrossTotal(): int
    {
        return $this->grossTotal;
    }

    public function getNetTotal(): int
    {
        return $this->netTotal;
    }

    public function setVats(array $vats): Invoice
    {
        $this->vats = $vats;
        return $this;
    }

    public function setGrossTotal(int $grossTotal): Invoice
    {
        $this->grossTotal = $grossTotal;
        return $this;
    }

    public function setNetTotal(int $netTotal): Invoice
    {
        $this->netTotal = $netTotal;
        return $this;
    }

    public function getRemindersStartDate(): DateTime|string
    {
        return $this->remindersStartDate;
    }

    public function setRemindersStartDate(DateTime|string $remindersStartDate): Invoice
    {
        $this->remindersStartDate = $remindersStartDate;
        return $this;
    }

    public function setRemindersStartDateString(string $remindersStartDate): Invoice
    {
        $this->remindersStartDate = $remindersStartDate;
        return $this;
    }

    public function getDaysBetweenReminders(): ?int
    {
        return $this->daysBetweenReminders;
    }

    public function setDaysBetweenReminders(?int $daysBetweenReminders): Invoice
    {
        $this->daysBetweenReminders = $daysBetweenReminders;
        return $this;
    }

    public function getMaxReminders(): ?int
    {
        return $this->maxReminders;
    }

    public function setMaxReminders(?int $maxReminders): Invoice
    {
        $this->maxReminders = $maxReminders;
        return $this;
    }

    public function isOverdue(): bool
    {
        return $this->overdue;
    }

    public function setOverdue(bool $overdue): Invoice
    {
        $this->overdue = $overdue;
        return $this;
    }

}
