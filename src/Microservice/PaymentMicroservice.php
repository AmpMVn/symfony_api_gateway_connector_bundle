<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Microservice;

use Doctrine\Common\Collections\ArrayCollection;
use Rentsoft\ApiGatewayConnectorBundle\Entity\PaymentMicroservice\Order;
use Rentsoft\ApiGatewayConnectorBundle\Entity\PaymentMicroservice\OrderIntent;
use Rentsoft\ApiGatewayConnectorBundle\Entity\PaymentMicroservice\Settings;
use Rentsoft\ApiGatewayConnectorBundle\Extension\ApiGatewayHttpClient;
use Rentsoft\ApiGatewayConnectorBundle\Extension\ApiGatewayKeycloakHttpClient;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class PaymentMicroservice
{
    const URI_BASE = "/payment/v1";
    const URI_ORDERS = '/orders';
    const URI_SETTINGS = '/settings';
    const URI_CONCARDIS_CREATE = '/concardis/order/new';

    private ApiGatewayHttpClient|ApiGatewayKeycloakHttpClient $apiGatewayHttpClient;

    public function __construct($apiGatewayHttpClient)
    {
        $this->apiGatewayHttpClient = $apiGatewayHttpClient;
    }

    public function getOrders(array $parameters = null): ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ORDERS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Order::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getOrder(int $orderId): ?Order
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ORDERS . '/' . $orderId);

        $item = $this->apiGatewayHttpClient->deserializeItem(Order::class, $response->getContent());

        return $item;
    }

    public function getSettings(array $parameters = null): ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_SETTINGS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Settings::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getSetting(int $settingId): ?Settings
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_SETTINGS . '/' . $settingId);

        $item = $this->apiGatewayHttpClient->deserializeItem(Settings::class, $response->getContent());

        return $item;
    }

    public function getSettingByClientId(string $clientId): ?Settings
    {
        $arr['query']['client'] = $clientId;

        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_SETTINGS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Settings::class, $response->toArray()['hydra:member'], $totalItems);

        return $array["data"][0] ?? null;
    }

    public function createConcardisOrder(OrderIntent $orderIntent): array
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_POST, self::URI_BASE . self::URI_CONCARDIS_CREATE, [
            "body" => [
                "processId" => $orderIntent->getProcessId(),
                "clientId" => $orderIntent->getClientId(),
                "ipAddress" => $orderIntent->getIpAddress(),
                "amount" => $orderIntent->getAmount(),
                "currency" => $orderIntent->getCurrency(),
                "locale" => $orderIntent->getLocale(),

                // address
                "title" => $orderIntent->getTitle(),
                "firstName" => $orderIntent->getFirstName(),
                "lastName" => $orderIntent->getLastName(),
                "street" => $orderIntent->getStreet(),
                "houseNumber" => $orderIntent->getHouseNumber(),
                "city" => $orderIntent->getCity(),
                "zip" => $orderIntent->getZip(),
                "country" => $orderIntent->getCountry(),
                "state" => $orderIntent->getState(),
                "phone" => $orderIntent->getPhone(),
                "fax" => $orderIntent->getFax(),
                "mobile" => $orderIntent->getMobile(),
                "additionalDetails" => $orderIntent->getAdditionalDetails(),

                // customer
                "email" => $orderIntent->getEmail(),
                // fill if customer is company
                "customerType" => $orderIntent->getCustomerType(),
                "organizationRegistrationId" => $orderIntent->getOrganizationRegistrationId(),
                "organizationVatId" => $orderIntent->getOrganizationVatId(),
                "organizationRegistrationRegister" => $orderIntent->getOrganizationRegistrationRegister(),
                "organizationEntityType" => $orderIntent->getOrganizationEntityType(),
                "companyName" => $orderIntent->getCompanyName(),
                "reference" => $orderIntent->getReference(),

                //persona
                "birthday" => $orderIntent->getBirthday(),
                "gender" => $orderIntent->getGender(),

                "successUrl" => $orderIntent->getSuccessUrl(),
                "failureUrl" => $orderIntent->getFailureUrl(),
                "cancelUrl" => $orderIntent->getCancelUrl(),
                "items" => $orderIntent->getItems()
            ]
        ]);
        return $response->toArray();
    }

    public function post(object $object)
    {
        $url = $this->getUriByObject($object);
        $arr = [
            'headers' => ['Content-Type' => "application/json"],
            'body' => $this->apiGatewayHttpClient->serializeItem($object)
        ];
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_POST, self::URI_BASE . $url, $arr);

        if ($response->getStatusCode() !== 201) {
            return $response;
        }

        return $this->apiGatewayHttpClient->deserializeItem(get_class($object), $response->getContent());
    }

    public function update(object $object)
    {
        $url = $this->getUriByObject($object);

        $arr = [
            'headers' => ['Content-Type' => "application/merge-patch+json"],
            'body' => $this->apiGatewayHttpClient->serializeItem($object)
        ];
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_POST, self::URI_BASE . $url . '/' . $object->getId(), $arr);

        if ($response->getStatusCode() !== 200) {
            return $response;
        }

        return $this->apiGatewayHttpClient->deserializeItem(get_class($object), $response->getContent());
    }

    public function getUriByObject(object $object): string
    {
        $className = get_class($object);

        return match ($className) {
            Order::class => self::URI_ORDERS,
            Settings::class => self::URI_SETTINGS,
            default => throw new Exception("The " . $className . " class isn't allowed!"),
        };
    }
}
