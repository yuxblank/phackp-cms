<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 20/09/2017
 * Time: 16:06
 */

namespace cms\doctrine\model;
use cms\doctrine\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity @ORM\Table(name="menu")
 * Class Menu
 * @package cms\doctrine\model
 */
class Menu extends BaseEntity
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
     * @var Menu
     */
    protected $menu;

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




}