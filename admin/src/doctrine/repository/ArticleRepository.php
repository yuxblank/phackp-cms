<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 16/09/2017
 * Time: 14:59
 */

namespace cms\doctrine\repository;


use cms\doctrine\model\Article;
use cms\doctrine\model\User;
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
        return $this->_em->createQuery('SELECT a FROM cms\doctrine\model\Article a WHERE a.user_id=:id')
            ->setParameter('id', $user->getId())
            ->getResult();
    }

    public function getCategories(): array
    {
        return $this->_em->createQuery("SELECT c FROM cms\doctrine\model\ArticleCategory c")
            ->getResult();
    }

    public function save(Article $article)
    {
        $this->_em->persist($article);
        $this->_em->flush($article);
    }

    public function update(Article $article)
    {
        $this->_em->merge($article);
        $this->_em->flush($article);
    }


}