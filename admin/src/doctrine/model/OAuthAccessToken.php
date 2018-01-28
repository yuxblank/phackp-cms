<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 03/12/17
 * Time: 20.17
 */

namespace cms\doctrine\model;

use cms\doctrine\BaseEntity;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\AccessTokenTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="oauth_access_token")
 */
class OAuthAccessToken extends BaseEntity implements AccessTokenEntityInterface
{

    use AccessTokenTrait;

    /** @ORM\Column(name="identifier", type="string", nullable=false, length=255) */
    protected $identifier;


    /** @ORM\ManyToOne(targetEntity="User", fetch="EAGER")
     * @ORM\JoinColumn(fieldName="id")
     * @var User
     */
    protected $user;
    /** @ORM\Column(name="expires", type="datetime", nullable=false) */
    protected $expires;

    /**
     * @ORM\ManyToMany (targetEntity="OAuthScope", fetch="LAZY")
     * @ORM\JoinTable(
     *     name="access_token_scope",
     *     joinColumns= {@ORM\JoinColumn(name="access_token_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="scope_id", referencedColumnName="id")}
     *  )
     * @var Collection
     */
    protected $scopes;

    /** @ORM\ManyToOne(targetEntity="OAuthClient", fetch="LAZY")
     * @ORM\JoinColumn(fieldName="client_id")
     * @var OAuthClient
     */
    protected $client;

    /**
     * Get the token's identifier.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set the token's identifier.
     *
     * @param $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

    }

    /**
     * Get the token's expiry date time.
     *
     * @return \DateTime
     */
    public function getExpiryDateTime()
    {
        return $this->expires;
    }

    /**
     * Set the date time when the token expires.
     *
     * @param \DateTime $dateTime
     */
    public function setExpiryDateTime(\DateTime $dateTime)
    {
        $this->expires = $dateTime;
    }

    /**
     * Set the identifier of the user associated with the token.
     *
     * @param string|int $identifier The identifier of the user
     */
    public function setUserIdentifier($identifier)
    {
        $this->user = $identifier;
    }

    /**
     * Get the token user's identifier.
     *
     * @return string|int
     */
    public function getUserIdentifier()
    {
        return $this->user->getUsername();
    }

    /**
     * Get the client that the token was issued to.
     *
     * @return ClientEntityInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set the client that the token was issued to.
     *
     * @param ClientEntityInterface $client
     */
    public function setClient(ClientEntityInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Associate a scope with the token.
     *
     * @param ScopeEntityInterface $scope
     */
    public function addScope(ScopeEntityInterface $scope)
    {
        $this->scopes->add($scope);
    }

    /**
     * Return an array of scopes associated with the token.
     *
     * @return ScopeEntityInterface[]
     */
    public function getScopes()
    {
        if ($this->scopes) {
            return $this->scopes->getValues();
        }
    }




}