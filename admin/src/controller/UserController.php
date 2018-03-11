<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 21/06/2017
 * Time: 00:40
 */

namespace cms\controller;


use cms\doctrine\model\User;
use cms\library\crud\Response;
use cms\model\UserFactory;
use Doctrine\Common\Collections\ArrayCollection;
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

        /** @var User $storedUser */
        $storedUser = $this->userRepository->findOneBy(['id' => $user->getId()]);
        $storedUser->setStatus($user->getStatus());
        $storedUser->setEmail($user->getEmail());

        $roles = new ArrayCollection();
        foreach ($user->getRoles() as $role){
            $roles->add($this->userRoleRepository->findOneBy(['id' => $role->getId()]));
        }
        $storedUser->setRoles($roles);
        $user = $this->userRepository->update($storedUser);

        return Response::ok($user)->build();


    }

    public function delete(ServerRequestInterface $serverRequest)
    {
        return new JsonResponse(['result' => parent::delete($serverRequest)->offsetGet('users.removed')]);
    }


}