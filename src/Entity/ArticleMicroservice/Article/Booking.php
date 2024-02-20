<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Article;

use DateTime;
use Rentsoft\ApiGatewayConnectorBundle\Microservice\ArticleMicroservice;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Booking
{
    protected $id;

    protected DateTime $createdAt;

    protected DateTime|string|null $updatedAt = null;

    protected DateTime|string $bookingStart;

    protected DateTime|string $bookingEnd;

    protected ?string $optionalData = null;

    protected Article|string $article;

    /**
     * @param Article $article
     */
    public function setArticle($article)
    {
        $serializer = new Serializer(
            [ new ObjectNormalizer() ],
            [ new JsonEncoder() ]
        );

        $this->article = $serializer->deserialize(json_encode($article), Article::class, 'json');
    }

    public function setArticleString(Article $article)
    {
        $this->article = ArticleMicroservice::URI_ARTICLES . '/' . $article->getId();
    }

    public function setCreatedAt(DateTime|string $createdAt)
    {
        if (is_string($createdAt)) {
            $this->createdAt = new DateTime($createdAt);
        } else {
            $this->createdAt = $createdAt;
        }
    }

    public function setUpdatedAt(DateTime|string $updatedAt)
    {
        if (is_string($updatedAt)) {
            $this->updatedAt = new DateTime($updatedAt);
        } else {
            $this->updatedAt = $updatedAt;
        }
    }

    public function setBookingStart(DateTime|string $bookingStart)
    {
        if (is_string($bookingStart)) {
            $this->bookingStart = new DateTime($bookingStart);
        } else {
            $this->bookingStart = $bookingStart;
        }
    }

    public function setBookingStartString(string $bookingStart)
    {
        $this->bookingStart = $bookingStart;
    }

    public function setBookingEnd(DateTime|string $bookingEnd)
    {
        if (is_string($bookingEnd)) {
            $this->bookingEnd = new DateTime($bookingEnd);
        } else {
            $this->bookingEnd = $bookingEnd;
        }
    }


    public function setBookingEndString(string $bookingEnd)
    {
        $this->bookingEnd = $bookingEnd;
    }

    public function __construct() {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime|string|null
     */
    public function getUpdatedAt(): DateTime|string|null
    {
        return $this->updatedAt;
    }

    /**
     * @return DateTime|string|null
     */
    public function getBookingStart(): DateTime|string|null
    {
        return $this->bookingStart;
    }

    /**
     * @return DateTime|string|null
     */
    public function getBookingEnd(): DateTime|string|null
    {
        return $this->bookingEnd;
    }

    /**
     * @return string|null
     */
    public function getOptionalData(): ?string
    {
        return $this->optionalData;
    }

    /**
     * @param string|null $optionalData
     */
    public function setOptionalData(?string $optionalData): void
    {
        $this->optionalData = $optionalData;
    }

    /**
     * @return Article|string
     */
    public function getArticle(): string|Article
    {
        return $this->article;
    }

}
