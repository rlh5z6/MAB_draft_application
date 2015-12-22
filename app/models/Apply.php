<?php namespace models;


class Apply extends \core\model {

    function __construct(){
        parent::__construct();
    }

    public function getAllQuestions(){
        return $this->_db->select('SELECT * FROM application_question');
    }

    public function getAllQuestionOptions(){
        return $this->_db->select("SELECT * FROM application_question_option");
    }

    public function addApplication($inputData){
        if($this->getAppByStuId($inputData['stunum'])->firstName){
            return 0;
        }
        $postdata = array(
            'firstName' => $inputData['fname'],
            'lastName' => $inputData['lname'],
            'hometown' => $inputData['hometown'],
            'dateOfBirth' => $inputData['dob'],
            'gender' => $inputData['gender'],
            'schoolYear' => $inputData['year'],
            'email' => $inputData['email'],
            'phone' => $inputData['phone'],
            'studentId' => $inputData['stunum'],
            'collegeId' => $inputData['college']
        );
        $this->_db->insert('application', $postdata);
        $additionalInput = array();
        $issueInput = array();
        foreach($inputData as $key => $input){
            if(is_int($key)){
                $additionalInput[$key] = $input;
            }else if(preg_match("/issue.*/", $key)){
                $issueInput[$key] = array();
                $issueInput[$key]['value'] = $input;
                $issueInput[$key]['rank'] = str_replace("issue", "", $key);
            }
        }
        $appId = $this->getAppByStuId($postdata['studentId'])->applicationId;
        $this->insertAdditionalQuestions($additionalInput, $appId);
        $this->insertApplicationIssues($issueInput, $appId);
        return 1;
    }

    public function insertApplicationIssues($inputData, $appId){
        foreach($inputData as $input){
            $postdata = array(
                'applicationId' => $appId,
                'rank' => $input['rank'],
                'issueId' => $input['value']
            );
            $this->_db->insert('application_issues', $postdata);
        }
    }

    public function insertAdditionalQuestions($inputData, $appId){
        foreach($inputData as $key => $input){
            $postdata = array(
                'applicationId' => $appId,
                'applicationQuestionId' => $key,
                'answer' => $input
            );
            $this->_db->insert('application_answer', $postdata);
        }
    }

    public function getAppByStuId($studentId){
        $results = $this->_db->select("SELECT * FROM application WHERE studentId = :stu", array(':stu' => $studentId));
        return $results[0];
    }

    public function getAllIssues(){
        return $this->_db->select("SELECT * FROM issue");
    }
    
    public function getAllColleges(){
        return $this->_db->select("SELECT * FROM colleges");
    }
}