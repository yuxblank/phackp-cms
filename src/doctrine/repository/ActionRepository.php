<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 30/10/2017
 * Time: 20:52
 */

namespace cms\doctrine\repository;


use cms\doctrine\model\Action;
use Doctrine\ORM\EntityManagerInterface;
use yuxblank\phackp\database\EntityRepository;

class ActionRepository extends EntityRepository
{


    /**
     * ActionRepository constructor.
     * @param EntityManagerInterface $em
     * @internal param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, Action::class);
    }


    public function getActionsByModule(string $moduleName) {
        $query = $this->_em->createQuery("SELECT * FROM cms\doctrine\model\Action INNER JOIN FROM cms\doctrine\model\Module m WHERE UPPER(m.title)=UPPER(:title)");
        $query->setParameter('title', $moduleName);
        return $query->getArrayResult();

    }


}