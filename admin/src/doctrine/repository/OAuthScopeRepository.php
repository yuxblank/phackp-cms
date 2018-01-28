<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 04/12/17
 * Time: 22.21
 */

namespace cms\doctrine\repository;

use cms\doctrine\model\OAuthScope;
use Doctrine\ORM\EntityManager;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use yuxblank\phackp\database\EntityRepository;

class OAuthScopeRepository extends EntityRepository implements ScopeRepositoryInterface
{

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, OAuthScope::class);
    }


    /**
     * Return information about a scope.
     *
     * @param string $identifier The scope identifier
     *
     * @return ScopeEntityInterface
     */
    public function getScopeEntityByIdentifier($identifier)
    {
        // TODO: Implement getScopeEntityByIdentifier() method.
    }

    /**
     * Given a client, grant type and optional user identifier validate the set of scopes requested are valid and optionally
     * append additional scopes or remove requested scopes.
     *
     * @param ScopeEntityInterface[] $scopes
     * @param string $grantType
     * @param ClientEntityInterface $clientEntity
     * @param null|string $userIdentifier
     *
     * @return ScopeEntityInterface[]
     */
    public function finalizeScopes(
        array $scopes,
        $grantType,
        ClientEntityInterface $clientEntity,
        $userIdentifier = null
    )
    {
        return $scopes;
        // TODO: Implement finalizeScopes() method.
    }
}