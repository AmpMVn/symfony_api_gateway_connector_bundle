<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Article;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Accessories
{

    protected int $id;

    protected int $maxCount;

    protected bool $requiredMsOnlineBooking;

    protected bool $enableSingleSelectionRule;

    protected bool $enabledMsOnlineBooking;

    protected bool $takeoverInProcess;

    protected ?string $groupName = null;

    protected ?Article $articleParent;

    protected ?Article $articleChild;

    /**
     * @param Article $article
     */
    public function setArticleParent($article)
    {
        $serializer = new Serializer(
            [ new ObjectNormalizer() ],
            [ new JsonEncoder() ]
        );

        $this->articleParent = $serializer->deserialize(json_encode($article), Article::class, 'json');
    }

    /**
     * @param Article $article
     */
    public function setArticleChild($article)
    {
        $serializer = new Serializer(
            [ new ObjectNormalizer() ],
            [ new JsonEncoder() ]
        );

        $this->articleChild = $serializer->deserialize(json_encode($article), Article::class, 'json');
    }

    public function __construct() {
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
     * @return int
     */
    public function getMaxCount(): int
    {
        return $this->maxCount;
    }

    /**
     * @param int $maxCount
     */
    public function setMaxCount(int $maxCount): void
    {
        $this->maxCount = $maxCount;
    }

    /**
     * @return bool
     */
    public function isRequiredMsOnlineBooking(): bool
    {
        return $this->requiredMsOnlineBooking;
    }

    /**
     * @param bool $requiredMsOnlineBooking
     */
    public function setRequiredMsOnlineBooking(bool $requiredMsOnlineBooking): void
    {
        $this->requiredMsOnlineBooking = $requiredMsOnlineBooking;
    }

    /**
     * @return bool
     */
    public function isEnabledMsOnlineBooking(): bool
    {
        return $this->enabledMsOnlineBooking;
    }

    /**
     * @param bool $enabledMsOnlineBooking
     */
    public function setEnabledMsOnlineBooking(bool $enabledMsOnlineBooking): void
    {
        $this->enabledMsOnlineBooking = $enabledMsOnlineBooking;
    }

    /**
     * @return bool
     */
    public function isTakeoverInProcess(): bool
    {
        return $this->takeoverInProcess;
    }

    /**
     * @param bool $takeoverInProcess
     */
    public function setTakeoverInProcess(bool $takeoverInProcess): void
    {
        $this->takeoverInProcess = $takeoverInProcess;
    }

    /**
     * @return Article|null
     */
    public function getArticleParent(): ?Article
    {
        return $this->articleParent;
    }

    /**
     * @return Article|null
     */
    public function getArticleChild(): ?Article
    {
        return $this->articleChild;
    }

    /**
     * @return string|null
     */
    public function getGroupName(): ?string
    {
        return $this->groupName;
    }

    /**
     * @param string|null $groupName
     */
    public function setGroupName(?string $groupName): void
    {
        $this->groupName = $groupName;
    }

    /**
     * @return bool
     */
    public function isEnableSingleSelectionRule(): bool
    {
        return $this->enableSingleSelectionRule;
    }

    /**
     * @param bool $enableSingleSelectionRule
     */
    public function setEnableSingleSelectionRule(bool $enableSingleSelectionRule): void
    {
        $this->enableSingleSelectionRule = $enableSingleSelectionRule;
    }


}
