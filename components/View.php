<?php

class View
{
    private $content;

    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    function generate($templateView, $mainView)
    {
        if (!$mainView) {
            echo 'Установите вид'; die;
        }

        $this->content = $this->getRenderHTML('views/' . $mainView);
        if (!$templateView) {
            echo 'Установите шаблон'; die;
        }

        include 'views/layouts/' . $templateView;
    }

    public function getRenderHTML($path) {
        ob_start(); //включаем буферизацию вывода
        include($path); //подключили вьюшку index.php из папки news
        $var = ob_get_contents(); //получаем содержимое буфера без очистки
        ob_end_clean(); //очищаем буфер и отключаем буферизацию
        return $var;
    }
}