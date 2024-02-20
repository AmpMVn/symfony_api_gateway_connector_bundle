<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\ArticleGroup;

use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Article\Article;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Accessories
{

    protected int $id;

    protected int $maxCount;

    protected bool $requiredMsOnlineBooking;

    protected bool $enabledMsOnlineBooking;

    protected ?string $groupName = null;

    protected ?ArticleGroup $articleGroup;

    protected ?Article $articleChild;

    /**
     * @param ArticleGroup $articleGroup
     */
    public function setArticleGroup($articleGroup)
    {
        $serializer = new Serializer(
            [ new ObjectNormalizer() ],
            [ new JsonEncoder() ]
        );

        $this->articleGroup = $serializer->deserialize(json_encode($articleGroup), ArticleGroup::class, 'json');
    }

    /**
     * @param Article $articleChild
     */
    public function setArticleChild($articleChild)
    {
        $serializer = new Serializer(
            [ new ObjectNormalizer() ],
            [ new JsonEncoder() ]
        );

        $this->articleChild = $serializer->deserialize(json_encode($articleChild), Article::class, 'json');
    }

    public function __construct() {
    }

    /**
     * @return ArticleGroup|null
     */
    public function getArticleGroup(): ?ArticleGroup
    {
        return $this->articleGroup;
    }

    /**
     * @return Article|null
     */
    public function getArticleChild(): ?Article
    {
        return $this->articleChild;
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


}
