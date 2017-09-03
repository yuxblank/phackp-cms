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
     * @ORM\Column (name="email")
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column (name="password")
     * @var string
     */
    protected $password;

    /**
     * @ORM\Column (name="userrole_id")
     * @var int
     */
    protected $role;

    /**
     * @ORM\Column (type="datetime", name="date_created")
     * @var \DateTime
     */
    protected $dateCreated;

    /**
     * @ORM\Column (name="status")
     * @var int
     */
    protected $status;

    /**
     * @return int
     */
    public function getId(): int
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
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * @param int $role
     */
    public function setRole(int $role)
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





}