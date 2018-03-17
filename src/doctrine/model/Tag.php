<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 19/09/2017
 * Time: 14:47
 */

namespace cms\doctrine\model;
use cms\doctrine\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity @ORM\Table(name="tag")
 * Class Tag
 * @package cms\doctrine\model
 */
class Tag extends BaseEntity
{

    /**
     * @ORM\Column (name="content", type="string", length=50)
     */
    protected $content;

}