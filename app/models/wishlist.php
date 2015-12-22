<?php namespace models;

class Wishlist extends \core\model {

    function __construct(){
        parent::__construct();
        
        
    }

    public function get_wishlist($tripId) {
    $applicants = $this->_db->select('SELECT * FROM wishlist WHERE tripId = :tripId ORDER BY rating DESC', array(':tripId' => $tripId));
    
    foreach($applicants as $applicants_info) {
        
        $person_info = $this->get_application_info($applicants_info->applicationId);
        $applicants_info->applicationId = $person_info[0]->applicationId;
        $applicants_info->gender = $person_info[0]->gender;
        $applicants_info->dateOfBirth = $person_info[0]->dateOfBirth;
        $verify_app = $this->verify_applicant($applicants_info->applicationId);
        
        
        $applicants_info->tripId = $verify_app;
        
        
        if ($verify_app == NULL) {
            $applicants_info->color = '#FBFAFA';
        }
        
        else if ($verify_app == $tripId) {
            $applicants_info->color = '#A0BF8F';
        }
        
        else {
            $applicants_info->color = '#F37C69'; 
        }
        
    }
        
        
    return $applicants;
    }
        
    public function get_application_info($applicationId) {
        $applicants_info = $this->_db->select('SELECT * FROM application WHERE applicationId = :applicationId', array(':applicationId' => $applicationId));
       return $applicants_info;
    }
    
   
  
    public function get_age_at_time($dob, $comparison){
        $dob = strtotime($dob);
        $comparison = strtotime($comparison);
        $age = date('Y', $comparison) - date('Y', $dob);
        $age = (date('md', $dob) > date('md', $comparison)) ? $age - 1 : $age;
        return $age;
    }
    
    
    public function add_to_trip($applicationId, $tripId) {
    
        //Fix autoincrement for draftedOrder
		$postdata = array (

			'applicationId' => $applicationId,
			'tripId' => $tripId
            
		);

		$this->_db->insert('draft', $postdata);
        

	}

    
    public function applicant_becomes_person($applicationId) {
        $person_info = $this->get_application_info($applicationId);
        $postdata = array (

            'firstName' => $person_info[0]->firstName,
            'lastName' => $person_info[0]->lastName,
            'dateOfBirth' => $person_info[0]->dateOfBirth,
            'gender' => $person_info[0]->gender,
            'email' => $person_info[0]->email,    
            'phone' => $person_info[0]->phone,
            'hometown' => $person_info[0]->hometown,
            'schoolYear' => $person_info[0]->schoolYear

        );  
        $this->_db->insert('person', $postdata);

    }
    
    public function find_by_email($email) {
        $personId = $this->_db->select('SELECT personId FROM person WHERE email = :email', array(':email' => $email));
        return $personId[0]->personId;
    }
    
    public function person_becomes_trip_member($applicationId, $tripId) {
        $person_info = $this->get_application_info($applicationId);
        $email = $person_info[0]->email;
        $personId = $this->find_by_email($email);
        
        
        
        
        $postdata = array (

            'personId' => $personId,
			'applicationId' => $applicationId,
			'tripId' => $tripId
            
		);
        $this->_db->insert('is_a_trip_member', $postdata);
    }
        
        

        
    public function get_official_roster($tripId) {
        $roster = $this->_db->select('SELECT applicationId FROM draft WHERE tripId = :tripId', array(':tripId' => $tripId));
        return $roster;
        
    }
    
    
    public function verify_applicant($applicationId) {
        $trip_id = $this->_db->select('SELECT tripId FROM draft WHERE applicationId = :applicationId', array(':applicationId' => $applicationId));
        return $trip_id[0]->tripId;
        
        
    }
    
   
    
    
    
}


