<?php
/**
 * Created by IntelliJ IDEA.
 * User: TheCo
 * Date: 25/06/2017
 * Time: 21:26
 */

namespace core\core_banner\controller;


use cms\controller\Admin;
use cms\library\crud\CrudController;
use cms\model\Banner;
use cms\model\User;
use yuxblank\phackp\core\Application;
use yuxblank\phackp\http\api\ServerRequestInterface;

class BannerController extends Admin implements CrudController
{

    public function create(ServerRequestInterface $serverRequest)
    {
        if ($serverRequest->getMethod() === ['POST']){
            $image = $_FILES['image'];
            $Banner = new Banner();
            if ($serverRequest->getParsedBody()['id'] !== null && $serverRequest->getParsedBody()['id'] !== '') {
                $Banner->id = $serverRequest->getParsedBody()['id'];
            }
            $Banner->title = strip_tags($serverRequest->getParsedBody()['title']);
            if ($image['size'] !== 0) {
                $Banner->image = $image['name'];
            }

            $Banner->code = $serverRequest->getParsedBody()['code'];
            $Banner->url = filter_var($serverRequest->getParsedBody()['url'], FILTER_SANITIZE_URL);
            $Banner->type = $serverRequest->getParsedBody()['type'];
            $Banner->user_id = $serverRequest->getParsedBody()['user'];
            $Banner->status = $serverRequest->getParsedBody()['status'];

            if ($Banner->title != '' && $Banner->type != "" && $image != null) {
                if (isset($Banner->id) && $Banner->id != '') {
                    $local = "public/images/banners/" . $Banner->image;
                    if (file_exists($local) && $image['size'] != 0) {
                        unlink("public/images/banners/" . $Banner->image);
                        $this->uploadImages($image, "public/images/banners/");
                    }
                    if ($Banner->update()) {
                        $this->keep('success', "Aggiornamento effettuato con successo");
                    } else {
                        $this->keep('success', "Un errore ha impedito il salvataggio");
                    }
                } else {
                    $uploadResult = $this->uploadImages($image, "public/images/banners/");
                    if ($uploadResult === "OK") {
                        if ($Banner->save()) {
                            $this->keep('success', "Salvataggio effettuato con successo");
                        } else {
                            unlink("public/images/banners/" . $image['name']);
                            $this->keep('success', "Un errore ha impedito il salvataggio");
                        }
                    } else {
                        $this->keep('success', $uploadResult);
                    }
                }
            } else {
                $this->keep('success', "Dati mancanti completare e riprovare");
            }
            $this->router->switchAction('admin/banner');
        } else {
            $this->controlHeader->save = "#";
            $this->view->renderArgs('controlHeader', $this->controlHeader);
            $User = new User();
            $this->view->renderArgs("states", $this->states);
            $this->view->renderArgs("users", $User->findAll("WHERE role=?", 1));
            $this->view->render("/admin/banner/edit");
        }
    }

    public function read(ServerRequestInterface $serverRequest)
    {
        $banner = new Banner();
        $id = $serverRequest->getQueryParams() ? filter_var($serverRequest->getQueryParams()['id'], FILTER_SANITIZE_NUMBER_INT) : null;

        if ($id){

        }else{
            $this->controlHeader->new = $this->router->link('admin/banner/new');
            $this->controlHeader->delete = true;
            $this->view->renderArgs('controlHeader', $this->controlHeader);
            $this->view->renderArgs('banners', $banner->findAll());
            $this->view->render("/admin/banner/index");
        }
    }

    public function update(ServerRequestInterface $serverRequest)
    {
        $banner = new Banner();
        $id = filter_var($serverRequest->getQueryParams()['id'], FILTER_SANITIZE_NUMBER_INT);
        $this->view->renderArgs("banner", $banner->findById($id));
        $this->controlHeader->save = "#";
        $this->view->renderArgs('controlHeader', $this->controlHeader);
        $User = new User();
        $this->view->renderArgs("states", $this->states);
        $this->view->renderArgs("users", $User->findAll("where role=?", 1));
        $this->view->render("/admin/banner/edit");
    }

    public function delete(ServerRequestInterface $serverRequest)
    {
        $Banner = new Banner();
        $ids = $serverRequest->getParsedBody()['ids'];
        $deleted = 0;
        if ($ids !== null && is_array($ids) && count($ids) > 0) {
            foreach ($ids as $id) {
                $image = $Banner->findById($id)->image;
                unlink(Application::$ROOT . "/public/images/banners/$image");
                $Banner->delete($id);
                $deleted++;
            }
        }
        echo $deleted;
    }


    public function uploadBanner(ServerRequestInterface $serverRequest)

    {
        $image = ($_FILES['banner']);
        switch ($image['error']) {
            case UPLOAD_ERR_INI_SIZE:
                echo "Il file supera la dimensione massima accettaa dal server";
                break;

            case UPLOAD_ERR_NO_FILE:
                echo "Nessun file inviato";
                break;

            case UPLOAD_ERR_OK:
                //allowed file type Server side check
                switch ($image['type']) {
                    //allowed file types
                    case 'image/png':
                    case 'image/gif':
                    case 'image/jpeg':
                    case 'image/pjpeg':
                        break;
                    default:
                        die('Unsupported File!'); //output error

                }

                $upload = Application::$ROOT . "public/images/banners/" . $image['name'];
                if (file_exists($upload)) {
                    die("Un file con questo nome e gia presente sul server, cancellalo o rinomina il file da caricare");
                }
                if (move_uploaded_file($image['tmp_name'], $upload)) {
                    // do other stuff
                    die("Caricamento effettuato con successo");
                } else {
                    die("Caricamento fallito");
                }
        }
    }

    private function uploadImages($file, $folder)

    {
        $result = "";
        switch ($file['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $result = "Il file supera la dimensione massima accettata dal server";
                break;
            case UPLOAD_ERR_NO_FILE:
                $result = "Nessun file inviato";
                break;
            case UPLOAD_ERR_OK:

                //allowed file type Server side check
                switch ($file['type']) {

                    //allowed file types
                    case 'image/png':
                    case 'image/gif':
                    case 'image/jpeg':
                    case 'image/pjpeg':
                        break;

                    default:
                        $result = 'Unsupported File!';
                }

                $upload = Application::$ROOT . '/' . $folder . $file['name'];

                if (!file_exists($upload)) {
                    if (move_uploaded_file($file['tmp_name'], $upload)) {
                        $result = "OK";
                    } else {
                        $result = "Caricamento fallito";
                    }
                } else {
                    $result = "Un file con questo nome e gia presente sul server, cancellalo o rinomina il file da caricare";
                }
        }
        return $result;
    }



}