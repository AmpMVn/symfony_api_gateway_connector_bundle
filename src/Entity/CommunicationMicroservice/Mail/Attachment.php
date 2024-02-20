<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\CommunicationMicroservice\Mail;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class Attachment implements \JsonSerializable
{
    protected ?int $id = null;

    protected $fileDataUri = null;

    protected ?string $fileName = null;

//    protected Mails $mails;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Attachment
    {
        $this->id = $id;
        return $this;
    }

    public function getFileDataUri()
    {
        return $this->fileDataUri;
    }

    public function setFileDataUri($fileDataUri): Attachment
    {
        $this->fileDataUri = $fileDataUri;
        return $this;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): Attachment
    {
        $this->fileName = $fileName;
        return $this;
    }

//    public function getMails(): Mails
//    {
//        return $this->mails;
//    }
//
//    public function setMails($invoice): Attachments
//    {
//        $serializer = new Serializer(
//            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
//            [new JsonEncoder()]
//        );
//
//        $this->mails = $serializer->deserialize(json_encode($invoice), Mail::class, 'json');
//
//        return $this;
//    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "fileName" => $this->getFileName(),
        ];
    }
}
