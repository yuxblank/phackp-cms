<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 20/09/2017
 * Time: 16:26
 */

namespace cms\doctrine;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\MappedSuperclass */
class BaseEntity
{
    /**
     * @ORM\Id @ORM\Column(type="integer",name="id") @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * @ORM\Column (type="datetime", name="date_created", nullable=true)
     * @var \DateTime
     */
    protected $dateCreated;
    /**
     * @ORM\Column (name="date_updated", type="datetime", nullable=true)
     * @var \DateTime
     */
    protected $dateUpdated;
    /**
     * @ORM\Column (name="status", nullable=false)
     * @var int
     */
    protected $status = 0;

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateCreated()
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
     * @return \DateTime|null
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * @param \DateTime $dateUpdated
     */
    public function setDateUpdated(\DateTime $dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;
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