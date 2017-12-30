<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 30/12/17
 * Time: 14.41
 */

namespace cms\library\crud;


class JsonResponse extends \Zend\Diactoros\Response\JsonResponse
{
    public function __construct($data, int $status = 200, array $headers = [], int $encodingOptions = \Zend\Diactoros\Response\JsonResponse::DEFAULT_JSON_FLAGS)
    {
        $result = array(
            'result' => $data
        );
        \Zend\Diactoros\Response\JsonResponse::__construct($result, $status, $headers, $encodingOptions);
    }


}