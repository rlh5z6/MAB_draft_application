<?php namespace models;

class Trip extends \core\model {
   

    
   function __construct(){
		parent::__construct();
	}
    
    
    
    public function get_trip_information($trip_id){
        $trip_details = $this->_db->select('SELECT * FROM trip WHERE tripId = :trip_id', array(':trip_id' => $trip_id));
        $trip_details[0]->housing_information = $this->get_housing_information($trip_details[0]->housingId);
        $trip_details[0]->housing_contact= $this->get_housing_contact($trip_details[0]->housingId);
        $trip_details[0]->service_sites = $this->get_all_service_information($trip_id);

        return $trip_details[0];

    }
    
    public function get_housing_information($housing_id) {
        $housing_details = $this->_db->select('SELECT * FROM housing WHERE housingId = :housing_id', array(':housing_id' => $housing_id));
        return $housing_details[0];
    }

    public function get_housing_contact($housing_id) {
        $housing_details = $this->_db->select('SELECT * FROM housing_contact WHERE housingId = :housing_id', array(':housing_id' => $housing_id));
        return $housing_details[0];
    }

    public function get_all_service_information($trip_id) {
        $service_details = array();
        $ids = $this->get_service_ids($trip_id);
        foreach($ids as $site_id){
            $temp_details = $this->get_service_information($site_id);
            $temp_details->contact = $this->get_service_contact($site_id);
            $service_details[] = $temp_details;
        }
        return $service_details;
    }
    
    public function get_trip_sites($trip_id) {
        $trip_sites_details = $this->_db->select('SELECT ts.tripId, ts.serviceSiteId, ss.siteName FROM trip_sites ts JOIN service_site ss USING (serviceSiteId) WHERE tripId = :trip_id', array(':trip_id' => $trip_id));
        return $trip_sites_details;
    }

    public function get_service_information($site_id){
        $site_info = $this->_db->select('SELECT * FROM service_site WHERE serviceSiteId = :service_id', array(':service_id' => $site_id));
        return $site_info[0];
    }

    public function get_service_contact($service_id) {
        $service_details = $this->_db->select('SELECT * FROM service_site_contact WHERE serviceSiteId = :service_id', array(':service_id' => $service_id));
        return $service_details[0];
    }

    public function get_service_ids($trip_id){
        $trip_sites = $this->_db->select('SELECT * FROM trip_sites WHERE tripId = :trip_id', array(':trip_id' => $trip_id));
        $ids = array();
        foreach($trip_sites as $trip_site){
            $ids[] = $trip_site->serviceSiteId;
        }
        return $ids;
    }
    
    
    public function site_leader_information() {
        $tripId = \helpers\Session::get("tripId");
        $roster = $this->get_site_leader_roster($tripId);
        
        foreach ($roster as $site_leader) {
            $site_leader_info = $this->get_application_information($site_leader->personId);
            $site_leader->firstName = $site_leader_info[0]->firstName;
            $site_leader->lastName = $site_leader_info[0]->lastName;
            $site_leader->email = $site_leader_info[0]->email;
            $site_leader->phone = $site_leader_info[0]->phone;
            $site_leader->gender = $site_leader_info[0]->gender;
            $site_leader->hometown = $site_leader_info[0]->hometown;
            $site_leader->age = $this->get_age_at_time($site_leader_info[0]->dateOfBirth, date('Y-m-d', time()));
            $site_leader->schoolYear = $site_leader_info[0]->schoolYear;
        }
    
        return $roster;
    }
    
    public function participant_information() {
        $tripId = \helpers\Session::get("tripId");
        $roster = $this->get_participant_roster($tripId);
        
        foreach ($roster as $participant) {
            $participant_info = $this->get_application_information($participant->personId);
            $participant->firstName = $participant_info[0]->firstName;
            $participant->lastName = $participant_info[0]->lastName;
            $participant->email = $participant_info[0]->email;
            $participant->phone = $participant_info[0]->phone;
            $participant->gender = $participant_info[0]->gender;
            $participant->hometown = $participant_info[0]->hometown;
            $participant->age = $this->get_age_at_time($participant_info[0]->dateOfBirth, date('Y-m-d', time()));
            $participant->schoolYear = $participant_info[0]->schoolYear;
        }
    
        return $roster;
    }
    
    public function get_participant_roster($tripId) {
        
        $roster = $this->_db->select('SELECT * FROM is_a_trip_member WHERE tripId = :tripId', array(':tripId' => $tripId));
        return $roster;
        
    }
    
    public function get_site_leader_roster($tripId) {
        
        $roster = $this->_db->select('SELECT * FROM is_a_site_leader WHERE tripId = :tripId', array(':tripId' => $tripId));
        return $roster;
        
    }
    
    public function get_application_information($personId) {
        return $this->_db->select('SELECT * FROM person WHERE personId = :personId', array(':personId' => $personId));
    }
    
    public function get_age_at_time($dob, $comparison){
        $dob = strtotime($dob);
        $comparison = strtotime($comparison);
        $age = date('Y', $comparison) - date('Y', $dob);
        $age = (date('md', $dob) > date('md', $comparison)) ? $age - 1 : $age;
        return $age;
    }
    
    public function find_locationId($tripId) {
        $location = $this->_db->select('SELECT locationId FROM trip WHERE tripId = :tripId', array(':tripId' => $tripId));   
        return $location[0]->locationId;
    }
    
    public function location_info($tripId) {
        $locationId = $this->find_locationId($tripId);
        $location = $this->_db->select('SELECT * FROM location WHERE locationId = :locationId', array(':locationId' => $locationId));   
        return $location;
    
    }
    
    
    public function insert_housing($tripId, $name, $address, $city, $state, $zip) {
        
        $locationId = $this->find_locationId($tripId);
        
        $postdata = array (

			'name' => $name,
            'locationId' => $locationId,
            'address' => $address,
            'city' => $city,
            'region' => $state,
            'zip' => $zip
            
            
		);

		$this->_db->insert('housing', $postdata);
	}
    
    public function find_housingId($tripId, $name) {
        $locationId = $this->find_locationId($tripId);
        $housing = $this->_db->select('SELECT housingId FROM housing WHERE locationId = :locationId AND name = :name', array(':locationId' => $locationId, ':name' => $name));   
        return $housing[0]->housingId;
    }
    
        
    public function insert_housing_contact($housingId, $contactName, $email, $phone) {
    
        $postdata = array (

			'housingId' => $housingId,
            'contactName' => $contactName,
            'email' => $email,
            'phoneNumber' => $phone
            
            
		);

		$this->_db->insert('housing_contact', $postdata);
       
        
    }
    
    public function update_housingId($tripId, $housingId) {
    
        
        $postdata = array (

            'housingId' => $housingId
        );
			
			$this->_db->update('trip', $postdata, array('tripId' => $tripId));
    }
    
    public function insert_service($tripId, $name, $address, $website, $city, $state, $zip) {
        
        $locationId = $this->find_locationId($tripId);
        
        $postdata = array (

			'siteName' => $name,
            'locationId' => $locationId,
            'address' => $address,
            'orgWebSite' => $website,
            'city' => $city,
            'region' => $state,
            'zip' => $zip
            
            
		);

		$this->_db->insert('service_site', $postdata);
	}
        
    public function find_serviceSiteId($tripId, $siteName) {
        $locationId = $this->find_locationId($tripId);
        $service = $this->_db->select('SELECT serviceSiteId FROM service_site WHERE locationId = :locationId AND siteName = :siteName', array(':locationId' => $locationId, ':siteName' => $siteName));   
        
        return $service[0]->serviceSiteId;
    }

    public function update_trip_sites($tripId, $serviceSiteId) {
    
        
        $postdata = array (

            'serviceSiteId' => $serviceSiteId,
            'tripId' => $tripId
        );
			
			$this->_db->insert('trip_sites', $postdata);
    }
        
    public function insert_service_contact($serviceSiteId, $contactName, $email, $phone) {
    
        $postdata = array (

			'serviceSiteId' => $serviceSiteId,
            'contactName' => $contactName,
            'email' => $email,
            'phoneNumber' => $phone
            
            
		);

		$this->_db->insert('service_site_contact', $postdata);
       
        
    }
    
    public function delete_housing($housingId) {
    
        

		$this->_db->delete('housing', array('housingId' => $housingId));
       
        
    }
    
    public function delete_service_site($serviceSiteId) {
    
        

		$this->_db->delete('service_site', array('serviceSiteId' => $serviceSiteId));
       
        
    }
    
    
    
    
    
}
