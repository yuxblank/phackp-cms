<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 20/09/2017
 * Time: 16:06
 */

namespace cms\doctrine\model;
use cms\doctrine\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="menu")
 * Class Menu
 * @package cms\doctrine\model
 */
class Menu extends BaseEntity implements \JsonSerializable
{
    /**
     * @ORM\Column(type="string", name="title", nullable=false, unique=true)
     */
    protected $title;
    /**
     * @ORM\Column(type="string", name="alias", unique=true)
     */
    protected $alias;

    /**
     * @ORM\OneToMany(targetEntity="MenuItem",mappedBy="id")
     * @ORM\JoinTable(name="menu")
     * @ORM\JoinColumn(name="menu_id")
     * @var Collection
     */
    protected $items;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param mixed $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return Menu
     */
    public function getItems(): Collection
    {
        if ($this->items === null){
            return new ArrayCollection();
        }
        return $this->items;
    }

    public function jsonSerialize()
    {
        return [
            'title' => $this->title,
            'alias' => $this->alias,
            'items' => $this->getItems()->getValues()
        ];
    }


}