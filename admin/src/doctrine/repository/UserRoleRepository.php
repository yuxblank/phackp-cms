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

}