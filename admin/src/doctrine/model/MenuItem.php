<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 20/09/2017
 * Time: 16:13
 */

namespace cms\doctrine\model;
use cms\doctrine\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity @ORM\Table(name="menu_item")
 * Class MenuItem
 * @package cms\doctrine\model
 */
class MenuItem extends BaseEntity
{

    protected $title;
    protected $alias;
}