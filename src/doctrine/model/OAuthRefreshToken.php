<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 03/12/17
 * Time: 20.25
 */

namespace cms\doctrine\model;
use cms\doctrine\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Entities\Traits\RefreshTokenTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="oauth_refresh_token")
 */
class OAuthRefreshToken extends BaseEntity implements RefreshTokenEntityInterface
{
    use RefreshTokenTrait;
    /** @ORM\Column(name="identifier", type="string", nullable=false) */
    protected $identifier;
    /**
     * @ORM\ManyToOne(targetEntity="OAuthAccessToken")
     * @ORM\JoinColumn(fieldName="refresh_token_id")
     * @var OAuthAccessToken
     */
    protected $refresh_token;

    /** @ORM\Column(name="expires", type="datetime")) */
    protected $expires;

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
     * Set the access token that the refresh token was associated with.
     *
     * @param AccessTokenEntityInterface $accessToken
     */
    public function setAccessToken(AccessTokenEntityInterface $accessToken)
    {
        $this->refresh_token = $accessToken;
    }

    /**
     * Get the access token that the refresh token was originally associated with.
     *
     * @return AccessTokenEntityInterface
     */
    public function getAccessToken()
    {
        return $this->refresh_token;
    }
}