<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Microservice;

use Doctrine\Common\Collections\ArrayCollection;
use Rentsoft\ApiGatewayConnectorBundle\Entity\InvoiceMicroservice\Invoice\Invoice;
use Rentsoft\ApiGatewayConnectorBundle\Entity\InvoiceMicroservice\Invoice\Item;
use Rentsoft\ApiGatewayConnectorBundle\Entity\InvoiceMicroservice\Invoice\Reminder;
use Rentsoft\ApiGatewayConnectorBundle\Entity\InvoiceMicroservice\Settings\Invoice\Letterhead;
use Rentsoft\ApiGatewayConnectorBundle\Entity\InvoiceMicroservice\Settings\Settings;
use Rentsoft\ApiGatewayConnectorBundle\Extension\ApiGatewayHttpClient;
use Rentsoft\ApiGatewayConnectorBundle\Extension\ApiGatewayKeycloakHttpClient;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;

class InvoiceMicroservice
{
    const URI_BASE = "/invoice/v1";
    const URI_INVOICES = '/invoices';
    const URI_ITEMS = '/items';
    const URI_REMINDERS = '/reminders';
    const URI_LETTERHEADS = '/letterheads';
    const URI_SETTINGS = '/settings';
    const PUBLIC_URL = '/base-uri';

    private ApiGatewayHttpClient|ApiGatewayKeycloakHttpClient $apiGatewayHttpClient;

    public function __construct($apiGatewayHttpClient)
    {
        $this->apiGatewayHttpClient = $apiGatewayHttpClient;
    }

    public function getPublicUrl() : string
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::PUBLIC_URL);

        $content = $response->toArray();

        return $content["base-uri"];
    }

    public function getInvoices(array $parameters = null): ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_INVOICES, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Invoice::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getInvoice(int $invoiceId): ?Invoice
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_INVOICES . '/' . $invoiceId);

        $item = $this->apiGatewayHttpClient->deserializeItem(Invoice::class, $response->getContent());

        return $item;
    }

    public function getItems(array $parameters = null): ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ITEMS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Item::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getItem(int $itemId): ?Item
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ITEMS . '/' . $itemId);

        $item = $this->apiGatewayHttpClient->deserializeItem(Item::class, $response->getContent());

        return $item;
    }

    public function getInvoiceItems(int $invoiceId)
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_INVOICES . '/' . $invoiceId . self::URI_ITEMS);

        return $response;
    }

    public function getReminders(array $parameters = null) : ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_REMINDERS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Reminder::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getReminder(int $reminderId): ?Reminder
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_REMINDERS . '/' . $reminderId);

        $item = $this->apiGatewayHttpClient->deserializeItem(Reminder::class, $response->getContent());

        return $item;
    }

    public function getInvoiceReminders(int $invoiceId)
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_INVOICES . '/' . $invoiceId . self::URI_REMINDERS);

        return $response;
    }

    public function getLetterheads(array $parameters = null) : ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_LETTERHEADS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Letterhead::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getLetterhead(int $letterheadId): ?Letterhead
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_LETTERHEADS . '/' . $letterheadId);

        $item = $this->apiGatewayHttpClient->deserializeItem(Letterhead::class, $response->getContent());

        return $item;
    }

    public function getSettings(array $parameters = null) : ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_SETTINGS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Settings::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getSettingByClientId(string $clientId): ?Settings
    {
        $arr['query']['client'] = $clientId;

        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_SETTINGS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Settings::class, $response->toArray()['hydra:member'], $totalItems);

        return $array["data"][0] ?? null;
    }

    public function getSetting(int $settingsId): ?Settings
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_SETTINGS . '/' . $settingsId);

        $item = $this->apiGatewayHttpClient->deserializeItem(Settings::class, $response->getContent());

        return $item;
    }

    public function regeneratePdfForInvoice($invoiceId)
    {
        $arr = [
            'headers' => ['Content-Type' => "application/json"],
            'body' => '{}'
        ];
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_PUT, self::URI_BASE . self::URI_INVOICES . '/' . $invoiceId . "/regenerate-pdf", $arr);

        return $response;
    }

    public function sendEmailForReminder($reminderId)
    {
        $arr = [
            'headers' => ['Content-Type' => "application/json"],
            'body' => '{}'
        ];
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_POST, self::URI_BASE . self::URI_REMINDERS . '/' . $reminderId . "/send-email", $arr);

        return $response;
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
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_PATCH, self::URI_BASE . $url . '/' . $object->getId(), $arr);

        if ($response->getStatusCode() !== 200) {
            return $response;
        }

        return $this->apiGatewayHttpClient->deserializeItem(get_class($object), $response->getContent());
    }

    public function delete(object $object): ResponseInterface
    {
        $url = $this->getUriByObject($object);

        $arr = [
            'headers' => ['Content-Type' => "application/json"],
        ];
        return $this->apiGatewayHttpClient->request(Request::METHOD_DELETE, self::URI_BASE . $url . '/' . $object->getId(), $arr);
    }

    public function getUriByObject(object $object): string
    {
        $className = get_class($object);

        return match ($className) {
            Invoice::class => self::URI_INVOICES,
            Item::class => self::URI_ITEMS,
            Reminder::class => self::URI_REMINDERS,
            Letterhead::class => self::URI_LETTERHEADS,
            Settings::class => self::URI_SETTINGS,
            default => throw new Exception("The " . $className . " class isn't allowed!"),
        };
    }

}
