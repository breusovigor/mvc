<?php
include_once ROOT . '/controllers/Controller.php';


class IndexController extends Controller

{

    public function __construct()
    {
        parent::__construct();
    }

    public function actionIndex($parameters = NULL)
    {

        try {
            $this->view->main = 'ДОБРО ПОЖАЛОВАТЬ НА НАШ САЙТ';
            $this->view->generate('template_view.php', 'index.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return true;
    }
}