<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Setting\AdditionalField;

class Entry
{

    protected int $id;

    protected string $name;

    protected ?string $nameAddon = null;

    protected string $type;

    protected ?string $placeholder = null;

    protected ?string $cssClass = null;

    protected ?string $values = null;

    protected int $cssColumn;

    protected int $prio;

    protected bool $required;

    public function getValuesArray(): array
    {
        return (array)json_decode($this->values);
    }

    public function __construct(){}

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getNameAddon(): ?string
    {
        return $this->nameAddon;
    }

    /**
     * @param string|null $nameAddon
     */
    public function setNameAddon(?string $nameAddon): void
    {
        $this->nameAddon = $nameAddon;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }

    /**
     * @param string|null $placeholder
     */
    public function setPlaceholder(?string $placeholder): void
    {
        $this->placeholder = $placeholder;
    }

    /**
     * @return string|null
     */
    public function getCssClass(): ?string
    {
        return $this->cssClass;
    }

    /**
     * @param string|null $cssClass
     */
    public function setCssClass(?string $cssClass): void
    {
        $this->cssClass = $cssClass;
    }

    /**
     * @return string|null
     */
    public function getValues(): ?string
    {
        return $this->values;
    }

    /**
     * @param string|null $values
     */
    public function setValues(?string $values): void
    {
        $this->values = $values;
    }

    /**
     * @return int
     */
    public function getCssColumn(): int
    {
        return $this->cssColumn;
    }

    /**
     * @param int $cssColumn
     */
    public function setCssColumn(int $cssColumn): void
    {
        $this->cssColumn = $cssColumn;
    }

    /**
     * @return int
     */
    public function getPrio(): int
    {
        return $this->prio;
    }

    /**
     * @param int $prio
     */
    public function setPrio(int $prio): void
    {
        $this->prio = $prio;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     */
    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }
}
