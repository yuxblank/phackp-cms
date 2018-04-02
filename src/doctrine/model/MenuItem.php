<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 20/09/2017
 * Time: 16:13
 */

namespace cms\doctrine\model;
use cms\doctrine\BaseEntity;
use cms\library\crud\LinkableEntity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity @ORM\Table(name="menu_item")
 * @ORM\HasLifecycleCallbacks()
 * Class MenuItem
 * @package cms\doctrine\model
 */
class MenuItem extends BaseEntity implements \JsonSerializable, LinkableEntity
{
    /**
     * @ORM\Column(type="string", name="title", nullable=false)
     */
    protected $title;
    /**
     * @ORM\Column(type="string", name="alias", unique=true)
     */
    protected $alias;


    /**
     * @ORM\ManyToOne(targetEntity="Menu")
     * @var Menu
     */
    protected $menu;

    /**
     * @ORM\Column(type="string", nullable=false, name="action")
     */
    protected $action;

    /**
     * @ORM\Column(type="array", nullable=true, name="parameters")
     */
    protected $parameters;


    protected $link;

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
    public function getMenu(): Menu
    {
        return $this->menu;
    }

    /**
     * @param Menu $menu
     */
    public function setMenu(Menu $menu)
    {
        $this->menu = $menu;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param mixed $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink(string $link)
    {
        $this->link = $link;
    }




    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'alias' => $this->getAlias(),
            'status' => $this->getStatus(),
            'link' => $this->getLink(),
            'date_created' => $this->getDateCreated(),
            'date_updated' => $this->getDateUpdated()
        ];
    }

    /** @ORM\PrePersist */
    public function prePersist(){
        $this->dateCreated = new \DateTime();
    }
    /** @ORM\PreUpdate */
    public function preUpdate(){
        $this->dateUpdated = new \DateTime();
    }


}