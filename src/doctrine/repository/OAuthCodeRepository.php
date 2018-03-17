<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 04/12/17
 * Time: 22.22
 */

namespace cms\doctrine\repository;


use cms\doctrine\model\OAuthAuthCode;
use Doctrine\ORM\EntityManager;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Exception\UniqueTokenIdentifierConstraintViolationException;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;
use yuxblank\phackp\database\EntityRepository;

class OAuthCodeRepository extends EntityRepository implements AuthCodeRepositoryInterface
{

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, OAuthAuthCode::class);
    }

    /**
     * Creates a new AuthCode
     *
     * @return AuthCodeEntityInterface
     */
    public function getNewAuthCode()
    {
        // TODO: Implement getNewAuthCode() method.
    }

    /**
     * Persists a new auth code to permanent storage.
     *
     * @param AuthCodeEntityInterface $authCodeEntity
     *
     * @throws UniqueTokenIdentifierConstraintViolationException
     */
    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity)
    {
        // TODO: Implement persistNewAuthCode() method.
    }

    /**
     * Revoke an auth code.
     *
     * @param string $codeId
     */
    public function revokeAuthCode($codeId)
    {
        // TODO: Implement revokeAuthCode() method.
    }

    /**
     * Check if the auth code has been revoked.
     *
     * @param string $codeId
     *
     * @return bool Return true if this code has been revoked
     */
    public function isAuthCodeRevoked($codeId)
    {
        // TODO: Implement isAuthCodeRevoked() method.
    }
}