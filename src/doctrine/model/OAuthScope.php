<?php
namespace cms\doctrine\model;


use cms\doctrine\BaseEntity;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="oauth_scope")
 */
class OAuthScope extends BaseEntity implements ScopeEntityInterface
{

    /** @ORM\Column(name="title", unique=true, nullable=false) */
    protected $title;

    public function getIdentifier()
    {
        return $this->title;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}