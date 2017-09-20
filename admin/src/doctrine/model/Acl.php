<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 20/09/2017
 * Time: 16:38
 */

namespace cms\doctrine\model;
use cms\doctrine\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity @ORM\Table(name="acl")
 * Class Acl
 * @package cms\doctrine\model
 */
class Acl extends BaseEntity
{
    /**
     * @ORM\Column(type="string", nullable=false, name="title")
     */
    protected $title;


}