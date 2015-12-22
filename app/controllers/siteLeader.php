<?php namespace controllers;

use \core\view,
\helpers\session,
\helpers\url;

class SiteLeader extends \core\controller {

    
    public function __construct() {
        $this->mab = new \models\siteLeader();
    }

    public function create(){

        Session::init();
        if(Session::get('username')){
            if(!Session::get('admin')){
                Url::redirect('welcome');
            }
        }else{
            Url::redirect('');
        }

        $data['title'] = 'Site Leaders';

        $data['site_leaders'] = $this->mab->get_site_leaders();
        
        
        View::rendertemplate('exec_header', $data);
        View::render('siteLeader/siteLeader', $data, $error);
        View::rendertemplate('footer', $data);
    }

}