<?php
namespace cms\model;



use yuxblank\phackp\database\Model;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Item
 *
 * @author yuri.blanc
 */
class Item extends Model
{
    public $id;
    public $title;
    public $content;
    public $meta_title;
    public $meta_desc;
    public $meta_tags;
    public $date_created;
    public $date_edit;
    public $status;
    public $category_id;
    public $user_id;
    public $alias;

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function countActive()
    {
        return count($this->find("WHERE status=?", 1));
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 0 :
                return "Non attivo";
                break;
            case 1 :
                return "Pubblicato";
                break;
        }
    }

    public function getStates()
    {
        return array("Non attivo", "Pubblicato");
    }

    public function getShortDescription($charNum)
    {
        return htmlspecialchars_decode(substr($this->content, 0, $charNum));
    }

    /**
     * @return User
     */
    public function user()
    {
        return $this->hasOne(User::class);

    }


    public function filteredArticles($user)
    {
        return $this->findAll("where user_id=?", $user->id);

    }

}
