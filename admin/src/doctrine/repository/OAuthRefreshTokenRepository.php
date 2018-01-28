<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 04/12/17
 * Time: 22.19
 */

namespace cms\doctrine\repository;

use cms\doctrine\model\OAuthRefreshToken;
use Doctrine\ORM\EntityManager;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Exception\UniqueTokenIdentifierConstraintViolationException;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use yuxblank\phackp\database\EntityRepository;

class OAuthRefreshTokenRepository extends EntityRepository implements RefreshTokenRepositoryInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, OAuthRefreshToken::class);
    }


    /**
     * Creates a new refresh token
     *
     * @return RefreshTokenEntityInterface
     */
    public function getNewRefreshToken()
    {
        $expires = new \DateTime();
        $expires->add(new \DateInterval('PT10H'));
        $refresh = new OAuthRefreshToken();
        $refresh->setIdentifier(bin2hex(random_bytes(40)));
        $refresh->setExpiryDateTime($expires);
        return $refresh;

    }

    /**
     * Create a new refresh token_name.
     *
     * @param RefreshTokenEntityInterface $refreshTokenEntity
     *
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws UniqueTokenIdentifierConstraintViolationException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity)
    {
        $this->_em->persist($refreshTokenEntity);
        $this->_em->flush($refreshTokenEntity);
    }

    /**
     * Revoke the refresh token.
     *
     * @param string $tokenId
     */
    public function revokeRefreshToken($tokenId)
    {
        // TODO: Implement revokeRefreshToken() method.
    }

    /**
     * Check if the refresh token has been revoked.
     *
     * @param string $tokenId
     *
     * @return bool Return true if this token has been revoked
     */
    public function isRefreshTokenRevoked($tokenId)
    {
        // TODO: Implement isRefreshTokenRevoked() method.
    }
}