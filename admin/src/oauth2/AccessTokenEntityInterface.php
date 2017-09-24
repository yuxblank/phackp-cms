<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 23/09/2017
 * Time: 20:24
 */

namespace cms\oauth2;


use League\OAuth2\Server\CryptKey;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;

class AccessTokenEntityInterface implements \League\OAuth2\Server\Entities\AccessTokenEntityInterface
{
    public function convertToJWT(CryptKey $privateKey)
    {
        // TODO: Implement convertToJWT() method.
    }

    public function getIdentifier()
    {
        // TODO: Implement getIdentifier() method.
    }

    public function setIdentifier($identifier)
    {
        // TODO: Implement setIdentifier() method.
    }

    public function getExpiryDateTime()
    {
        // TODO: Implement getExpiryDateTime() method.
    }

    public function setExpiryDateTime(\DateTime $dateTime)
    {
        // TODO: Implement setExpiryDateTime() method.
    }

    public function setUserIdentifier($identifier)
    {
        // TODO: Implement setUserIdentifier() method.
    }

    public function getUserIdentifier()
    {
        // TODO: Implement getUserIdentifier() method.
    }

    public function getClient()
    {
        // TODO: Implement getClient() method.
    }

    public function setClient(ClientEntityInterface $client)
    {
        // TODO: Implement setClient() method.
    }

    public function addScope(ScopeEntityInterface $scope)
    {
        // TODO: Implement addScope() method.
    }

    public function getScopes()
    {
        // TODO: Implement getScopes() method.
    }


}