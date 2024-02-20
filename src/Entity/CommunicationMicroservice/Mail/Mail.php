<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\CommunicationMicroservice\Mail;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Rentsoft\ApiGatewayConnectorBundle\Entity\CommunicationMicroservice\Settings\Settings;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class Mail
{
    protected int $id;

    protected string $clientId;

    protected DateTime|string $createdAt;

    protected DateTime|string $updatedAt;

    protected DateTime|string|null $sendDate = null;

    protected string $receiverName;

    protected string $receiverMail;

    protected string $subject;

    protected string $content;

    protected int $status = 0;

    protected string|null $errorMessage = null;

    protected string|null $header = null;

    protected string $language = 'de';

//    protected array $settings;

    protected Collection $attachments;

    public function __construct() {
        $this->attachments = new ArrayCollection();
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id) : Mail
    {
        $this->id = $id;
        return $this;
    }

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    public function setClientId(?string $clientId): Mail
    {
        $this->clientId = $clientId;
        return $this;
    }

    public function getCreatedAt() : DateTime|string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime|string $createdAt) : Mail
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt() : DateTime|string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime|string $updatedAt) : Mail
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getSendDate() : DateTime|string|null
    {
        return $this->sendDate;
    }

    public function setSendDate(DateTime|string|null $sendDate) : Mail
    {
        $this->sendDate = $sendDate;
        return $this;
    }

    public function getReceiverName() : string
    {
        return $this->receiverName;
    }

    public function setReceiverName(string $receiverName) : Mail
    {
        $this->receiverName = $receiverName;
        return $this;
    }

    public function getReceiverMail() : string
    {
        return $this->receiverMail;
    }

    public function setReceiverMail(string $receiverMail) : Mail
    {
        $this->receiverMail = $receiverMail;
        return $this;
    }

    public function getSubject() : string
    {
        return $this->subject;
    }

    public function setSubject(string $subject) : Mail
    {
        $this->subject = $subject;
        return $this;
    }

    public function getContent() : string
    {
        return $this->content;
    }

    public function setContent(string $content) : Mail
    {
        $this->content = $content;
        return $this;
    }

    public function getStatus() : int
    {
        return $this->status;
    }

    public function setStatus(int $status) : Mail
    {
        $this->status = $status;
        return $this;
    }

    public function getErrorMessage() : ?string
    {
        return $this->errorMessage;
    }

    public function setErrorMessage(?string $errorMessage) : Mail
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    public function getHeader(): ?string
    {
        return $this->header;
    }

    public function setHeader(?string $header): Mail
    {
        $this->header = $header;
        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): Mail
    {
        $this->language = $language;
        return $this;
    }

//    public function getSettings()
//    {
//        return $this->settings;
//    }
//
//    public function setSettings(?Settings $settings): Mail
//    {
//        $serializer = new Serializer(
//            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
//            [new JsonEncoder()]
//        );
//
//        $this->settings = $serializer->deserialize(json_encode($settings), Settings::class, 'json');
//        return $this;
//    }

    public function getAttachments(): Collection
    {
        return $this->attachments;
    }

    public function setAttachments($attachments): Mail
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->attachments = new ArrayCollection($serializer->deserialize(json_encode($attachments), Attachment::class . '[]', 'json'));
        return $this;
    }
}
