<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 24/02/18
 * Time: 21.38
 */

namespace cms\module\core\core_content\factory;


use cms\doctrine\model\User;
use core\core_content\database\entity\Article;
use core\core_content\database\entity\ArticleCategory;

class ContentFactory
{

    public static function ArticleFactory(array $values, User $user):Article{
        $article = new Article();
        if (array_key_exists('id', $values)){
            $article->setId((int)$values['id']);
        }
        $article->setTitle(null ?? filter_var($values['title'], FILTER_SANITIZE_STRING));
        $article->setContent(null ?? htmlspecialchars($values['content']));
        $article->setMetaDesc(null ?? filter_var($values['meta_description'], FILTER_SANITIZE_STRING));
        $article->setMetaTitle(null ?? filter_var($values['meta_title'], FILTER_SANITIZE_STRING));
        $article->setMetaTags(null ?? filter_var($values['meta_tags'], FILTER_SANITIZE_STRING));
        $article->setAlias(null ?? filter_var($values['alias'], FILTER_SANITIZE_STRING));
        $article->setStatus(null ?? (int)$values['status']);
        if (array_key_exists('categories',$values)){

            foreach ($values['categories'] as $submittedCats){

                $article->addCategory(self::ArticleCategoryFactory($submittedCats));
            }

        }
        $article->setUser($user);
        return $article;
    }
    public static function ArticleCategoryFactory(array $values):ArticleCategory{
        $articleCategory = new ArticleCategory();
        if (array_key_exists('id', $values)){
            $articleCategory->setId((int)$values['id']);
        }
        $articleCategory->setTitle(null ?? $values['title']);
        $articleCategory->setContent(null ?? $values['content']);
        $articleCategory->setMetaTags(null ?? $values['meta_tags']);
        $articleCategory->setAlias(null ?? $values['alias']);
        $articleCategory->setStatus(null ?? (int)$values['status']);
        return $articleCategory;
    }

}