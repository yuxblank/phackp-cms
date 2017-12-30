<?php

use cms\doctrine\repository\ArticleRepository;

/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 29/12/17
 * Time: 10.57
 */

class ArticleService
{
    /** @var ArticleRepository */
    protected $articleRepository;

    /**
     * ContentServices constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }


    public function getArticleByTitle(string $title) {
        try {
            return $this->articleRepository->findByTitle($title);
        } catch (\Doctrine\ORM\NoResultException $e) {

        } catch (\Doctrine\ORM\NonUniqueResultException $e) {

        }
        return null;
    }


}