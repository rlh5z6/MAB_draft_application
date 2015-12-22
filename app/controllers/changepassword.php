<?php namespace controllers;
use \core\view,
    \helpers\session,
    \helpers\url;


class changePassword extends \core\controller{
    public function __construct(){
        $this->password = new \models\Password();
        $this->cpmodel = new \models\ChangePassword();
    }

    public function index(){
        Session::init();
        if(!Session::get('username')){
            Url::redirect('');
        }

        $data['title'] = "Change Password";
        if(Session::get('admin')){
            View::rendertemplate('exec_header', $data);
        }else{
            View::rendertemplate('header', $data);
        }
        View::render('changepassword/changepassword', $data, $error);
        View::rendertemplate('footer', $data);
    }

    public function submit(){
        if(isset($_POST['submit'])){
            $authdata;
            if(Session::get('admin')){
                $authdata = $this->cpmodel->getAdminAuthByUsername(Session::get('username'));
            }else{
                $authdata = $this->cpmodel->getTripAuthByUsername(Session::get('username'));
            }
            $oldpass = $_POST['oldpass'];
            $newpass = $_POST['newpass'];
            $confirmpass = $_POST['confirmpass'];
            $oldpass = $this->password->get_hash($oldpass, $authdata->salt);
            $newpass = (strcmp($newpass, $confirmpass) == 0) ? $this->password->get_hash($newpass, $authdata->salt) : false;
            if($authdata->password != $oldpass && $authdata->pass != $oldpass){
                Url::redirect('changepassword?error=password');
            }
            if($newpass){
                if(Session::get('admin')) {
                    $this->cpmodel->updateAdminPassword($newpass, Session::get('username'));
                }else{
                    $this->cpmodel->updateTripPassword($newpass, Session::get('username'));
                }
                Url::redirect('changepassword?success');
            }else{
                Url::redirect('changepassword?error=matching');
            }
        }
    }
}
