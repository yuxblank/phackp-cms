<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 20/09/2017
 * Time: 16:47
 */

namespace cms\doctrine\model;
use cms\doctrine\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity @ORM\Table(name="acl_permission")
 * Class Article
 * @package cms\doctrine\model
 */
class AclPermission extends BaseEntity
{
    /**
     * @ORM\Column(type="string", name="component",nullable=false)
     */
    protected $component;
    /**
     * @ORM\Column(type="string",name="action",nullable=false)
     */
    protected $action;

    /**
     * @ORM\ManyToOne(targetEntity="Acl", fetch="EAGER")
     * @ORM\JoinTable(name="acl")
     * @ORM\JoinColumn(name="acl_id")
     * @var Acl
     */
    protected $acl;

    /**
     * @return mixed
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * @param mixed $component
     */
    public function setComponent($component)
    {
        $this->component = $component;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getAcl()
    {
        return $this->acl;
    }

    /**
     * @param mixed $acl
     */
    public function setAcl($acl)
    {
        $this->acl = $acl;
    }

}