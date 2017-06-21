<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 21/06/2017
 * Time: 20:35
 */

namespace cms\model;


use yuxblank\phackp\database\Model;

class UserRole extends Model
{
    public $id;
    public $title;
    public $level;

    const CUSTOMER = 'customer';
    const ADMINISTRATOR = 'administrator';
    const SUPERADMIN = 'superadmin';


}