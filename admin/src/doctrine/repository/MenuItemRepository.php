<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 24/10/2017
 * Time: 19:42
 */

namespace cms\doctrine\repository;


use cms\doctrine\model\MenuItem;
use Doctrine\ORM\EntityManagerInterface;
use yuxblank\phackp\database\EntityRepository;

class MenuItemRepository extends EntityRepository
{


    /**
     * MenuItemRepository constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, MenuItem::class);
    }



}