<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuri.blanc
 * Date: 21/09/2017
 * Time: 11:52
 */

namespace cms\library\crud;


use cms\doctrine\CMSModel;
use yuxblank\phackp\http\api\ServerRequestInterface;

trait RequestSerializer
{


    public function serialize(ServerRequestInterface $serverRequest, CMSModel $object){

        $refl = new \ReflectionClass($object);

        if ($this->canHaveBody($serverRequest)) {

            $requestBody = $serverRequest->getParsedBody();

            foreach ($object->getMapping() as $key => $value) {

                if(array_key_exists($key,$requestBody)){

                    if ($refl->hasMethod('set'.$value)) {
                        $refl->getMethod('set'.$value)->invoke($object, $requestBody['$key']);
                    }
                }

            }


        }
    }

    private function canHaveBody(ServerRequestInterface $serverRequest){
        return
            $serverRequest->getMethod() === 'POST' ||
            $serverRequest->getMethod() === 'PUT' ||
            $serverRequest->getMethod() === 'CONNECT' ||
            $serverRequest->getMethod() === 'OPTIONS' ||
            $serverRequest->getMethod() === 'PATCH';
    }

}