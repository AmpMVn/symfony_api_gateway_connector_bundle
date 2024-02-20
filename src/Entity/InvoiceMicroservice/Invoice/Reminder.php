<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\InvoiceMicroservice\Invoice;

use DateTime;
use Rentsoft\ApiGatewayConnectorBundle\Microservice\InvoiceMicroservice;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class Reminder
{

    protected int $id;

    protected DateTime|string $reminderDate;

    protected DateTime|string $reminderDueDate;

    protected int $step;

    protected ?string $pdfPath;

    protected ?string $pdfFilename;

    protected ?string $pdfUrl;

    protected bool $lastReminder;

    protected bool $overdue;

    protected Invoice|string $invoice;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Reminder
    {
        $this->id = $id;
        return $this;
    }


    public function getReminderDate(): DateTime|string
    {
        return $this->reminderDate;
    }

    public function setReminderDate(DateTime|string $reminderDate): Reminder
    {
        $this->reminderDate = is_string($reminderDate) ? new DateTime($reminderDate) : $reminderDate;
        return $this;
    }

    public function setReminderDateString(string $reminderDate): Reminder
    {
        $this->reminderDate = $reminderDate;
        return $this;
    }

    public function getReminderDueDate(): DateTime|string
    {
        return $this->reminderDueDate;
    }

    public function setReminderDueDate(DateTime|string $reminderDueDate): Reminder
    {
        $this->reminderDueDate = is_string($reminderDueDate) ? new DateTime($reminderDueDate) : $reminderDueDate;
        return $this;
    }

    public function setReminderDueDateString(string $reminderDueDate): Reminder
    {
        $this->reminderDueDate = $reminderDueDate;
        return $this;
    }

    public function getInvoice(): Invoice|string
    {
        return $this->invoice;
    }

    public function setInvoice($invoice): Reminder
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->invoice = $serializer->deserialize(json_encode($invoice), Invoice::class, 'json');

        return $this;
    }

    public function setInvoiceString(Invoice $invoice): Reminder
    {
        $this->invoice = InvoiceMicroservice::URI_INVOICES . '/' . $invoice->getId();

        return $this;
    }

    public function getStep(): int
    {
        return $this->step;
    }

    public function setStep(int $step): Reminder
    {
        $this->step = $step;
        return $this;
    }

    public function getPdfFilename(): ?string
    {
        return $this->pdfFilename;
    }

    public function setPdfFilename(?string $pdfFilename): Reminder
    {
        $this->pdfFilename = $pdfFilename;
        return $this;
    }

    public function getPdfUrl(): ?string
    {
        return $this->pdfUrl;
    }

    public function setPdfUrl(?string $pdfUrl): Reminder
    {
        $this->pdfUrl = $pdfUrl;
        return $this;
    }

    public function getPdfPath(): ?string
    {
        return $this->pdfPath;
    }

    public function setPdfPath(?string $pdfPath): Reminder
    {
        $this->pdfPath = $pdfPath;
        return $this;
    }

    public function isLastReminder(): bool
    {
        return $this->lastReminder;
    }

    public function setLastReminder(bool $lastReminder): Reminder
    {
        $this->lastReminder = $lastReminder;
        return $this;
    }

    public function isOverdue(): bool
    {
        return $this->overdue;
    }

    public function setOverdue(bool $overdue): Reminder
    {
        $this->overdue = $overdue;
        return $this;
    }

}
