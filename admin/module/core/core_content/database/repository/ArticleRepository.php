<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 16/09/2017
 * Time: 14:59
 */

namespace core\core_content\database\repository;


use cms\doctrine\model\User;

use core\core_content\database\entity\Article;
use core\core_content\database\entity\ArticleCategory;
use Doctrine\ORM\EntityManagerInterface;
use yuxblank\phackp\database\EntityRepository;

class ArticleRepository extends EntityRepository
{

    /**
     * ArticleRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Article::class);
    }

    public function getUserArticles(User $user): array
    {
        return $this->_em->createQuery('SELECT a FROM '. Article::class .' a WHERE a.user_id=:id')
            ->setParameter('id', $user->getId())
            ->getResult();
    }

    public function getCategories(): array
    {
        return $this->_em->createQuery("SELECT c FROM ". ArticleCategory::class ." c")
            ->getResult();
    }

    /**
     * @param string $title
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByTitle(string $title){
        return $this->_em->createQuery("SELECT a FROM  " . Article::class . ' a WHERE a.title=:title')
               ->setParameter('title', $title)
               ->getSingleResult();
    }

    /**
     * @param bool $active
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function count(bool $active = false){
        $query = $this->_em->createQuery("SELECT COUNT(c) FROM " . Article::class  ." c WHERE c.status = :state");
        $query->setParameter('state', $active ? 1 : 0);
        return $query->getSingleScalarResult();
    }

    /**
     * @param Article $article
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Article $article)
    {
        $this->_em->persist($article);
        $this->_em->flush($article);
    }

    /**
     * @param Article $article
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Article $article)
    {
        $this->_em->merge($article);
        $this->_em->flush($article);
    }


}