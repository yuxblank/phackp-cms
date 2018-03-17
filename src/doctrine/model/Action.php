<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 24/10/2017
 * Time: 20:35
 */
namespace cms\doctrine\model;
use Doctrine\ORM\Mapping as ORM;
use cms\doctrine\BaseEntity;
/**
 * @ORM\Entity @ORM\Table(name="action")
 * Class Action
 * @package cms\doctrine\model
 */
class Action extends BaseEntity
{
    /**
     * @ORM\Column(type="string", nullable=false, name="title")
     */
    protected $title;

    /**
     * @ORM\ManyToOne(targetEntity="Module", fetch="EAGER")
     * @ORM\JoinTable(name="module")
     * @ORM\JoinColumn(name="module_id")
     * @var Acl
     */
    protected $module;

}