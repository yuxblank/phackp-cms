<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 16/09/2017
 * Time: 14:49
 */

namespace cms\doctrine\model;
use cms\doctrine\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="article_category")
 * @ORM\HasLifecycleCallbacks()
 * Class Article
 */
class ArticleCategory extends BaseEntity implements \JsonSerializable
{

    /**
     * @ORM\Column (name="title", type="string",nullable=false, unique=true)
     */
    protected $title;
    /**
     * @ORM\Column (name="content", type="text",nullable=true)
     */
    protected $content;

    /**
     * @ORM\Column (name="meta_title", type="string",nullable=true)
     */
    protected $meta_title;
    /**
     * @ORM\Column (name="meta_desc", type="string",nullable=true)
     */
    protected $meta_desc;
    /**
     * @ORM\Column (name="meta_tags", type="string",nullable=true)
     */
    protected $meta_tags;
    /**
     * @ORM\Column (name="alias", type="string",nullable=true)
     */
    protected $alias;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getMetaTitle()
    {
        return $this->meta_title;
    }

    /**
     * @param mixed $meta_title
     */
    public function setMetaTitle($meta_title)
    {
        $this->meta_title = $meta_title;
    }

    /**
     * @return mixed
     */
    public function getMetaDesc()
    {
        return $this->meta_desc;
    }

    /**
     * @param mixed $meta_desc
     */
    public function setMetaDesc($meta_desc)
    {
        $this->meta_desc = $meta_desc;
    }


    /**
     * @return string
     */
    public function getMetaTags()
    {
        return $this->meta_tags;
    }

    /**
     * @param string $meta_tags
     */
    public function setMetaTags($meta_tags)
    {
        $this->meta_tags = $meta_tags;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'content' => htmlspecialchars_decode($this->getContent()),
            'date_created' => $this->getDateCreated(),
            'date_updated' => $this->getDateUpdated(),
            'meta_title' => $this->getMetaTitle(),
            'meta_descr' => $this->getMetaDesc(),
            'meta_tags' => $this->getMetaTags(),
            'alias' => $this->getAlias(),
            'status' => $this->getStatus()
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