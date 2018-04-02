<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 30/12/17
 * Time: 12.59
 */


namespace cms\doctrine\repository;


use cms\doctrine\model\Menu;
use cms\library\crud\EntityLinker;
use Doctrine\ORM\EntityManager;
use yuxblank\phackp\database\EntityRepository;

class MenuRepository extends EntityRepository
{
    private $entityLinker;
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, Menu::class);
    }


    /**
     * @param Menu $menu
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Menu $menu){
        $this->_em->persist($menu);
        $this->_em->flush($menu);

    }

    public function update($menu)
    {
        $menu = $this->_em->merge($menu);
        $this->_em->flush($menu);
        return $menu;
    }

    /**
     * @param string $title
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @return Menu
     */
    public function findByTitle(string $title){
        return $this->_em->createQuery('SELECT m FROM ' . Menu::class . ' m WHERE m.title=:title')
            ->setParameter('title',$title)
            ->getSingleResult();
    }


}