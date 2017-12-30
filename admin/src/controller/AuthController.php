<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 16/09/2017
 * Time: 19:02
 */

namespace cms\controller;


use cms\doctrine\repository\UserRepository;
use cms\overrides\View;
use Doctrine\ORM\NoResultException;
use yuxblank\phackp\core\Controller;
use yuxblank\phackp\core\Session;
use yuxblank\phackp\http\api\ServerRequestInterface;
use yuxblank\phackp\routing\api\Router;
use Zend\Diactoros\Response\JsonResponse;

class AuthController extends Controller
{

    protected $session;
    protected $router;
    protected $view;
    protected $userRepository;

    /**
     * AuthController constructor.
     * @param View $view
     * @param Session $session
     * @param Router $router
     * @param UserRepository $userRepository
     */
    public function __construct(View $view,Session $session, Router $router, UserRepository $userRepository)
    {
        parent::__construct();
        $this->view = $view;
        $this->session = $session;
        $this->router = $router;
        $this->userRepository =  $userRepository;
    }

    public function onBefore()
    {
        // TODO: Implement onBefore() method.
    }

    public function onAfter()
    {
        // TODO: Implement onAfter() method.
    }


    public function login()
    {
        if ($this->session->getValue('user') !== null) {
            $this->keep('warning', 'Sei già autenticato');
        }
        $this->view->render("/admin/login");

    }

    public function logout()
    {
        if ($this->session->getValue("user") !== null) {
            $this->session->stop();
            $this->keep("success", "Ti sei disconnesso correttamente");
            $this->router->switchAction('admin/login');
        } else {
            $this->keep("danger", "Non sei connesso");
            $this->router->switchAction('admin/login');
        }
    }

    public function authenticate(ServerRequestInterface $serverRequest)
    {
        $email = filter_var($serverRequest->getParsedBody()['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($serverRequest->getParsedBody()['password'], FILTER_SANITIZE_STRING);
        try {
                if ($email !== null && $password !== null && $this->userRepository->authenticateUser($email, $password, Admin::USER_MIN_LEVEL)) {
                $this->session->setValue('user', $email);
                $this->keep('success', 'Autenticazione avvenuta con successo!');
                return new JsonResponse(['result' => 'ok']);
            }
        } catch (NoResultException $exception) {
            //todo log
        } catch (\Exception $e) {
            return new JsonResponse(["result" => "Service unavailable"]);
        }
        return new JsonResponse(['result' => 'Authentication was not successful, please retry.']);
    }
}