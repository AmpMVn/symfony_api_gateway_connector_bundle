<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Article;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Client\Client;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Price\Deal\Deal;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Price\Discount\Discount;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Price\Rate\Group;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Settings\Category;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Settings\Location;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Settings\Storage\Storage;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Article
{
    protected int $id;

    protected string $name;

    protected ?string $manufacturer;

    protected ?string $model;

    protected ?string $modelDescription;

    protected string $articleId;

    protected int $quantityType;

    protected int $quantity;

    protected ?string $description;

    protected ?string $descriptionTeaser;

    protected ?string $serialNumber;

    protected ?string $serialCode;

    protected ?string $articleValue1;

    protected ?string $articleValue2;

    protected ?string $articleValue3;

    protected ?string $codeContent;

    protected ?string $articleUse;

    protected string $articleType;

    protected ?string $articleCounter;

    protected ?string $articleCounterType;

    protected ?string $tags;

    protected ?array $filters;

    protected ?string $relevance;

    protected ?int $defaultPriceCalculation;

    protected ?float $priceFix;

    protected ?float $priceDisplay;

    protected ?float $priceDeposit;

    protected int $status;

    protected bool $isAvailable = false;

    protected ?Category $category = null;

    protected ?Storage $storage = null;

    protected ?Location $location = null;

    protected Collection $images;

    protected Collection $attributes;

    protected Collection $stocks;

    protected Collection $accessories;

    protected Collection $priceRates;

    protected Collection $priceDeals;

    protected Collection $priceDiscounts;

    protected Collection $bookings;

    protected string $clientId;

    /**
     * @return mixed
     */
    public function getMainImage()
    {
        /** @var Image $image */
        foreach ($this->getImages() as $image) {
            if ($image->getMainImage() == true) {
                return $image->getFilepath();
            }
        }

        //return $this->mainImage;
    }

    /**
     * @param Collection $images
     */
    public function setImages($images)
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->images = new ArrayCollection($serializer->deserialize(json_encode($images), Image::class . '[]', 'json'));
    }

    /**
     * @param Collection $attributes
     */
    public function setAttributes($attributes)
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->attributes = new ArrayCollection($serializer->deserialize(json_encode($attributes), Attributte::class . '[]', 'json'));
    }

    /**
     * @param Category $category
     */
    public function setCategory($category)
    {
        if ($category != null) {
            $serializer = new Serializer(
                [new ObjectNormalizer()],
                [new JsonEncoder()]
            );

            $this->category = $serializer->deserialize(json_encode($category), Category::class, 'json');
        }
    }

    /**
     * @param Storage $storage
     */
    public function setStorage($storage)
    {
        if ($storage != null) {
            $serializer = new Serializer(
                [new ObjectNormalizer()],
                [new JsonEncoder()]
            );

            $this->storage = $serializer->deserialize(json_encode($storage), Storage::class, 'json');
        }
    }

    /**
     * @param Location $location
     */
    public function setLocation($location)
    {
        if ($location != null) {
            $serializer = new Serializer(
                [new ObjectNormalizer()],
                [new JsonEncoder()]
            );

            $this->location = $serializer->deserialize(json_encode($location), Location::class, 'json');
        }
    }

    /**
     * @param Collection $stocks
     */
    public function setStocks($stocks)
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->stocks = new ArrayCollection($serializer->deserialize(json_encode($stocks), Stock::class . '[]', 'json'));
    }

    /**
     * @param Collection $accessories
     */
    public function setAccessories($accessories)
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->accessories = new ArrayCollection($serializer->deserialize(json_encode($accessories), Accessories::class . '[]', 'json'));
    }

    /**
     * @param Collection $priceRates
     */
    public function setPriceRates($priceRates)
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->priceRates = new ArrayCollection($serializer->deserialize(json_encode($priceRates), Group::class . '[]', 'json'));
    }

    /**
     * @param Collection $priceDiscounts
     */
    public function setPriceDiscounts($priceDiscounts)
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->priceDiscounts = new ArrayCollection($serializer->deserialize(json_encode($priceDiscounts), Discount::class . '[]', 'json'));
    }

    /**
     * @param Collection $priceDeals
     */
    public function setPriceDeals($priceDeals)
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->priceDeals = new ArrayCollection($serializer->deserialize(json_encode($priceDeals), Deal::class . '[]', 'json'));
    }

    /**
     * @param Collection $bookings
     */
    public function setBookings($bookings)
    {
        $serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $this->bookings = new ArrayCollection($serializer->deserialize(json_encode($bookings), Booking::class . '[]', 'json'));
    }

    public function addBooking(Booking $object): void
    {
        if (!$this->bookings->contains($object)) {
            $this->bookings[] = $object;
            $object->setArticle($this);
            $this->bookings->add($object);
        }
    }


    public function __construct()
    {
        $this->filters = [];
        $this->images = new ArrayCollection();
        $this->attributes = new ArrayCollection();
        $this->stocks = new ArrayCollection();
        $this->accessories = new ArrayCollection();
        $this->priceRates = new ArrayCollection();
        $this->priceDiscounts = new ArrayCollection();
        $this->priceDeals = new ArrayCollection();
        $this->bookings = new ArrayCollection();
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
    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    /**
     * @param string|null $manufacturer
     */
    public function setManufacturer(?string $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * @return string|null
     */
    public function getModel(): ?string
    {
        return $this->model;
    }

    /**
     * @param string|null $model
     */
    public function setModel(?string $model): void
    {
        $this->model = $model;
    }

    /**
     * @return string|null
     */
    public function getModelDescription(): ?string
    {
        return $this->modelDescription;
    }

    /**
     * @param string|null $modelDescription
     */
    public function setModelDescription(?string $modelDescription): void
    {
        $this->modelDescription = $modelDescription;
    }

    /**
     * @return string
     */
    public function getArticleId(): string
    {
        return $this->articleId;
    }

    /**
     * @param string $articleId
     */
    public function setArticleId(string $articleId): void
    {
        $this->articleId = $articleId;
    }

    /**
     * @return int
     */
    public function getQuantityType(): int
    {
        return $this->quantityType;
    }

    /**
     * @param int $quantityType
     */
    public function setQuantityType(int $quantityType): void
    {
        $this->quantityType = $quantityType;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getDescriptionTeaser(): ?string
    {
        return $this->descriptionTeaser;
    }

    /**
     * @param string|null $descriptionTeaser
     */
    public function setDescriptionTeaser(?string $descriptionTeaser): void
    {
        $this->descriptionTeaser = $descriptionTeaser;
    }

    /**
     * @return string|null
     */
    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    /**
     * @param string|null $serialNumber
     */
    public function setSerialNumber(?string $serialNumber): void
    {
        $this->serialNumber = $serialNumber;
    }

    /**
     * @return string|null
     */
    public function getSerialCode(): ?string
    {
        return $this->serialCode;
    }

    /**
     * @param string|null $serialCode
     */
    public function setSerialCode(?string $serialCode): void
    {
        $this->serialCode = $serialCode;
    }

    /**
     * @return string|null
     */
    public function getCodeContent(): ?string
    {
        return $this->codeContent;
    }

    /**
     * @param string|null $codeContent
     */
    public function setCodeContent(?string $codeContent): void
    {
        $this->codeContent = $codeContent;
    }

    /**
     * @return string|null
     */
    public function getArticleUse(): ?string
    {
        return $this->articleUse;
    }

    /**
     * @param string|null $articleUse
     */
    public function setArticleUse(?string $articleUse): void
    {
        $this->articleUse = $articleUse;
    }

    /**
     * @return string
     */
    public function getArticleType(): string
    {
        return $this->articleType;
    }

    /**
     * @param string $articleType
     */
    public function setArticleType(string $articleType): void
    {
        $this->articleType = $articleType;
    }

    /**
     * @return string|null
     */
    public function getArticleCounter(): ?string
    {
        return $this->articleCounter;
    }

    /**
     * @param string|null $articleCounter
     */
    public function setArticleCounter(?string $articleCounter): void
    {
        $this->articleCounter = $articleCounter;
    }

    /**
     * @return string|null
     */
    public function getArticleCounterType(): ?string
    {
        return $this->articleCounterType;
    }

    /**
     * @param string|null $articleCounterType
     */
    public function setArticleCounterType(?string $articleCounterType): void
    {
        $this->articleCounterType = $articleCounterType;
    }

    /**
     * @return string|null
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * @param string|null $tags
     */
    public function setTags(?string $tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @return array|null
     */
    public function getFilters(): ?array
    {
        return $this->filters;
    }

    /**
     * @param array|null $filters
     */
    public function setFilters(?array $filters): void
    {
        $this->filters = $filters;
    }

    /**
     * @return string|null
     */
    public function getRelevance(): ?string
    {
        return $this->relevance;
    }

    /**
     * @param string|null $relevance
     */
    public function setRelevance(?string $relevance): void
    {
        $this->relevance = $relevance;
    }

    /**
     * @return int|null
     */
    public function getDefaultPriceCalculation(): ?int
    {
        return $this->defaultPriceCalculation;
    }

    /**
     * @param int|null $defaultPriceCalculation
     */
    public function setDefaultPriceCalculation(?int $defaultPriceCalculation): void
    {
        $this->defaultPriceCalculation = $defaultPriceCalculation;
    }

    /**
     * @return float|null
     */
    public function getPriceFix(): ?float
    {
        return $this->priceFix;
    }

    /**
     * @param float|null $priceFix
     */
    public function setPriceFix(?float $priceFix): void
    {
        $this->priceFix = $priceFix;
    }

    /**
     * @return float|null
     */
    public function getPriceDisplay(): ?float
    {
        return $this->priceDisplay;
    }

    /**
     * @param float|null $priceDisplay
     */
    public function setPriceDisplay(?float $priceDisplay): void
    {
        $this->priceDisplay = $priceDisplay;
    }

    /**
     * @return float|null
     */
    public function getPriceDeposit(): ?float
    {
        return $this->priceDeposit;
    }

    /**
     * @param float|null $priceDeposit
     */
    public function setPriceDeposit(?float $priceDeposit): void
    {
        $this->priceDeposit = $priceDeposit;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }

    /**
     * @param bool $isAvailable
     */
    public function setIsAvailable(bool $isAvailable): void
    {
        $this->isAvailable = $isAvailable;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getImages(): ArrayCollection|Collection
    {
        return $this->images;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getAttributes(): ArrayCollection|Collection
    {
        return $this->attributes;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @return Storage|null
     */
    public function getStorage(): ?Storage
    {
        return $this->storage;
    }

    /**
     * @return Location|null
     */
    public function getLocation(): ?Location
    {
        return $this->location;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getStocks(): ArrayCollection|Collection
    {
        return $this->stocks;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getAccessories(): ArrayCollection|Collection
    {
        return $this->accessories;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getPriceRates(): ArrayCollection|Collection
    {
        return $this->priceRates;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getPriceDiscounts(): ArrayCollection|Collection
    {
        return $this->priceDiscounts;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getPriceDeals(): ArrayCollection|Collection
    {
        return $this->priceDeals;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getBookings(): ArrayCollection|Collection
    {
        return $this->bookings;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string|null
     */
    public function getArticleValue1(): ?string
    {
        return $this->articleValue1;
    }

    /**
     * @param string|null $articleValue1
     */
    public function setArticleValue1(?string $articleValue1): void
    {
        $this->articleValue1 = $articleValue1;
    }

    /**
     * @return string|null
     */
    public function getArticleValue2(): ?string
    {
        return $this->articleValue2;
    }

    /**
     * @param string|null $articleValue2
     */
    public function setArticleValue2(?string $articleValue2): void
    {
        $this->articleValue2 = $articleValue2;
    }

    /**
     * @return string|null
     */
    public function getArticleValue3(): ?string
    {
        return $this->articleValue3;
    }

    /**
     * @param string|null $articleValue3
     */
    public function setArticleValue3(?string $articleValue3): void
    {
        $this->articleValue3 = $articleValue3;
    }


}
