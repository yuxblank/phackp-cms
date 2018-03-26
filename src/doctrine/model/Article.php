<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 03/09/2017
 * Time: 20:26
 */

namespace cms\doctrine\model;
use cms\doctrine\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity @ORM\Table(name="article")
 * @ORM\HasLifecycleCallbacks()
 * Class Article
 */
class Article extends BaseEntity implements JsonSerializable
{
    /**
     * @ORM\Id @ORM\Column(type="integer",name="id") @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * @ORM\Column (name="title", type="string", unique=true)
     */
    protected $title;
    /**
     * @ORM\Column (name="introduction", type="text",nullable=false)
     */
    protected $introduction;
    /**
     * @ORM\Column (name="content", type="text",nullable=false)
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
     * @ORM\Column (name="meta_tags", type="string", nullable=true)
     */
    protected $meta_tags;

    /**
     * @ORM\ManyToMany (targetEntity="ArticleCategory", fetch="LAZY",indexBy="id")
     * @ORM\JoinTable(
     *     name="article_categories",
     *     joinColumns= {@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="article_category_id", referencedColumnName="id")}
     *  )
     * @var Collection
     */
    protected $categories;
    /**
     * @ORM\ManyToOne (targetEntity="cms\doctrine\model\User", fetch="EAGER")
     * @ORM\JoinTable(name="user")
     * @ORM\JoinColumn(name="user_id",nullable=false)
     * @var User
     */
    protected $user;
    /**
     * @ORM\Column (name="alias", type="string")
     */
    protected $alias;

    /**
     * @ORM\ManyToMany (targetEntity="Tag", fetch="LAZY",cascade={"all"})
     * @ORM\JoinTable(
     *     name="article_tags",
     *     joinColumns= {@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *  )
     * @var Collection
     */
    protected $tags;

    /**
     * Article constructor.
     * @param int $id
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }


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
    public function getIntroduction()
    {
        return $this->introduction;
    }

    /**
     * @param mixed $introduction
     */
    public function setIntroduction($introduction)
    {
        $this->introduction = $introduction;
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
     * @return Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param Collection $categories
     */
    public function setCategories(Collection $categories)
    {
        $this->categories->clear();
        foreach ($categories->getValues() as $cat){
            $this->categories->add($cat);
        }
    }

    public function addCategory(ArticleCategory $category){
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }
    }

    /**
     * @return User
     */
    public function getUser()
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

    /**
     * @return Collection
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @param Collection $tags
     */
    public function setTags(Collection $tags)
    {
        $this->tags = $tags;
    }



    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'introduction' => $this->getIntroduction(),
            'alias' => $this->getAlias(),
            'categories' => $this->getCategories()->getValues(),
            'content' => htmlspecialchars_decode($this->getContent()),
            'tags' => $this->getTags()->getValues(),
            'user' => $this->getUser(),
            'meta_title' => $this->getMetaTitle(),
            'meta_tags' => $this->getMetaTags(),
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