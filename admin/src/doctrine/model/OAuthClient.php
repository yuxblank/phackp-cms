<?php
namespace cms\doctrine\model;
use cms\doctrine\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities\ClientEntityInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="oauth_client")
 */
class OAuthClient extends BaseEntity implements ClientEntityInterface
{

    /** @ORM\Column(name="identifier", type="string", nullable=false) */
    protected $identifier;
    /** @ORM\Column(name="name", type="string", nullable=false) */
    protected $name;
    /** @ORM\Column(name="redirect_uri", type="string") */
    protected $redirect_uri;

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRedirectUri()
    {
        return $this->redirect_uri;
    }


}