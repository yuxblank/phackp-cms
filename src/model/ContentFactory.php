<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 24/02/18
 * Time: 21.38
 */

namespace cms\model;


use cms\doctrine\model\Article;
use cms\doctrine\model\ArticleCategory;
use cms\doctrine\model\Tag;
use cms\doctrine\model\User;
use Doctrine\Common\Collections\ArrayCollection;

class ContentFactory
{

    public static function ArticleFactory(Article $article, array $values, User $user):Article{
        $article->setTitle(null ?? filter_var($values['title'], FILTER_SANITIZE_STRING));
        $article->setContent(null ?? htmlspecialchars($values['content']));
        $article->setMetaDesc(null ?? filter_var($values['meta_description'], FILTER_SANITIZE_STRING));
        $article->setMetaTitle(null ?? filter_var($values['meta_title'], FILTER_SANITIZE_STRING));
        $article->setMetaTags(null ?? $values['meta_tags']);
        $article->setAlias(null ?? filter_var($values['alias'], FILTER_SANITIZE_STRING));
        $article->setStatus(null ?? (int)$values['status']);
        if (array_key_exists('categories',$values)){

            $categories = new ArrayCollection();
            foreach ($values['categories'] as $tag){

                $categories->add(self::ArticleCategoryFactory($tag));
            }

            $article->setCategories($categories);
        }
        $article->setUser($user);
        if (array_key_exists('tags',$values)){

            $tags = new ArrayCollection();
            foreach ($values['tags'] as $tag){

                $tags->add(self::TagFactory($tag));
            }

            $article->setTags($tags);
        }
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
        $articleCategory->setParent(null ?? (int )$values['parent']);
        return $articleCategory;
    }

    public static function TagFactory(array $values):Tag {
        $tag = new Tag();
        $tag->setContent(null ?? filter_var($values['content'], FILTER_SANITIZE_STRING));
        $tag->setStatus(null ?? (int)$values['status']);
        return $tag;
    }


}