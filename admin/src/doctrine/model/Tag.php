<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 19/09/2017
 * Time: 14:47
 */

namespace cms\doctrine\model;
use Doctrine\ORM\Mapping as ORM;

class Tag
{

    /**
     * @ORM\Id @ORM\Column(type="integer",name="id") @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * @ORM\Column (name="content", type="string", length=50)
     */
    protected $content;

}