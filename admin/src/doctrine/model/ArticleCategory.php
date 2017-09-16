<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 16/09/2017
 * Time: 14:49
 */

namespace cms\doctrine\model;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity @ORM\Table(name="article_category")
 * Class Article
 * @package cms\doctrine\model
 */
class ArticleCategory
{
    /**
     * @ORM\Id @ORM\Column(type="integer",name="id") @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * @ORM\Column (name="title", type="string")
     */
    protected $title;
    /**
     * @ORM\Column (name="content", type="text")
     */
    protected $content;
    /**
     * @ORM\Column (name="meta_tags", type="string")
     */
    protected $meta_tags;
    /**
     * @ORM\Column (name="alias", type="string")
     */
    protected $alias;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

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



}