<?php namespace controllers;

use \core\view,
    \helpers\session,
    \helpers\url;

    class Application_Analytics extends \core\controller {


    public function __construct() {
        $this->mab = new \models\analytics();
        $this->apply_model = new \models\apply();
    }
    
    public function create() {
        
        Session::init();
        if(Session::get('username')){
            if(!Session::get('admin')){
                Url::redirect('welcome');
            }
        }else{
            Url::redirect('');
        }

        $data['title'] = 'Application Analytics';
        
        
        $data['gender'] = $this->mab->get_gender();
        $data['yearsInSchool'] = $this->mab->get_years_in_school();
        $data['apps'] = $this->mab->get_apps_by_issue();
        
        $data['apps1'] = $this->mab->get_apps_by_issue_rank(1);
        $data['apps2'] = $this->mab->get_apps_by_issue_rank(2);
        $data['apps3'] = $this->mab->get_apps_by_issue_rank(3);
        
        
        
        $data['apps_by_college'] = $this->mab->get_apps_by_college();
        $data['marketing_data'] = $this->mab->get_marketing_data();
        $data['issues'] = $this->apply_model->getAllIssues();
        
        
        if (isset($_POST['submit'])) {
            $issueId = $_POST['issues'];
            $data['issues_by_gender'] = $this->mab->get_issues_by_gender($issueId);
            
        }
            
            
        
        
        
        View::rendertemplate('exec_header', $data);
        View::render('analytics/application_analytics', $data, $error);
        View::rendertemplate('footer', $data);
    }
}
?>