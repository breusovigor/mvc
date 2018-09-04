<?php
include_once ROOT . '/models/Model_News.php';
include_once ROOT . '/controllers/Controller.php';


class NewsController extends Controller

{
    private $newsModel;

    public function __construct()
    {
        parent::__construct();
        $this->newsModel = new Model_News();
    }

    public function actionIndex($category = NULL)
    {

        try {
            $this->view->blogNews = $this->newsModel->getNewsList();
            $this->view->categoryName = $this->newsModel->getCategoryName();
            //$this->view->nuberOfViews = $this->newsModel->updateNuberOfViews();
            $this->view->generate('template_view.phtml', 'blog.phtml');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return true;
    }

    public function actionDetail()
    {
        try {
            //$this->view->nuberOfViews = $this->newsModel->updateNuberOfViews();
            $this->view->generate('template_view.phtml', 'blog-post.phtml');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return true;
    }
}