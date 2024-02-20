<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Microservice;


use Doctrine\Common\Collections\ArrayCollection;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Article\Article;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Article\Booking;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Client\Client;
use Rentsoft\ApiGatewayConnectorBundle\Entity\CommunicationMicroservice\Mail\Attachment;
use Rentsoft\ApiGatewayConnectorBundle\Entity\CommunicationMicroservice\Mail\Mail;
use Rentsoft\ApiGatewayConnectorBundle\Entity\CommunicationMicroservice\Settings\Settings;
use Rentsoft\ApiGatewayConnectorBundle\Extension\ApiGatewayHttpClient;
use Rentsoft\ApiGatewayConnectorBundle\Extension\ApiGatewayKeycloakHttpClient;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class CommunicationMicroservice
{
    CONST URI_BASE = "/communication/v1";
    CONST URI_MAILS = '/mails';
    CONST URI_ATTACHMENTS = '/attachments';
    const URI_SETTINGS = '/settings';

    private ApiGatewayHttpClient|ApiGatewayKeycloakHttpClient $apiGatewayHttpClient;

    public function __construct($apiGatewayHttpClient)
    {
        $this->apiGatewayHttpClient = $apiGatewayHttpClient;
    }

    public function getMails(array $parameters = null): ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_MAILS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Mail::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getMailsByStatus(int $status): ArrayCollection
    {
        $arr['query']['status'] = $status;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_MAILS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Mail::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;

    }

    public function getMail(int $mailId): ?Mail
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_MAILS . '/' . $mailId);

        $item = $this->apiGatewayHttpClient->deserializeItem(Mail::class, $response->getContent());

        return $item;
    }

    public function getAttachments(array $parameters = null): ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ATTACHMENTS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Attachment::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getAttachment(int $attachmentId): ?Attachment
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_ATTACHMENTS . '/' . $attachmentId);

        $item = $this->apiGatewayHttpClient->deserializeItem(Attachment::class, $response->getContent());

        return $item;
    }

    public function getMailAtttachments(int $mailId)
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_MAILS . '/' . $mailId . self::URI_ATTACHMENTS);

        return $response;
    }

    public function getSettings(array $parameters = null): ArrayCollection
    {
        $arr['query'] = $parameters;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_SETTINGS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Settings::class, $response->toArray()['hydra:member'], $totalItems);

        return $array;
    }

    public function getSettingByClientId(string $clientId): ?Settings
    {
        $arr['query']['clientId'] = $clientId;
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_SETTINGS, $arr);

        $totalItems = $response->toArray()['hydra:totalItems'];
        $array = $this->apiGatewayHttpClient->deserializeCollection(Settings::class, $response->toArray()['hydra:member'], $totalItems);

        if ($totalItems === 0) {
            return null;
        } else {
            return $array['data'][0];
        }
    }

    public function getSetting(int $settingId): ?Settings
    {
        $response = $this->apiGatewayHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_SETTINGS . '/' . $settingId);

        $item = $this->apiGatewayHttpClient->deserializeItem(Settings::class, $response->getContent());

        return $item;
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

    public function getUriByObject(object $object): string
    {
        $className = get_class($object);

        return match ($className) {
            Mail::class => self::URI_MAILS,
            Attachment::class => self::URI_ATTACHMENTS,
            Settings::class => self::URI_SETTINGS,
            default => throw new Exception("The " . $className . " class isn't allowed!")
        };
    }
}
