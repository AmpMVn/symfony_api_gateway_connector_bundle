<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Settings;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Category
{

    protected int $id;

    protected string $name;

    protected int $lft;

    protected int $rgt;

    protected int $lvl;

    protected bool $enableOnlineBooking;

    protected Category $root;

    protected ?Category $parent;

    protected Collection $children;

    /**
     * @param Category $root
     */
    public function setRoot($root)
    {
        $serializer = new Serializer(
            [ new ObjectNormalizer() ],
            [ new JsonEncoder() ]
        );

        $this->root = $serializer->deserialize(json_encode($root), Category::class, 'json');
    }

    /**
     * @param Category $parent
     */
    public function setParent($parent)
    {
        $serializer = new Serializer(
            [ new ObjectNormalizer() ],
            [ new JsonEncoder() ]
        );

        $this->parent = $serializer->deserialize(json_encode($parent), Category::class, 'json');
    }

    /**
     * @param Collection $children
     */
    public function setChildren($children)
    {
        $serializer = new Serializer(
            [ new GetSetMethodNormalizer(), new ArrayDenormalizer() ],
            [ new JsonEncoder() ]
        );

        $this->children = new ArrayCollection($serializer->deserialize(json_encode($children), Category::class . '[]', 'json'));
    }

    public function __construct() {
        $this->children = new ArrayCollection();
    }

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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getLft(): int
    {
        return $this->lft;
    }

    /**
     * @param int $lft
     */
    public function setLft(int $lft): void
    {
        $this->lft = $lft;
    }

    /**
     * @return int
     */
    public function getRgt(): int
    {
        return $this->rgt;
    }

    /**
     * @param int $rgt
     */
    public function setRgt(int $rgt): void
    {
        $this->rgt = $rgt;
    }

    /**
     * @return int
     */
    public function getLvl(): int
    {
        return $this->lvl;
    }

    /**
     * @param int $lvl
     */
    public function setLvl(int $lvl): void
    {
        $this->lvl = $lvl;
    }

    /**
     * @return bool
     */
    public function isEnableOnlineBooking(): bool
    {
        return $this->enableOnlineBooking;
    }

    /**
     * @param bool $enableOnlineBooking
     */
    public function setEnableOnlineBooking(bool $enableOnlineBooking): void
    {
        $this->enableOnlineBooking = $enableOnlineBooking;
    }

    /**
     * @return Category
     */
    public function getRoot(): Category
    {
        return $this->root;
    }

    /**
     * @return Category|null
     */
    public function getParent(): ?Category
    {
        return $this->parent;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getChildren(): ArrayCollection|Collection
    {
        return $this->children;
    }

}
