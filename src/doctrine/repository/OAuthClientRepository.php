<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 04/12/17
 * Time: 22.18
 */

namespace cms\doctrine\repository;


use cms\doctrine\model\OAuthClient;
use Doctrine\ORM\EntityManager;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use yuxblank\phackp\database\EntityRepository;

class OAuthClientRepository extends EntityRepository implements ClientRepositoryInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, OAuthClient::class);
    }


    /**
     * Get a client.
     *
     * @param string $clientIdentifier The client's identifier
     * @param string $grantType The grant type used
     * @param null|string $clientSecret The client's secret (if sent)
     * @param bool $mustValidateSecret If true the client must attempt to validate the secret if the client
     *                                        is confidential
     *
     * @return ClientEntityInterface
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function getClientEntity($clientIdentifier, $grantType, $clientSecret = null, $mustValidateSecret = true)
    {
        return $this->_em->createQuery(
            "SELECT c FROM ".OAuthClient::class ." c WHERE c.identifier = :identifier")
            ->setParameter("identifier", $clientIdentifier)
            ->getSingleResult();
    }
}