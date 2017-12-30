<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 29/12/17
 * Time: 11.55
 */

namespace core\core_content;


class Core_ContentModule
{
    
    protected $articleService;

    /**
     * ContentModule constructor.
     * @param $articleService
     */
    public function __construct(\ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }


    public function getArticleByName(){

    }




}