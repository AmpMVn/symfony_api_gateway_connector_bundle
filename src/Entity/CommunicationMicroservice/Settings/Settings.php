<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\CommunicationMicroservice\Settings;

use DateTime;
use Rentsoft\ApiGatewayConnectorBundle\Entity\CommunicationMicroservice\Mail\Mail;
use Doctrine\Common\Collections\ArrayCollection;

class Settings
{
    protected ?int $id = null;

    protected ?string $clientId;

    protected DateTime|string $createdAt;

    protected DateTime|string|null $updatedAt;

    protected Mail $mails;

    protected ?string $smtpHost = null;

    protected ?string $smtpServer = null;

    protected ?string $smtpPassword = null;

    protected ?int $smtpPort = null;

    protected ?string $smtpSecurity = null;

    protected ?string $smtpSenderName = null;

    protected ?string $smtpSenderMail = null;

//    public function __construct()
//    {
//        $this->mails = new ArrayCollection();
//    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Settings
    {
        $this->id = $id;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

//    public function setCreatedAt(DateTime $createdAt): Settings
//    {
//        $this->createdAt = $createdAt;
//        return $this;
//    }

    public function setCreatedAt(DateTime|string $createdAt): Settings
    {
        $this->createdAt = is_string($createdAt) ? new DateTime($createdAt) : $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime|string|null $updatedAt): Settings
    {
        $this->updatedAt = $updatedAt;
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

    public function getMails(): Collection
    {
        return $this->mails;
    }

    public function setMails($invoice): Settings
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->mails = $serializer->deserialize(json_encode($invoice), Mail::class, 'json');

        return $this;
    }

//    public function getMailsToSend(): Collection
//    {
//        return $this->mails->filter(function (Mails $mails) {
//            return $mails->getStatus() === 1;
//        });
//    }

    public function getSmtpHost(): ?string
    {
        return $this->smtpHost;
    }

    public function setSmtpHost(?string $smtpHost): Settings
    {
        $this->smtpHost = $smtpHost;
        return $this;
    }

    public function getSmtpPassword(): ?string
    {
        return $this->smtpPassword;
    }

    public function setSmtpPassword(?string $smtpPassword): Settings
    {
        $this->smtpPassword = $smtpPassword;
        return $this;
    }

    public function getSmtpPort(): ?int
    {
        return $this->smtpPort;
    }

    public function setSmtpPort(?int $smtpPort): Settings
    {
        $this->smtpPort = $smtpPort;
        return $this;
    }

    public function getSmtpSenderName(): ?string
    {
        return $this->smtpSenderName;
    }

    public function setSmtpSenderName(?string $smtpSenderName): Settings
    {
        $this->smtpSenderName = $smtpSenderName;
        return $this;
    }

    public function getSmtpSenderMail(): ?string
    {
        return $this->smtpSenderMail;
    }

    public function setSmtpSenderMail(?string $smtpSenderMail): Settings
    {
        $this->smtpSenderMail = $smtpSenderMail;
        return $this;
    }

    public function getSmtpServer(): ?string
    {
        return $this->smtpServer;
    }

    public function setSmtpServer(?string $smtpServer): Settings
    {
        $this->smtpServer = $smtpServer;
        return $this;
    }
}
