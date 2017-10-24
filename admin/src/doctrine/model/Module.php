<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 24/10/2017
 * Time: 20:17
 */
namespace cms\doctrine\model;
use Doctrine\ORM\Mapping as ORM;
use cms\doctrine\BaseEntity;
/**
 * @ORM\Entity @ORM\Table(name="module")
 * Class Module
 * @package cms\doctrine\model
 */
class Module extends BaseEntity
{
    /**
     * @ORM\Column(type="string", nullable=false, name="title")
     */
    protected $title;
    /**
     * @ORM\Column(type="string", nullable=false, name="version")
     */
    protected $version;
    /**
     * @ORM\Column(type="string", nullable=false, name="author")
     */
    protected $author;
    /**
     * @ORM\Column(type="string", nullable=false, name="author_email")
     */
    protected $authorEmail;
    /**
     * @ORM\Column(type="string", nullable=false, name="author_url")
     */
    protected $authorUrl;
    /**
     * @ORM\Column(type="integer", nullable=false, name="type")
     */
    protected $type;

    /**
     * @ORM\Column(type="string", nullable=false, name="namespace")
     */
    protected $namespace;

    /**
     * @ORM\OneToMany(targetEntity="Action",mappedBy="id")
     * @ORM\JoinTable(name="action")
     * @ORM\JoinColumn(name="action_id")
     * @var array
     */
    protected $actions;



}