# How to install in web or other app

**1. Edit symfony_project_dir/composer.json**
```yaml
"repositories": [
    {
        "type": "git",
        "url": "https://source.developers.google.com/p/x0-marketing/r/rentsoft_bundle_api_gateway/"
    },
]
```
```yaml
"require": {
  "rentsoft/api-gateway-connector-bundle": "^6.0" # Version by Symfony project version!
}
```

**2. Run**
```shell
composer update

###
```


**3. Edit symfony_project_dir/config/packages/knpu_oauth2_client.yaml**
```yaml
knpu_oauth2_client:
  clients:
    # the key "facebook_main" can be anything, it
    # will create a service: "knpu.oauth2.client.facebook_main"
    rentsoft_ms_user_keycloak:
      # must be "keycloak" - it activates that type!
      type: keycloak
      # add and set these environment variables in your .env files
      client_id: '%env(OAUTH_KEYCLOAK_CLIENT_ID)%'
      client_secret: '%env(OAUTH_KEYCLOAK_CLIENT_SECRET)%'
      # a route name you'll create
      redirect_route: connect_ms_user_test # Any controller route must be 
      redirect_params: { }
      # Keycloak server URL
      auth_server_url: http://user.ms.rentsoft.de.localhost/auth
      # Keycloak realm
      realm: rs-platform
      # Optional: Encryption algorith, i.e. RS256
      # encryption_algorithm: null
      # Optional: Encryption key path, i.e. ../key.pem
      # encryption_key_path: null
      # Optional: Encryption key, i.e. contents of key or certificate
      # encryption_key: null
      # whether to check OAuth2 "state": defaults to true
      use_state: true
    rentsoft_ms_user_keycloak_admin_cli:
      type: keycloak
      client_id: '%env(OAUTH_KEYCLOAK_CLIENT_ID_ADMIN_CLI)%'
      client_secret:
      redirect_route: api_entrypoint
      redirect_params: { }
      auth_server_url: http://user.ms.rentsoft.de.localhost/auth
      realm: rs-platform
```

**4. Edit symfony_project_dir/config/packages/[dev|prod/]framework.yaml**
```yaml
framework:
    http_client:
        default_options:
            verify_host: false
            verify_peer: false
        scoped_clients:
            apiGateway.client:
                base_uri: 'http://rentsoft_api_gateway_krakend:8080'
```

**5. Edit symfony_project_dir/.env**
```yaml
###> rentsoft/api-gateway-connector-bundle ###
OAUTH_KEYCLOAK_CLIENT_ID=""
OAUTH_KEYCLOAK_CLIENT_SECRET=
OAUTH_KEYCLOAK_CLIENT_ID_ADMIN_CLI=""
OAUTH_KEYCLOAK_CLIENT_SECRET_ADMIN_CLI=
###< rentsoft/api-gateway-connector-bundle ###
```

**6. Edit symfony_project_dir/config/services.yaml**
```yaml
parameters:
    api_gateway_connector:
        user:
            username: test-app
            password: password
        admin_cli:
            username: _microservice_article
            password: password
services:
    Rentsoft\ApiGatewayConnectorBundle\Extension\ApiGatewayHttpClient: ~
    Rentsoft\ApiGatewayConnectorBundle\Extension\ApiGatewayKeycloakHttpClient: ~
```

**7. Edit BaseController/Homeconstroller/....**
```phpt
protected ApiGatewayHttpClient $apiGateway;
protected ApiGatewayKeycloakHttpClient $apiGatewayKeycloak;

public function __construct(ApiGatewayHttpClient $apiGateway, ApiGatewayKeycloakHttpClient $apiGatewayKeycloak)
{
    $this->apiGateway = $apiGateway;
    $this->apiGatewayKeycloak = $apiGatewayKeycloak;
}
```

# How to edit bundle
**1. Clone repo**
```shell
git clone ssh://vanek@mvn-computers.de@source.developers.google.com:2022/p/x0-marketing/r/rentsoft_bundle_api_gateway
git pull --all
git branch 6.0/6.x
```

**2. Edit bundle**

**3. Edit version in composer.json (6.x.x)**

**4. push in repository**
```shell
git commit -a -m"update"
git push
git tag 6.0.version_number/6.x.version_number
git push --tags
```
**5. Merge with 5.3 version**
```shell
git merge --no-ff --no-commit 5.3
git reset HEAD myfile.txt
git checkout -- myfile.txt
edit version in composer.json
git commit -m "merged 5.3"
git push
git tag 5.3.version_number
git push --tags
```
**6. Run composer update in Symfony project**
