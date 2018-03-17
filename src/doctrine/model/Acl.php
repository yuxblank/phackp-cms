<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 20/09/2017
 * Time: 16:38
 */

namespace cms\doctrine\model;
use cms\doctrine\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity @ORM\Table(name="acl")
 * Class Acl
 * @package cms\doctrine\model
 */
class Acl extends BaseEntity
{
    /**
     * @ORM\Column(type="string", nullable=false, name="title")
     */
    protected $title;
    /**
     * @ORM\OneToMany(targetEntity="AclPermission",mappedBy="id")
     * @ORM\JoinTable(name="acl_permission")
     * @ORM\JoinColumn(name="acl_id")
     * @var array
     */
    protected $permissions;

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
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    /**
     * @param array $permissions
     */
    public function setPermissions(array $permissions)
    {
        $this->permissions = $permissions;
    }



}