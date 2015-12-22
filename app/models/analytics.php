<?php namespace models;


class Analytics extends \core\model {

    function __construct(){
        parent::__construct();
    }

    public function num_of_trips() {
        
        $trips = $this->_db->select('SELECT i.issueName, COUNT(*) num_of_trips FROM trip t JOIN issue i USING (issueId) GROUP BY i.issueId');
        
        return $trips;
        
    }
    
   
        

    public function get_gender() {
        $genders = $this->_db->select('SELECT gender, COUNT(*) num_of_applicants FROM application GROUP BY gender');
        return $genders;
        
    }
    
    public function get_years_in_school() {
        $schoolYears = $this->_db->select('SELECT schoolYear, COUNT(*) num_of_applicants FROM application GROUP BY schoolYear');
        return $schoolYears;
        
    }
        
        
    public function get_states() {
        $trips = $this->_db->select('SELECT l.region, COUNT(*) num_of_trips FROM location l JOIN trip t USING (locationId) GROUP BY l.region');
        return $trips;
        
    }
    
    
    public function get_apps_by_issue() {
        $apps = $this->_db->select('SELECT i.issueName, COUNT(*) num_of_applications FROM application_issues ai JOIN issue i USING (issueId) GROUP BY issueId');
        return $apps;
        
    }
    
    public function get_apps_by_issue_rank($rank) {
        $apps = $this->_db->select('SELECT i.issueName, COUNT(*) num_of_applications FROM application_issues ai JOIN issue i USING (issueId) WHERE ai.rank = :rank GROUP BY issueId', array(':rank' => $rank));
        return $apps;
        
    }

    public function get_gender_by_trip($tripId) {
        $apps = $this->_db->select('
        SELECT p.gender, COUNT(*) num_of_members 
        FROM person p 
        LEFT JOIN is_a_trip_member tm USING (personId)
        LEFT JOIN is_a_site_leader sl USING (personId)
        WHERE tm.tripId = :tripId 
        OR sl.tripId = :tripId
        GROUP BY p.gender
        ', array(':tripId' => $tripId));
        return $apps;
        
    }
    
    public function get_school_year_by_trip($tripId) {
        $apps = $this->_db->select('SELECT p.schoolYear, COUNT(*) num_of_members FROM person p LEFT JOIN is_a_trip_member tm USING (personId) LEFT JOIN is_a_site_leader sl USING (personId) WHERE tm.tripId = :tripId OR sl.tripId = :tripId GROUP BY p.schoolYear', array(':tripId' => $tripId));
        return $apps;
    }
    
    public function get_apps_by_college() {
        $apps = $this->_db->select('SELECT c.collegeName, COUNT(*) num_of_applications FROM application a JOIN colleges c USING (collegeId) GROUP BY a.collegeId');
        return $apps;
        
    }
    
    public function get_issues_by_gender($issueId) {
        $apps = $this->_db->select('SELECT a.gender, i.issueName, COUNT(*) num_of_applications FROM application_issues ai JOIN issue i USING (issueId) JOIN application a USING (applicationId) WHERE i.issueId = :issueId GROUP BY issueName, gender', array(':issueId' => $issueId));    
        return $apps;
    }
    
    public function get_marketing_data() {
        $apps = $this->_db->select('SELECT aa.answer, COUNT(*) num_of_applications FROM application_answer aa WHERE aa.applicationQuestionId = 7 GROUP BY aa.answer');
        return $apps;
        
    }
    
}
?>