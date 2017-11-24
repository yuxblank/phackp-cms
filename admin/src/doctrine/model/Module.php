<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 24/10/2017
 * Time: 20:17
 */
namespace cms\doctrine\model;
use cms\model\api\IModule;
use Doctrine\ORM\Mapping as ORM;
use cms\doctrine\BaseEntity;
/**
 * @ORM\Entity @ORM\Table(name="module")
 * Class Module
 * @package cms\doctrine\model
 */
class Module extends BaseEntity implements IModule
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
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    /**
     * @param mixed $authorEmail
     */
    public function setAuthorEmail($authorEmail)
    {
        $this->authorEmail = $authorEmail;
    }

    /**
     * @return mixed
     */
    public function getAuthorUrl()
    {
        return $this->authorUrl;
    }

    /**
     * @param mixed $authorUrl
     */
    public function setAuthorUrl($authorUrl)
    {
        $this->authorUrl = $authorUrl;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param mixed $namespace
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * @return array
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * @param array $actions
     */
    public function setActions(array $actions)
    {
        $this->actions = $actions;
    }






}