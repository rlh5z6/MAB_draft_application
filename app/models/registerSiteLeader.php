<?php namespace models;

class RegisterSiteLeader extends \core\model {
   
    function __construct(){
        parent::__construct();
    }
    
    
    public function insert_person($first_name, $last_name, $gender, $email, $phone_number, $birthday, $hometown, $schoolYear) {  
    if ($this->find_by_email($email) == NULL) { 
        
        $postdata = array (

            'firstName' => $first_name,
            'lastName' => $last_name,
            'gender' => $gender,
            'email' => $email,
            'phone' => $phone_number,
            'dateOfBirth' => $birthday,
            'hometown' => $hometown,
            'schoolYear' => $schoolYear,
            'personId' => 'DEFAULT'

        );

        $this->_db->insert('person', $postdata);
        $personId = $this->find_by_email($email);
        return $personId;
    }
    else {
        return 0;   
    }
	}
    
    public function find_by_email($email) {
        $personId = $this->_db->select('SELECT personId FROM person WHERE email = :email', array(':email' => $email));
        return $personId[0]->personId;
        
        
    }
    
    public function insert_is_a_site_leader($personId, $seasonId) {  
        
    $postdata = array ( 
        'seasonId' => $seasonId,
        'personId' => $personId

    );

    $this->_db->insert('is_a_site_leader', $postdata);

	}


    
}