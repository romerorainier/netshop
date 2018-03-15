<?php

class App
{
    protected $controller = 'home';

    protected $method = 'index';

    protected $params = [];


    public function __construct()
    {
        $url = $this->parseUrl();

        if (file_exists('app/controllers/'. $url[0] .'.php')) {
          $this->controller = $url[0];
          unset($url[0]);
    }
      require_once 'app/controllers/'. $this->controller .'.php';
      $this->controller = new $this->controller;

      if (isset($url[1])) {
        if (method_exists($this->controller,$url[1])) {
           $this->method = $url[1];
           unset($url[1]);
        }
      }

      $this->params = $url ? array_values($url) : [];

      call_user_func_array([$this->controller,$this->method],$this->params);
    }

    public function parseUrl()
    {

     if ($_SERVER['REQUEST_METHOD'] === 'POST') {

           $url = explode('/',filter_var(rtrim($_SERVER['REQUEST_URI'],'/'),FILTER_SANITIZE_URL));
           $url = array_values(array_filter($url,"strlen"));
           return $url = array_merge($url,$_POST);

        }

    elseif ($_SERVER['REQUEST_METHOD'] === 'GET'){

          if (isset($_GET['url'])) {
               return $url = explode('/',filter_var(rtrim($_GET['url'],'/'),FILTER_SANITIZE_URL));
          }
        }
    }

}

 ?>
