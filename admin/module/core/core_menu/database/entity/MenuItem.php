<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 20/09/2017
 * Time: 16:13
 */

namespace core\core_menu\database\entity;
use cms\doctrine\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity @ORM\Table(name="menu_item")
 * Class MenuItem
 * @package cms\doctrine\model
 */
class MenuItem extends BaseEntity
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
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="menu_id")
     * @ORM\JoinColumn(name="menu_id", referencedColumnName="id")
     */
    protected $menu;

    /**
     * @ORM\ManyToOne(targetEntity="cms\doctrine\model\Action", inversedBy="action_id")
     * @ORM\JoinColumn(name="action_id", referencedColumnName="id")
     */
    protected $action;

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
     * @return mixed
     */
    public function getAction()
    {
        return $this->menu;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->menu = $action;
    }


}