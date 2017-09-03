<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 03/09/2017
 * Time: 16:45
 */

namespace cms\doctrine\repository;


use cms\doctrine\model\User;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository
{
    /** @var  EntityManagerInterface */
    protected $em;
    /** @var  ObjectRepository */
    protected $userRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em =  $entityManager;
        $this->userRepository = $this->em->getRepository(User::class);
    }


    public function findUser(string $username){

    }



}