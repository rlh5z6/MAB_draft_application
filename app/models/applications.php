<?php namespace models;

class Applications extends \core\model {

    public function get_all_applications($tripId){
        return $this->_db->select('SELECT a.*, w.rating, i1.issueName issue1, i2.issueName issue2, i3.issueName issue3, i1.issueId iid1, i2.issueId iid2, i3.issueId iid3
                                      FROM application a
                                      JOIN application_issues ai1 USING (applicationId)
                                      JOIN application_issues ai2 USING (applicationId)
                                      JOIN application_issues ai3 USING (applicationId)
                                      JOIN issue i1 ON ai1.issueId = i1.issueId
                                      JOIN issue i2 ON ai2.issueId = i2.issueId
                                      JOIN issue i3 ON ai3.issueId = i3.issueId
                                      LEFT JOIN (SELECT * FROM wishlist WHERE tripId = :tid) w USING (applicationId)
                                      WHERE ai1.rank = 1 AND ai2.rank = 2 AND ai3.rank = 3',
                                 array(':tid' => $tripId));
                                      
    }
    public function get_age_at_time($dob, $comparison){
        $dob = strtotime($dob);
        $comparison = strtotime($comparison);
        $age = date('Y', $comparison) - date('Y', $dob);
        $age = (date('md', $dob) > date('md', $comparison)) ? $age - 1 : $age;
        return $age;
    }

    public function application_questions() {
        $questions = $this->_db->select('SELECT * FROM application_question');
        return $questions;
    }
    
    public function get_application_by_issue($issueId, $rank) {
        
        return $this->_db->select('SELECT * FROM application_issues WHERE rank = :rank AND issueId = :issueId', array(':rank' => $rank, ':issueId' => $issueId));
    }
    
    public function add_to_wishlist($applicationId, $rating, $notes, $tripId) {
        
        $postdata = array (

			
            'applicationId' => $applicationId,
            'rating' => $rating,
            'notes' => $notes,
            'tripId' => $tripId
            
            
		);

		$this->_db->insert('wishlist', $postdata);
    
       
    }
    
    
    
    
    
}