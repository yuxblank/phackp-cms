<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 04/12/17
 * Time: 21.34
 */

namespace cms\doctrine\repository;


use cms\doctrine\model\OAuthAccessToken;
use Doctrine\ORM\EntityManager;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Exception\UniqueTokenIdentifierConstraintViolationException;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;

use yuxblank\phackp\database\EntityRepository;

class OAuthAccessTokenRepository extends EntityRepository implements AccessTokenRepositoryInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, OAuthAccessToken::class);
    }


    /**
     * Create a new access token
     *
     * @param ClientEntityInterface $clientEntity
     * @param ScopeEntityInterface[] $scopes
     * @param mixed $userIdentifier
     *
     * @return AccessTokenEntityInterface
     */
    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        $acessToken = new OAuthAccessToken();
        $acessToken->setClient($clientEntity);
        foreach ($scopes as $scope){
            $acessToken->addScope($scope);
        }
        $expires = new \DateTime();
        $expires->add(new \DateInterval('PT1H'));
        $acessToken->setExpiryDateTime($expires);
        $acessToken->setUserIdentifier($userIdentifier);
        $acessToken->setIdentifier(bin2hex(random_bytes(40)));
        return $acessToken;
    }

    /**
     * Persists a new access token to permanent storage.
     *
     * @param AccessTokenEntityInterface $accessTokenEntity
     *
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws UniqueTokenIdentifierConstraintViolationException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity)
    {
        $this->_em->persist($accessTokenEntity);
        $this->_em->flush();
    }

    /**
     * Revoke an access token.
     *
     * @param string $tokenId
     */
    public function revokeAccessToken($tokenId)
    {
        // TODO: Implement revokeAccessToken() method.
    }

    /**
     * Check if the access token has been revoked.
     *
     * @param string $tokenId
     *
     * @return bool Return true if this token has been revoked
     */
    public function isAccessTokenRevoked($tokenId)
    {
        return false;
    }
}