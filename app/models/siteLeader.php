<?php namespace models;

class SiteLeader extends \core\model {
   
   public function get_site_leaders() {
        $site_leaders = $this->_db->select('SELECT * FROM is_a_site_leader sl 
                                            JOIN person p USING (personId)
                                            JOIN trip t USING (tripId)');

        return $site_leaders;
    }
        
  
    
}