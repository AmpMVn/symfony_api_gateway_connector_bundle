<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Extension;

use Doctrine\Common\Collections\ArrayCollection;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Client\Provider\KeycloakClient;
use League\OAuth2\Client\Token\AccessToken;
use Rentsoft\ApiGatewayConnectorBundle\Microservice\ArticleMicroservice;
use Rentsoft\ApiGatewayConnectorBundle\Microservice\ClientMicroservice;
use Rentsoft\ApiGatewayConnectorBundle\Microservice\CommunicationMicroservice;
use Rentsoft\ApiGatewayConnectorBundle\Microservice\InvoiceMicroservice;
use Rentsoft\ApiGatewayConnectorBundle\Microservice\OnlineBookingMicroservice;
use Rentsoft\ApiGatewayConnectorBundle\Microservice\PaymentMicroservice;
use Stevenmaguire\OAuth2\Client\Provider\Keycloak;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use \Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\ResponseStreamInterface;

final class ApiGatewayKeycloakHttpClient implements HttpClientInterface
{
    private ParameterBagInterface $parameterBag;

    private $decoratedClient;

    private $clientRegistry;

    private $request;

    /** @var AccessToken */
    private $token;

    private $session;

    public function __construct(ParameterBagInterface $parameterBag, HttpClientInterface $apiGatewayClient, ClientRegistry $clientRegistry, RequestStack $request)
    {
        $this->parameterBag = $parameterBag;
        $this->decoratedClient = $apiGatewayClient;
        $this->clientRegistry = $clientRegistry;
        $this->request = $request;

        if($this->request->getCurrentRequest()) {
            $this->session = $this->request->getSession();
        } else {
            $this->session = new Session();
            $this->session->start();
        }

        $this->token = $this->session->get('access_token_admin_cli');

        if(!$this->token) {
            $this->freshConnect();
        }

        if($this->token->hasExpired()) {
            $this->freshConnect();
        }
    }

    public function freshConnect(){
        $this->session->remove('access_token_admin_cli');

        /** @var KeycloakClient $client */
        $client = $this->clientRegistry
            ->getClient('rentsoft_ms_user_keycloak_admin_cli'); // key used in config/packages/knpu_oauth2_client.yaml

        /** @var Keycloak $provider */
        $provider = $client->getOAuth2Provider();
        $provider->authServerUrl = $this->parameterBag->get('api_gateway_connector')['auth_server_url_intern'];

        $this->token = $provider->getAccessToken('client_credentials');
        $this->session->set('access_token_admin_cli', $this->token);
    }

    public function request(string $method, string $url, array $options = []) : ResponseInterface
    {
        $options['auth_bearer'] = $this->token->getToken();
        $options['headers']['accept-language'] = $this->request->getCurrentRequest() ? $this->request->getCurrentRequest()->getLocale() : null;
        $response = $this->decoratedClient->request($method, $url, $options);

        return $response;
    }

    public function stream($responses, float $timeout = null) : ResponseStreamInterface
    {
        return $this->decoratedClient->stream($responses, $timeout);
    }

    public function withOptions(array $options): static
    {
        $this->decoratedClient->withOptions($options);
        return $this;
    }

    public function deserializeCollection(string $className, array $items) {
        $serializer = new Serializer(
            [ new GetSetMethodNormalizer(), new ArrayDenormalizer() ],
            [ new JsonEncoder() ]
        );

        $data = $serializer->deserialize(json_encode($items), $className . '[]', 'json');

        $array = new ArrayCollection($data);

        return $array;
    }

    public function deserializeItem(string $className, string $item) {
        $serializer = new Serializer(
            [ new ObjectNormalizer() ],
            [ new JsonEncoder() ]
        );
        $data = $serializer->deserialize($item, $className, 'json');

        return $data;
    }

    public function serializeItem(object $object) {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $data = $serializer->serialize($object, 'json');

        return $data;
    }

    public function getMsClient()
    {
        $ms = new ClientMicroservice($this);
        return $ms;
    }

    public function getMsOnlineBooking():OnlineBookingMicroservice
    {
        $ms = new OnlineBookingMicroservice($this);
        return $ms;
    }

    public function getMsArticle():ArticleMicroservice
    {
        $ms = new ArticleMicroservice($this);
        return $ms;
    }

    public function getMsCommunication():CommunicationMicroservice
    {
        $ms = new CommunicationMicroservice($this);
        return $ms;
    }

    public function getMsInvoice():InvoiceMicroservice
    {
        $ms = new InvoiceMicroservice($this);
        return $ms;
    }

    public function getMsPayment(): PaymentMicroservice
    {
        $ms = new PaymentMicroservice($this);
        return $ms;
    }

}
