<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 23/09/2017
 * Time: 20:23
 */

namespace cms\oauth2;


use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
    public function getClientEntity($clientIdentifier, $grantType, $clientSecret = null, $mustValidateSecret = true)
    {
        // TODO: Implement getClientEntity() method.
    }


}