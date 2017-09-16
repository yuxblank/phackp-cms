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
use Doctrine\ORM\Query;
use yuxblank\phackp\database\EntityRepository;
use Zend\Crypt\Password\Bcrypt;

class UserRepository extends EntityRepository
{
    /** @var  Bcrypt */
    protected $bcrypt;


    /**
     * UserRepository constructor.
     * @param EntityManagerInterface $entityManager
     * @param Bcrypt $bcrypt
     */

    public function __construct(EntityManagerInterface $entityManager, Bcrypt $bcrypt)
    {
        parent::__construct($entityManager, User::class);
        $this->bcrypt =  $bcrypt;
    }

    /**
     * @param string $email
     * @return User|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function findUser(string $email){

        return $this->_em->createQuery("SELECT u FROM cms\doctrine\model\User u WHERE u.email = :email")
            ->setParameter(':email', $email)
            ->getSingleResult();
    }

    public function authenticateUser($username, $password, $level){
        $user = $this->findUser($username);
        return $this->bcrypt->verify($password, $user->getPassword()) && $user->getRole()->getLevel() >= $level;
    }

    /**
     * @param bool $active
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function count(bool $active = false){
        $query = $this->_em->createQuery("SELECT COUNT(u) FROM cms\doctrine\model\User u WHERE u.status = :state");
        $query->setParameter('state', $active ? 1 : 0);
        return $query->getSingleScalarResult();
    }

    // todo ACL
    public function isAuthorizedFor(User $user, string $task){

    }





}