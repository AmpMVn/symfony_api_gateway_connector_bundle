<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Microservice;

use Doctrine\Common\Collections\ArrayCollection;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Article\Article;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Article\Booking;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\ArticleGroup\ArticleGroup;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Client\Client;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Settings\Category;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Settings\Location;
use Rentsoft\ApiGatewayConnectorBundle\Extension\ApiGatewayHttpClient;
use Rentsoft\ApiGatewayConnectorBundle\Extension\ApiGatewayKeycloakHttpClient;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class ArticleMicroservice
{
    CONST URI_BASE = "/article/v1";
    CONST URI_ARTICLES = '/articles';
    const URI_ARTICLES_BOOKINGS = '/bookings';
    CONST URI_ARTICLES_PRICE_CALCULATION = 'pricecalculation';
    const URI_ARTICLE_BOOKINGS = '/article/bookings';
    CONST URI_CLIENTS = '/clients';
    CONST URI_CATEGORIES = '/settings/categories';
    CONST URI_CATEGORIES_TREE = '/get-categories';
    CONST URI_LOCATIONS = '/settings/locations';
    CONST URI_ARTICLE_GROUPS = '/article-groups';


    private ApiGatewayHttpClient|ApiGatewayKeycloakHttpClient $apiGatewayHttpClient;

    public function __construct($apiGatewayHttpClient)
    {
        $this->apiGatewayHttpClient = $apiGatewayHttpClient;
    }


    public function getClients(array $parameters): ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_CLIENTS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Client::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getArticles(array $parameters): ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ARTICLES, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Article::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getArticle(int $articleId): ?Article
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ARTICLES . '/' . $articleId);

        $item = $this->apiGatewayHttpClient->deserializeItem(Article::class, $response->getContent());

        return $item;
    }

    public function getArticleGroups(array $parameters): ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ARTICLE_GROUPS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(ArticleGroup::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getArticleGroup(int $articleGroupId): ?ArticleGroup
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ARTICLE_GROUPS . '/' . $articleGroupId);

        $item = $this->apiGatewayHttpClient->deserializeItem(ArticleGroup::class, $response->getContent());

        return $item;
    }

    public function getArticleBookings(int $articleId, int $rentalStart, int $rentalEnd)
    {
        $arr['query']['rentalStart'] = $rentalStart;
        $arr['query']['rentalEnd'] = $rentalEnd;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ARTICLES . '/' . $articleId . self::URI_ARTICLES_BOOKINGS, $arr);

        return $response;
    }

    public function getArticleBookingsApi(array $articleIds, array $parameters = [])
    {
        $parameters["query"]["article"] = $articleIds;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ARTICLE_BOOKINGS, $parameters);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Booking::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getCategories(array $parameters): ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_CATEGORIES, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Category::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getCategoriesTree(array $parameters): ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_CATEGORIES_TREE, $arr);
        return new ArrayCollection($response->toArray()['collection']);
    }

    public function getCategory(int $categoryId): ?Category
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_CATEGORIES . '/' . $categoryId);

        $item = $this->apiGatewayHttpClient->deserializeItem(Category::class, $response->getContent());

        return $item;
    }

    public function getPriceCalculation(array $articleIds, int $rentalStart, int $rentalEnd)
    {
        $arr['query']['articleIds'] = $articleIds;
        $arr['query']['rentalStart'] = $rentalStart;
        $arr['query']['rentalEnd'] = $rentalEnd;

        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ARTICLES . '/' . self::URI_ARTICLES_PRICE_CALCULATION, $arr);

        return $response;
    }

    public function getArticleGroupPriceCalculation(array $articleGroupIds, int $rentalStart, int $rentalEnd)
    {
        $arr['query']['articleGroupIds'] = $articleGroupIds;
        $arr['query']['rentalStart'] = $rentalStart;
        $arr['query']['rentalEnd'] = $rentalEnd;

        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ARTICLE_GROUPS . '/' . self::URI_ARTICLES_PRICE_CALCULATION, $arr);

        return $response;
    }

    public function getLocations(array $parameters){


        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_LOCATIONS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Location::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function post(object $object)
    {

        $url = $this->getUriByObject($object);

        $arr = [
            'headers' => ['Content-Type' => "application/json"],
            'body' => $this->apiGatewayHttpClient->serializeItem($object)
        ];
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_POST, self::URI_BASE . $url, $arr);

        $item = $this->apiGatewayHttpClient->deserializeItem(get_class($object), $response->getContent());

        return $item;
    }

    public function update(object $object)
    {
        $url = $this->getUriByObject($object);

        $arr = [
            'headers' => ['Content-Type' => "application/merge-patch+json"],
            'body' => $this->apiGatewayHttpClient->serializeItem($object)
        ];
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_POST, self::URI_BASE . $url . '/' . $object->getId(), $arr);

        $item = $this->apiGatewayHttpClient->deserializeItem(get_class($object), $response->getContent());

        return $item;
    }

    public function getUriByObject(object $object) {
        $className = get_class($object);
        $url = null;

        switch ($className){
            case Article::class:
                $url = self::URI_ARTICLES;
                break;
            case Booking::class:
                $url = self::URI_ARTICLE_BOOKINGS;
                break;
            case Location::class:
                $url = self::URI_LOCATIONS;
                break;
            default:
                throw new Exception("The " . $className . " class isn't allowed!");
        }

        return $url;
    }
}
