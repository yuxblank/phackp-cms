<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 10/03/18
 * Time: 19.42
 */

namespace cms\model;


class UserFactory
{


    public static function userFactory(array $params):\cms\doctrine\model\User {
        $user = new \cms\doctrine\model\User();
        $user->setStatus((int)$params['status']);
        $user->setUsername(null ?? filter_var($params['username'], FILTER_SANITIZE_STRING));
        $user->setEmail(null ?? filter_var($params['email'], FILTER_SANITIZE_EMAIL));
        if ($params['id']) {
            $user->setId((int)$params['id']);
        }
        if ($params['roles']){
            foreach ($params['roles'] as $role){
                $user->addRole(self::roleFactory(new \cms\doctrine\model\UserRole(),$role));
            }
        }
        if ($params['password']){
            $user->setPassword($params['password']);
        }
        return $user;
    }

    public static function roleFactory(\cms\doctrine\model\UserRole $role, array $params):\cms\doctrine\model\UserRole {
        if ($params['id']) {
            $role->setId((int)$params['id']);
        }
        $role->setStatus((int) $params['status']);
        $role->setTitle($params['title'] ? filter_var($params['title'], FILTER_SANITIZE_STRING) : null);
        $role->setLevel($params['level'] !== null ? (int)$params['level'] : null);
        return $role;
    }

}