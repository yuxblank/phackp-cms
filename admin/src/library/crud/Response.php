<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 30/12/17
 * Time: 14.41
 */

namespace cms\library\crud;


use yuxblank\phackp\exceptions\InvocationException;
use Zend\Diactoros\Response\JsonResponse;

class Response
{
    private static $instance;
    private $data;
    private $status;
    private $headers = [];
    private $options = \Zend\Diactoros\Response\JsonResponse::DEFAULT_JSON_FLAGS;

    private function __construct($data, int $status)
    {
        $this->data = $data;
        $this->status = $status;
    }

    public static function ok($data = [], int $status=200)
    {
        if (self::$instance === null){
            self::$instance = new Response($data,$status);
        } else {
            throw new InvocationException("Response object was already created");
        }
        return self::$instance;
    }

    public static function error(int $status, $data = [])
    {
        if (self::$instance === null){
            self::$instance = new Response($data, $status);
        }
        return self::$instance;
    }


    public function status(int $status){
        $this->status = $status;
    }

    public function withHeaders(array $headers){
        $this->headers = $headers;
    }
    public function addHeader(string $header){
        $this->headers[] = $header;
    }
    public function options(int $options){
        $this->options = $options;
    }
    public function build(): JsonResponse
    {
        return new JsonResponse($result = array(
            'result' => $this->data
        )
            , $this->status,$this->headers, $this->options);
    }


}