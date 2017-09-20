<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 03/09/2017
 * Time: 20:26
 */

namespace cms\doctrine\model;

use cms\doctrine\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="article")
 * Class Article
 * @package cms\doctrine\model
 */
class Article extends BaseEntity
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
     * @ORM\Column (name="meta_title", type="string")
     */
    protected $meta_title;
    /**
     * @ORM\Column (name="meta_desc", type="string")
     */
    protected $meta_desc;
    /**
     * @ORM\Column (name="meta_tags", type="string")
     */
    protected $meta_tags;

    /**
     * @ORM\ManyToMany (targetEntity="ArticleCategory", fetch="EAGER")
     * @ORM\JoinTable(
     *     name="article_categories",
     *     joinColumns= {@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="article_category_id", referencedColumnName="id", unique=true)}
     *  )
     */
    protected $category;
    /**
     * @ORM\ManyToOne (targetEntity="User", fetch="EAGER")
     * @ORM\JoinTable(name="user")
     * @ORM\JoinColumn(name="user_id")
     * @var User
     */
    protected $user;
    /**
     * @ORM\Column (name="alias", type="string")
     */
    protected $alias;

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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
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
     * @return mixed
     */
    public function getMetaTags()
    {
        return $this->meta_tags;
    }

    /**
     * @param mixed $meta_tags
     */
    public function setMetaTags($meta_tags)
    {
        $this->meta_tags = $meta_tags;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
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


}