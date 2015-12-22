<?php namespace controllers;

use \core\view,
\helpers\session,
\helpers\url;

class Apply extends \core\controller {
    public function __construct(){
        $this->apply_model = new \models\Apply();
    }

    public function index(){
        \helpers\Session::init();
        if(\helpers\Session::get('username')){
            if(\helpers\Session::get('admin')){
                \helpers\url::redirect('exec');
            }else {
                \helpers\url::redirect('welcome');
            }
        }
        
        if ($_POST['submit']){

            $is_valid = \helpers\gump::is_valid($_POST, array(
                'fname' => 'required|alpha',
                'lname' => 'required|alpha',
                'dob' => 'required',
                'gender' => 'required',
                'year' => 'required',
                'email' => 'required|valid_email',
                'phone' => 'required',
                'stunum' => 'required|numeric',
                'issue1' => 'required',
                'issue2' => 'required',
                'issue3' => 'required',
            ));

            if($is_valid === true) {
                $this->submit();
            }

            else {
                $data['errors'] = $is_valid;
            }
        }
        
        $data['title'] = "Apply";
        $data['questions'] = $this->apply_model->getAllQuestions();
        $data['issues'] = $this->apply_model->getAllIssues();
        $data['options'] = $this->apply_model->getAllQuestionOptions();
        $data['colleges'] = $this->apply_model->getAllColleges();

        View::rendertemplate('header', $data);
        View::render('apply/apply', $data, $error);
        View::rendertemplate('footer', $data);

        
    }

    public function submit(){

        if(!isset($_POST['submit'])){
            \helpers\url::redirect('apply');
        }
        $inputData = array();
        foreach($_POST as $key => $input){
            if($key == "dob"){
                $dobArray = explode("/", $input);
                $inputData[$key] = $dobArray[2]."-".$dobArray[0]."-".$dobArray[1];
            }else {
                $inputData[$key] = $input;
            }
        }
        if($inputData['issue1'] == $inputData['issue2'] || $inputData['issue1'] == $inputData['issue3'] || $inputData['issue2'] == $inputData['issue3']){
            \helpers\url::redirect('apply?failure=issue');
        }
        if($this->apply_model->addApplication($inputData)){
            \helpers\url::redirect('apply?success');
        }else{
            \helpers\url::redirect('apply?failure=stunum');
        }
    }
}
