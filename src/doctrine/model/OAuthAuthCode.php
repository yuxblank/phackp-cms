<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 04/12/17
 * Time: 22.08
 */

namespace cms\doctrine\model;

use cms\doctrine\BaseEntity;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
/**
 * @ORM\Entity
 * @ORM\Table(name="oauth_auth_code")
 */
class OAuthAuthCode extends BaseEntity implements AuthCodeEntityInterface
{

    /**
     * @ORM\Column(name="identifier", type="string", nullable=false)
     */
    protected $identifier;
    /**
     * @ORM\Column(name="redirect_uri", type="string")
     */
    protected $redirectUri;
    /**
     * @ORM\Column(name="expires", type="datetime", nullable=false)
     */
    protected $expires;

    /** @ORM\OneToMany(targetEntity="OAuthClient", fetch="LAZY", mappedBy="id")
     * @ORM\JoinColumn(fieldName="client_id")
     * @var OAuthClient
     */
     protected $client;

    /** @ORM\ManyToOne(targetEntity="OAuthScope", fetch="LAZY")
     * @ORM\JoinColumn(fieldName="id")
     * @var Collection
     */
    protected $scopes;

    /**
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * @param string $uri
     */
    public function setRedirectUri($uri)
    {
        $this->redirectUri = $uri;
    }

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
        // TODO: Implement setUserIdentifier() method.
    }

    /**
     * Get the token user's identifier.
     *
     * @return string|int
     */
    public function getUserIdentifier()
    {
        // TODO: Implement getUserIdentifier() method.
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
        return $this->scopes->getValues();
    }
}