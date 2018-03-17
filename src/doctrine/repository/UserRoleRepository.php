<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 16/09/2017
 * Time: 15:56
 */

namespace cms\doctrine\repository;


use cms\doctrine\model\UserRole;
use Doctrine\ORM\EntityManagerInterface;
use yuxblank\phackp\database\EntityRepository;

class UserRoleRepository extends EntityRepository
{
    /**
     * UserRoleRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, UserRole::class);
    }


    public function findByLevelGreaterThan(int $level)
    {
        $this->_em->
        createQuery("SELECT u FROM cms\doctrine\model\UserRole u WHERE u.level > :level")
            ->setParameter('level', $level)
            ->getResult();
    }

    public function update(UserRole $role){
        return $this->_em->merge($role);
    }

    /**
     * @param UserRole $role
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(UserRole $role)
    {
        $this->_em->persist($role);
    }

    public function delete(UserRole $role)
    {
        $this->_em->remove($role);
    }

}