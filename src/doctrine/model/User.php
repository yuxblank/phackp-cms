<?php
namespace cms\doctrine\model;
use cms\doctrine\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities\UserEntityInterface;


/**
 * @ORM\Entity @ORM\Table(name="user")
 * Class User
 * @ORM\HasLifecycleCallbacks()
 * @package cms\doctrine\model
 */
class User extends BaseEntity implements UserEntityInterface, \JsonSerializable
{
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
     *     inverseJoinColumns={@ORM\JoinColumn(name="user_role_id", referencedColumnName="id")}
     *  )
     * @var Collection
     */
    protected $roles;


    public function __construct()
    {
        $this->roles = new ArrayCollection();
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
    public function getPassword()
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


    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param UserRole $role
     */
    public function addRole(UserRole $role)
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
        }
    }

    public function setRoles(Collection $roles)
    {
        $this->roles->clear();
        foreach ($roles->getValues() as $role){
            $this->roles->add($role);
        }
    }

    public function isCustomer(): bool
    {
        return $this->hasRole(UserRole::CUSTOMER);
    }

    public function isSuperUser():bool{
        return $this->hasRole(UserRole::SUPERUSER);
    }

    public function isAdmin():bool{
        return $this->hasRole(UserRole::ADMINISTRATOR);
    }


    public function hasRole(string $role):bool {
        /** @var UserRole $element */
        foreach ($this->getRoles() as $element){
            if ($element->getTitle()  === $role){
                return true;
            }
        }
        return false;
    }

    public function hasRights(int $level): bool
    {
        /** @var UserRole $element */
        foreach ($this->getRoles() as $element){
            if ($element->getLevel() >= $level){
                return true;
            }
        }
        return false;
    }

    public function getIdentifier()
    {
        return $this->getId();
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'roles' => $this->getRoles()->getValues(),
            'status' => $this->getStatus()
        ];
    }

    /** @ORM\PrePersist */
    public function prePersist(){
        $this->dateCreated = new \DateTime();
    }
    /** @ORM\PreUpdate */
    public function preUpdate(){
        $this->dateUpdated = new \DateTime();
    }


}