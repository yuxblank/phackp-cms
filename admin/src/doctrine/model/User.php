<?php
namespace cms\doctrine\model;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity @ORM\Table(name="user")
 * Class User
 * @package cms\doctrine\model
 */
class User
{
    /**
     * @ORM\Id @ORM\Column(type="integer",name="id") @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * @ORM\Column (name="username",type="string", length=255, nullable=false,unique=true)
     * @var string
     */
    protected $username;
    /**
     * @ORM\Column (name="email", type="string", length=255, nullable=false)
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column (name="password", type="string", length=255, nullable=false)
     * @var string
     */
    protected $password;

    /**
     * @ORM\ManyToMany (targetEntity="UserRole", fetch="EAGER")
     * @ORM\JoinTable(
     *     name="user_roles",
     *     joinColumns= {@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="user_role_id", referencedColumnName="id", unique=true)}
     *  )
     * @var array
     */
    protected $role;

    /**
     * @ORM\Column (type="datetime", name="date_created")
     * @var \DateTime
     */
    protected $dateCreated;
    /**
     * @ORM\Column (name="date_updated", type="date")
     */
    protected $date_updated;
    /**
     * @ORM\Column (name="status")
     * @var int
     */
    protected $status;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }


    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return UserRole
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param UserRole $role
     */
    public function setRole(UserRole $role)
    {
        $this->role = $role;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     */
    public function setDateCreated(\DateTime $dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return mixed
     */
    public function getDateUpdated()
    {
        return $this->date_updated;
    }

    /**
     * @param mixed $date_updated
     */
    public function setDateUpdated($date_updated)
    {
        $this->date_updated = $date_updated;
    }


    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function isCustomer(): bool
    {
        return $this->getRole()->getTitle() === UserRole::CUSTOMER;
    }

    public function isSuperUser():bool{
        return $this->getRole()->getTitle() === UserRole::SUPERUSER;
    }

    public function isAdmin():bool{
        return $this->getRole()->getTitle() === UserRole::ADMINISTRATOR;
    }




}