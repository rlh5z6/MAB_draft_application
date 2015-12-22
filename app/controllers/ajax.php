<?php namespace controllers;

use \core\view,
    \helpers\session,
    \helpers\url;

class Ajax extends \core\controller{

    public function __construct(){
        $this->ajaxModel = new \models\Ajax();
    }

    public function applicantSearch(){
        if(Session::get('username')) {
            echo json_encode($this->ajaxModel->applicantSearch($_GET['searchTerm']));
        }else{
            echo json_encode(array());
        }
    }

    public function applicantAnswers(){
        if(Session::get('username')){
            echo json_encode($this->ajaxModel->applicantAnswers($_GET['applicationId']));
        }else{
            echo json_encode(array());
        }
    }

    public function checkTurn(){
        if(Session::get('username')){
            echo json_encode($this->ajaxModel->checkTurn());
        }else{
            echo json_encode(array());
        }
    }

    public function draft(){
        if(Session::get('username')){
            $turn = $this->ajaxModel->checkTurn();
            if($turn->tripId == $_GET['tripId']){
                echo json_encode($this->ajaxModel->draft($_GET['applicationId'], $_GET['tripId']));
            }else{
                echo json_encode(false);
            }
        }else{
            echo json_encode(false);
        }
    }

    public function updateTurn(){
        if(Session::get('username')){
            $turn = $this->ajaxModel->checkTurn();
            if($turn->tripId == $_GET['tripId']){
                echo json_encode($this->ajaxModel->updateTurn($_GET['tripId']));
            }else{
                echo json_encode(false);
            }
        }else{
            echo json_encode(false);
        }
    }

    public function getDrafted(){
        if(Session::get('username')){
            echo json_encode($this->ajaxModel->getDrafted());
        }else{
            echo json_encode(array());
        }
    }

    public function beginDraft(){
        if(Session::get('admin') && Session::get('username')){
            echo json_encode($this->ajaxModel->startDraft());
        }else{
            echo json_encode(false);
        }
    }

    public function finalizeDraft(){
        if(Session::get('admin') && Session::get('username')){
            echo json_encode($this->ajaxModel->finalizeDraft());
        }else{
            echo json_encode(false);
        }
    }

    public function getDraftOrder(){
        if(Session::get('username')){
            echo json_encode($this->ajaxModel->getDraftOrder());
        }else{
            echo json_encode(array());
        }
    }
}