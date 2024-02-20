<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Microservice;

use Doctrine\Common\Collections\ArrayCollection;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ClientMicroservice\Client\Client;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ClientMicroservice\Group\Group;
use Rentsoft\ApiGatewayConnectorBundle\Entity\ClientMicroservice\User\User;
use Rentsoft\ApiGatewayConnectorBundle\Extension\ApiGatewayKeycloakHttpClient;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class ClientMicroservice
{
    CONST URI_BASE = "/client/v1";
    CONST URI_GET_CLIENTS = '/auth/admin/realms/rs-platform/clients';
    CONST URI_GET_CLIENT_SECRET = '/client-secret';
    CONST URI_GET_GROUPS = '/auth/admin/realms/rs-platform/groups';
    CONST URI_GET_USERS = '/auth/admin/realms/rs-platform/users';

    private ApiGatewayKeycloakHttpClient $apiGatewayKeycloakHttpClient;

    public function __construct($apiGatewayKeycloakHttpClient)
    {
        $this->apiGatewayKeycloakHttpClient = $apiGatewayKeycloakHttpClient;
    }


    public function getClients(): ArrayCollection
    {
        $response = $this->apiGatewayKeycloakHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_GET_CLIENTS);

        $array = $this->apiGatewayKeycloakHttpClient->deserializeCollection(Client::class, $response->toArray()['clients']);
        return $array;
    }


    public function getClient($keycloakClientId): ?Client
    {
        $response = $this->apiGatewayKeycloakHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_GET_CLIENTS . '/' . $keycloakClientId);

        $item = $this->apiGatewayKeycloakHttpClient->deserializeItem(Client::class, $response->getContent());

        return $item;
    }

    public function getRentsoftClients(): ArrayCollection
    {
        /** @var Group[] $groups */
        $groups = $this->getGroups();

        $rentsoftClients = [];
        foreach ($groups as $group){
            if($group->getName() == "Clients") {
                $rentsoftClientsGroup = $this->getGroup($group->getId());

                foreach ($rentsoftClientsGroup->getSubGroups() as $rentsoftClientGroup){
                    $rentsoftClients[] = $this->apiGatewayKeycloakHttpClient->deserializeItem(Group::class, json_encode($rentsoftClientGroup));
                }
            }
        }

        return new ArrayCollection($rentsoftClients);
    }

    public function getGroups(): ArrayCollection
    {
        $response = $this->apiGatewayKeycloakHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_GET_GROUPS);

        $array = $this->apiGatewayKeycloakHttpClient->deserializeCollection(Group::class, $response->toArray()['groups']);
        return $array;
    }

    public function getGroup($keycloakGroupId): ?Group
    {
        $response = $this->apiGatewayKeycloakHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_GET_GROUPS . '/' . $keycloakGroupId);

        $item = $this->apiGatewayKeycloakHttpClient->deserializeItem(Group::class, $response->getContent());

        return $item;
    }

    public function getClientSecret($keycloakClientId)
    {
        $response = $this->apiGatewayKeycloakHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_GET_CLIENTS . '/' . $keycloakClientId . self::URI_GET_CLIENT_SECRET);

        return $response->toArray()['value'];
    }

    public function getUsers(array $parameters = []): ArrayCollection
    {
        $arr['query'] = $parameters;

        try{
            $response = $this->apiGatewayKeycloakHttpClient->request(Request::METHOD_GET, self::URI_BASE . self::URI_GET_USERS, $arr);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }


//        $array = $this->apiGatewayKeycloakHttpClient->deserializeCollection(User::class, $response->toArray()['users']);

        return new ArrayCollection($response->toArray()['users']);
    }

    public function postUser(User $object)
    {

        $url = $this->getUriByObject($object);

        $body = [
            'username' => $object->getEmail(),
            'email' => $object->getEmail(),
            'groups' => array('Clients/' . $object->getGroups()->first()->getName()),
        ];

        $arr = [
            'headers' => ['Content-Type' => "application/json"],
            'body' => json_encode($body)
        ];
//        dump($arr);

        try {
            $response = $this->apiGatewayKeycloakHttpClient->request(Request::METHOD_POST, self::URI_BASE . $url, $arr);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
//dd($response->getContent());
//        $item = $this->apiGatewayKeycloakHttpClient->deserializeItem(get_class($object), $response->getContent());

        return $response;
    }

    public function getUriByObject(object $object) {
        $className = get_class($object);
        $url = null;

        switch ($className){
            case User::class:
                $url = self::URI_GET_USERS;
                break;
            default:
                throw new Exception("The " . $className . " class isn't allowed!");
        }

        return $url;
    }
}
