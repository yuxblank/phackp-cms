<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 03/09/2017
 * Time: 16:45
 */

namespace cms\doctrine\repository;


use cms\doctrine\model\User;
use cms\doctrine\model\UserRole;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use yuxblank\phackp\database\EntityRepository;
use Zend\Crypt\Password\Bcrypt;
use Zend\Crypt\Password\Exception\InvalidArgumentException;

class UserRepository extends EntityRepository implements UserRepositoryInterface
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
        $this->bcrypt = $bcrypt;
    }

    /**
     * @param string $username
     * @param string $unsafePassword
     * @param string $email
     * @param UserRole $role
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Zend\Crypt\Password\Exception\RuntimeException
     * @return User
     */
    public function createUser(string $username, string $unsafePassword, string $email, UserRole $role): User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($this->bcrypt->create($unsafePassword));
        $user->setRole($role);
        $user->setDateCreated(new \DateTime());
        $user->setStatus(1);
        $this->_em->persist($user);
        return $user;
    }

    /**
     * @param string $username
     * @param string $oldPassword
     * @param string $newPassword
     * @param string $email
     * @param UserRole $role
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Zend\Crypt\Password\Exception\InvalidArgumentException
     * @throws \Zend\Crypt\Password\Exception\RuntimeException
     */
    public function updateUser(string $username, string $oldPassword, string $newPassword, string $email, UserRole $role)
    {
        $user = $this->findUser($username);
        if (!$this->bcrypt->verify($oldPassword, $user->getPassword())) {
            throw new InvalidArgumentException('Password is not valid');
        }
        $user->setEmail($email);
        $user->setPassword($this->bcrypt->create($newPassword));
        $user->setRole($role);
        $user->setStatus(1);
        $user->setDateUpdated(new \DateTime());
        $this->_em->persist($user);
    }

    /**
     * @param string $username
     * @param string $email
     * @param int $status
     * @param UserRole $role
     * @param string $password
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Zend\Crypt\Password\Exception\RuntimeException
     */
    public function updateUserDetails(string $username, string $email, int $status, UserRole $role, string $password = null)
    {
        $user = $this->findUser($username);
        $user->setEmail($email);
        if ($password) {
            $user->setPassword($this->bcrypt->create($password));
        }
        $user->setRole($role);
        $user->setStatus($status);
        $user->setDateUpdated(new \DateTime());
        $this->_em->persist($user);
        return $user;
    }

    /**
     * @param string $email
     * @return User|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function findUser(string $email)
    {

        return $this->_em->createQuery("SELECT u FROM cms\doctrine\model\User u WHERE u.email = :email")
            ->setParameter(':email', $email)
            ->getSingleResult();
    }

    /**
     * @param array $id
     * @return User|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function removeUsers(array $id)
    {

        return $this->_em->createQuery("DELETE FROM cms\doctrine\model\User u WHERE u.id IN (:ids)")
            ->setParameters(array('ids' => $id))
            ->execute();
    }

    /**
     * @param $username
     * @param $password
     * @param $level
     * @return bool
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function authenticateUser($username, $password, $level)
    {
        $user = $this->findUser($username);
        return $this->bcrypt->verify($password, $user->getPassword()) && ($user->isAdmin() || $user->isSuperUser());
    }

    /**
     * @param bool $active
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function count(bool $active = false)
    {
        $query = $this->_em->createQuery("SELECT COUNT(u) FROM cms\doctrine\model\User u WHERE u.status = :state");
        $query->setParameter('state', $active ? 1 : 0);
        return $query->getSingleScalarResult();
    }


    // todo ACL
    public function isAuthorizedFor(User $user, string $task)
    {

    }

    /**
     * @param string $username
     * @param string $password
     * @param string $grantType
     * @param ClientEntityInterface $clientEntity
     * @return UserEntityInterface|mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getUserEntityByUserCredentials(
        $username,
        $password,
        $grantType,
        ClientEntityInterface $clientEntity
    )
    {
        /** @var User $user */
        $user = $this->
        _em->createQuery(
            'SELECT u FROM ' . User::class . ' u WHERE u.username=:username')
            ->setParameter('username', $username)
            ->getSingleResult();

        if ($this->bcrypt->verify($password, $user->getPassword())) {
            return $user;
        }
        throw new NoResultException();
    }

    public function save(User $user){
        $password = $this->bcrypt->create($user->getPassword());
        $user->setPassword($password);
        $this->_em->persist($user);
    }
    public function update(User $user){
        return $this->_em->merge($user);
    }

    public function delete(User $user)
    {
        $this->_em->remove($user);
    }


}