<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 19/09/2017
 * Time: 14:47
 */

namespace cms\doctrine\model;

use cms\doctrine\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="tag")
 * Class Tag
 * @ORM\HasLifecycleCallbacks()
 * @package cms\doctrine\model
 */
class Tag extends BaseEntity implements \JsonSerializable
{

    /**
     * @ORM\Column (name="content", type="string", length=50)
     */
    protected $content;

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }


    /** @ORM\PrePersist */
    public function prePersist()
    {
        $this->dateCreated = new \DateTime();
    }

    /** @ORM\PreUpdate */
    public function preUpdate()
    {
        $this->dateUpdated = new \DateTime();
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'content' => $this->getContent(),
            'status' => $this->getStatus(),
            'date_created' => $this->getDateCreated(),
            'date_updated' => $this->getDateUpdated()
        ];
    }


}