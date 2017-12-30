<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuriblanc
 * Date: 17/09/17
 * Time: 01:22
 */

namespace core\core_banner\database\entity;
use cms\doctrine\BaseEntity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity @ORM\Table(name="banner")
 * Class Banner
 * @package cms\doctrine\model
 */
class Banner extends BaseEntity
{

    /**
     * @ORM\Column (name="title", type="string")
     */
    protected $title;
    /**
     * @ORM\Column (name="image", type="string")
     */
    protected $image;
    /**
     * @ORM\Column (name="code", type="string")
     */
    protected $code;
    /**
     * @ORM\Column (name="url", type="string")
     */
    protected $url;
    /**
     * @ORM\Column (name="type", type="string")
     */
    protected $type;
    /**
     * @ORM\Column (name="click", type="integer")
     */
    protected $click;
    /**
     * @ORM\Column (name="views", type="integer")
     */
    protected $views;


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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
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
    public function getClick()
    {
        return $this->click;
    }

    /**
     * @param mixed $click
     */
    public function setClick($click)
    {
        $this->click = $click;
    }

    /**
     * @return mixed
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param mixed $views
     */
    public function setViews($views)
    {
        $this->views = $views;
    }



}