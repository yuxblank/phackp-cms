<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 04/04/18
 * Time: 23.05
 */

return [
    'cms.actions' => [
        ['action' => 'api.articles', 'title' => 'Articles', 'description' => 'List of articles',
            'filter' => [
                ['action' => 'category.list', 'type' => 'list', 'title' => 'Categories', 'description' => 'Filter categories','query'=>'title']
            ]
        ],
        ['action' => 'api.article', 'title' => 'Article',
            'filter' => [
                ['action' => 'content.list', 'type' => 'item', 'title' => 'Article', 'description' => 'One article', 'query'=>'title'],
            ]
        ]
    ]
];