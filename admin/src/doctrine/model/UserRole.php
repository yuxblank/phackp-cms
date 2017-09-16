<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 03/09/2017
 * Time: 18:48
 */

namespace cms\doctrine\model;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity @ORM\Table(name="userrole")
 * Class UserRole
 * @package cms\doctrine\model
 */
class UserRole
{

    const CUSTOMER = 'customer';
    const ADMINISTRATOR = 'administrator';
    const SUPERADMIN = 'superadmin';


    /**
     * @ORM\Id @ORM\Column(type="integer",name="id") @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * @ORM\Column(type="string",name="title")
     * @var string
     */
    protected $title;
    /**
     * @ORM\Column(type="integer",name="level")
     * @var int
     */
    protected $level;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level)
    {
        $this->level = $level;
    }





}