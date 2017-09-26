<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 23/09/2017
 * Time: 20:18
 */

namespace cms\oauth2;


use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;

class AuthorizationServer extends \League\OAuth2\Server\AuthorizationServer
{


    /**
     * todo
     * AuthorizationServer constructor.
     * @param ClientRepositoryInterface $clientRepository
     * @param AccessTokenRepositoryInterface $accessTokenRepository
     * @param ScopeRepositoryInterface $scopeRepository
     * @param \League\OAuth2\Server\CryptKey|string $privateKey
     * @param string $encryptionKey
     */
    public function __construct(ClientRepositoryInterface $clientRepository,
                                AccessTokenRepositoryInterface $accessTokenRepository,
                                ScopeRepositoryInterface $scopeRepository, $privateKey, $encryptionKey)
    {
        parent::__construct($clientRepository,$accessTokenRepository, $scopeRepository,$privateKey,$encryptionKey);

    }
}