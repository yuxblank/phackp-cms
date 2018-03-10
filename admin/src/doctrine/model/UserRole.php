<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 03/09/2017
 * Time: 18:48
 */

namespace cms\doctrine\model;

use cms\doctrine\BaseEntity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity @ORM\Table(name="userrole")
 * Class UserRole
 * @package cms\doctrine\model
 */
class UserRole extends BaseEntity implements \JsonSerializable
{

    const CUSTOMER = 'customer';
    const ADMINISTRATOR = 'administrator';
    const SUPERUSER = 'superuser';


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

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'level' => $this->getLevel(),
            'status' => $this->getStatus()
        ];
    }


}