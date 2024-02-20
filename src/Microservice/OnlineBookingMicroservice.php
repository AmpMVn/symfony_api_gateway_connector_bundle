<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Microservice;

use Doctrine\Common\Collections\ArrayCollection;
use Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Filter\Filter;
use Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\OnlineBooking\OnlineBooking;
use Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Process\Process;
use Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Setting\AdditionalField\Group;
use Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Setting\Appearance\Checkout;
use Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Setting\Appearance\DynamicText;
use Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Setting\BlockedDay\BlockedDay;
use Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Setting\OpenTime\OpenTime;
use Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Sync\UpdatedMicroservice;
use Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Sync\UpdatedRentsoft;
use Rentsoft\ApiGatewayConnectorBundle\Extension\ApiGatewayHttpClient;
use Rentsoft\ApiGatewayConnectorBundle\Extension\ApiGatewayKeycloakHttpClient;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OnlineBookingMicroservice
{
    const URI_BASE = "/online-booking/v1";
    const URI_FILTERS = '/filters';
    const URI_PROCESSES = '/processes';
    const URI_ONLINE_BOOKINGS = '/online-bookings';
    const URI_UPDATED_MICROSERVICES = '/updated-microservices';
    const URI_UPDATED_RENTSOFTS = '/updated-rentsofts';
    const URI_ADDITIONAL_GROUP_ = '/additional-field-group';
    const URI_SETTINGS_APPEARANCE_CHECKOUT = '/settings/appearance/checkouts';
    const URI_SETTINGS_OPEN_TIMES = '/settings/opentimes';
    const URI_SETTINGS_BLOCKED_DAYS = '/settings/blockeddays';
    const URI_SETTINGS_APPEARANCE_DYNAMIC_TEXT = '/settings/appearance/dynamic-texts';

    private ApiGatewayHttpClient|ApiGatewayKeycloakHttpClient $apiGatewayHttpClient;

    public function __construct($apiGatewayHttpClient)
    {
        $this->apiGatewayHttpClient = $apiGatewayHttpClient;
    }

    public function getOnlineBookingByUri(string $uri): ?OnlineBooking
    {
        $arr['query']['uri'] = $uri;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ONLINE_BOOKINGS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(OnlineBooking::class, $response->toArray()['hydra:member'], $totalItems);

        if ($totalItems != 1) {
            throw new NotFoundHttpException();
        }

        return $array['data'][0];
    }

    public function getOnlineBookingById(int $id): ?OnlineBooking
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ONLINE_BOOKINGS . '/' . $id);

        $item = $this->apiGatewayHttpClient->deserializeItem(OnlineBooking::class, $response->getContent());

        return $item;
    }

    public function getOnlineBookingByClientId(string $clientId): ArrayCollection
    {
        $arr['query']['client'] = $clientId;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ONLINE_BOOKINGS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(OnlineBooking::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getOnlineBookings(array $parameters = null): ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ONLINE_BOOKINGS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(OnlineBooking::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getUpdatedRentsofts(array $parameters): ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_UPDATED_RENTSOFTS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(UpdatedRentsoft::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getUpdatedMicroservices(array $parameters): ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_UPDATED_MICROSERVICES, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(UpdatedMicroservice::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getFilters(): ArrayCollection
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_FILTERS);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Filter::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getFilterById(int $id): ?Filter
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_FILTERS . '/' . $id);

        $item = $this->apiGatewayHttpClient->deserializeItem(Filter::class, $response->getContent());

        return $item;
    }

    public function getProcesses(array $parameters = null): ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_PROCESSES, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Process::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getProcessById(int $id): ?Process
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_PROCESSES . '/' . $id);

        $item = $this->apiGatewayHttpClient->deserializeItem(Process::class, $response->getContent());

        return $item;
    }

    public function getProcessByHash(string $hash): ?Process
    {
        $arr['query']['uniqueHash'] = $hash;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_PROCESSES, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Process::class, $response->toArray()['hydra:member'], $totalItems);

        if ($totalItems > 1) {
            throw new \Exception('More then 1 Results!');
        }

        if ($totalItems != 1) {
            throw new NotFoundHttpException();
        }

        return $array['data'][0];
    }

    public function getProcessByCustomerData(string $searchQuery): ArrayCollection
    {
        $arr['query']['searchQuery'] = $searchQuery;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_PROCESSES, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Process::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getSettingsOpenTimesByOnlineBookingId(int $onlineBookingId)
    {
        $arr['query'] = array();
        $arr['query']['onlineBooking'] = $onlineBookingId;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_SETTINGS_OPEN_TIMES, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(OpenTime::class, $response->toArray()['hydra:member'], $totalItems);

        return $array['data'];
    }

    public function getSettingsBlockedDaysByOnlineBookingId(int $onlineBookingId)
    {
        $arr['query'] = array();
        $arr['query']['onlineBooking'] = $onlineBookingId;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_SETTINGS_BLOCKED_DAYS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(BlockedDay::class, $response->toArray()['hydra:member'], $totalItems);

        return $array['data'];
    }

    public function getAdditionalFieldGroupByOnlineBookingId(int $onlineBookingId)
    {
        $arr['query'] = array();
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ONLINE_BOOKINGS . '/' . $onlineBookingId . '/' . self::URI_ADDITIONAL_GROUP_, $arr);

        $item = $this->apiGatewayHttpClient->deserializeItem(Group::class, $response->getContent());

        return $item;
    }

    public function getAppearanceCheckoutByOnlineBookingId(int $onlineBookingId)
    {
        $arr['query'] = array();
        $arr['query']['onlineBooking'] = $onlineBookingId;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_SETTINGS_APPEARANCE_CHECKOUT, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Checkout::class, $response->toArray()['hydra:member'], $totalItems);

        return $array['data'][0];
    }

    public function getSettingsAppearanceDynamicTextByOnlineBookingId(int $onlineBookingId)
    {
        $arr['query'] = array();
        $arr['query']['onlineBooking'] = $onlineBookingId;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_SETTINGS_APPEARANCE_DYNAMIC_TEXT, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(DynamicText::class, $response->toArray()['hydra:member'], $totalItems);

        return $array['data'][0];
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

    public function getUriByObject(object $object)
    {
        $className = get_class($object);
        $url = null;

        switch ($className) {
            case Process::class:
                $url = self::URI_PROCESSES;
                break;
            case OnlineBooking::class:
                $url = self::URI_ONLINE_BOOKINGS;
                break;
            default:
                throw new Exception("The " . $className . " class isn't allowed!");
        }

        return $url;
    }
}
