<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 21/06/2017
 * Time: 00:40
 */

namespace cms\controller;


use cms\library\crud\Response;
use cms\model\UserFactory;
use yuxblank\phackp\http\api\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class UserController extends BaseUserController
{

    public function create(ServerRequestInterface $serverRequest)
    {

      $user = UserFactory::userFactory($this->serverRequest->getParsedBody());

      $this->userRepository->save($user);

      return Response::ok($user)->build();


    }

    public function read(ServerRequestInterface $serverRequest)
    {
        if($this->serverRequest->getPathParams()){
            $id = $this->serverRequest->getPathParams()['id'] ?? null;
            $user = $this->userRepository->findOneBy(['id' => $id]);
            return Response::ok($user)->build();
        }
        $users = $this->userRepository->findAll();
        return Response::ok($users)->build();

    }

    public function update(ServerRequestInterface $serverRequest)
    {

        $user = UserFactory::userFactory($this->serverRequest->getParsedBody());


        $user = $this->userRepository->update($user);

        return Response::ok($user)->build();


    }

    public function delete(ServerRequestInterface $serverRequest)
    {
        return new JsonResponse(['result' => parent::delete($serverRequest)->offsetGet('users.removed')]);
    }


}