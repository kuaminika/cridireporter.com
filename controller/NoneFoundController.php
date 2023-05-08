<?php 


namespace crdireporter\controller;



class NoneFoundController extends AController
{
    public function index()
    {
        $result = "index";
      $this->response['status_code_header'] = 'HTTP/1.1 200 OK';
      $this->response['body'] = $result;
    }
}