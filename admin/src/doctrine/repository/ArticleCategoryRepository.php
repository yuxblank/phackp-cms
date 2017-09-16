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
}