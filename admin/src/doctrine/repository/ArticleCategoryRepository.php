<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 16/09/2017
 * Time: 16:08
 */

namespace cms\doctrine\repository;


use cms\doctrine\model\ArticleCategory;
use Doctrine\ORM\EntityManager;
use yuxblank\phackp\database\EntityRepository;

class ArticleCategoryRepository extends EntityRepository
{

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, ArticleCategory::class);
    }


    public function count(){
        $query = $this->_em->createQuery("SELECT COUNT(u) FROM cms\doctrine\model\ArticleCategory u");
        return $query->getSingleScalarResult();
    }

    /**
     * @param ArticleCategory $articleCategory
     * @return ArticleCategory
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(ArticleCategory $articleCategory){
        $this->_em->persist($articleCategory);
        $this->_em->flush($articleCategory);
        return $articleCategory;
    }

    /**
     * @param ArticleCategory $articleCategory
     * @return ArticleCategory
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(ArticleCategory $articleCategory){
        $this->_em->merge($articleCategory);
        $this->_em->flush($articleCategory);
        return $articleCategory;
    }

    /**
     * @param array $ids
     * @return mixed
     */
    public function deleteArticles(array $ids){
        return $this->_em->createQuery("DELETE FROM cms\doctrine\model\ArticleCategory u WHERE u.id IN (:ids)")
            ->setParameters(array('ids' => $ids))
            ->execute();
    }
}