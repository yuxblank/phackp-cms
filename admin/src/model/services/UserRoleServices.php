<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 24/06/2017
 * Time: 18:12
 */

namespace cms\model\services;


use cms\model\UserRole;
use yuxblank\phackp\database\Database;

class UserRoleServices
{

    private $userRole;

    /**
     * UserRoleServices constructor.
     * @param UserRole $userRole
     * @param Database $database
     */
    public function __construct(UserRole $userRole)
    {
        $this->userRole = $userRole;
    }

    public function getRoles(){
       return $this->userRole->findAll();
    }


}