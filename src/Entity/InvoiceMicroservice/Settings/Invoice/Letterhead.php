<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\InvoiceMicroservice\Settings\Invoice;

use Rentsoft\ApiGatewayConnectorBundle\Entity\InvoiceMicroservice\Settings\Settings;
use Rentsoft\ApiGatewayConnectorBundle\Microservice\InvoiceMicroservice;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class Letterhead implements \JsonSerializable
{

    private int $id;

    public ?string $name = null;

    public ?string $fileName = null;

    public ?string $fileUrl = null;

    private int $topMargin = 0;

    private int $bottomMargin = 0;

    private bool $active;

    private ?string $data = null;

    private Settings|string $settings;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Letterhead
    {
        $this->id = $id;
        return $this;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(?string $data): Letterhead
    {
        $this->data = $data;
        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): Letterhead
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }

    public function setFileUrl(?string $fileUrl): Letterhead
    {
        $this->fileUrl = $fileUrl;
        return $this;
    }

    public function getTopMargin(): int
    {
        return $this->topMargin;
    }

    public function setTopMargin(int $topMargin): Letterhead
    {
        $this->topMargin = $topMargin;
        return $this;
    }

    public function getBottomMargin(): int
    {
        return $this->bottomMargin;
    }

    public function setBottomMargin(int $bottomMargin): Letterhead
    {
        $this->bottomMargin = $bottomMargin;
        return $this;
    }

    public function getSettings(): Settings|string
    {
        return $this->settings;
    }

    public function setSettings($settings): Letterhead
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->settings = $serializer->deserialize(json_encode($settings), Settings::class, 'json');

        return $this;
    }

    public function setSettingsString(Settings $settings): Letterhead
    {
        $this->settings = InvoiceMicroservice::URI_SETTINGS . '/' . $settings->getId();

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): Letterhead
    {
        $this->active = $active;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Letterhead
    {
        $this->name = $name;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->getId(),
            "fileName" => $this->getFileName(),
            "name" => $this->getName(),
            "fileUrl" => $this->getFileUrl(),
            "topMargin" => $this->getTopMargin(),
            "bottomMargin" => $this->getBottomMargin(),
            "active" => $this->isActive(),
        ];
    }

}
