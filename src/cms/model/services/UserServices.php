<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 21/06/2017
 * Time: 20:47
 */

namespace cms\model\services;


use cms\model\User;
use cms\model\UserRole;

class UserServices
{

    private $user;
    private $userRole;

    /**
     * UserServices constructor.
     * @param User $user
     * @param UserRole $userRole
     */
    public function __construct(User $user, UserRole $userRole)
    {
        $this->user = $user;
        $this->userRole = $userRole;
    }

}