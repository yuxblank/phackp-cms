<?php
namespace cms\model;

use yuxblank\phackp\database\Model;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category
 *
 * @author yuri.blanc
 */
class Category extends Model {
    public $id;
    public $title;
    public $description;
    public $meta_description;
    public $meta_tags;
    public $alias;
    
    public function item() {
        return  $this->oneToMany($this, 'model\\Item');
    }



}
