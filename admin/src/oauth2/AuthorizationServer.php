<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 23/09/2017
 * Time: 20:18
 */

namespace cms\oauth2;


use DI\Annotation\Inject;
use League\OAuth2\Server\CryptKey;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;

class AuthorizationServer extends \League\OAuth2\Server\AuthorizationServer
{
    /**
     * @Inject('app.security')
     * @var
     */
    private $appSecurity;


    /**
     * todo
     * AuthorizationServer constructor.
     * @param ClientRepositoryInterface $clientRepository
     * @param AccessTokenRepositoryInterface $accessTokenRepository
     * @param ScopeRepositoryInterface $scopeRepository
     */
    public function __construct(ClientRepositoryInterface $clientRepository,
                                AccessTokenRepositoryInterface $accessTokenRepository,
                                ScopeRepositoryInterface $scopeRepository)
    {
        $encryptionKey =  $this->appSecurity['keystore']['path'] . 'public.key';
        $criptKey = new CryptKey($this->appSecurity['keystore']['path'], $this->appSecurity['keystore']['passphrase']);
        parent::__construct($clientRepository,$accessTokenRepository, $scopeRepository,$criptKey,$encryptionKey);

    }
}