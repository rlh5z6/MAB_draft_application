<?php namespace models;

class Board extends \core\model {
   
    public function get_board_of_directors() {
        $board_members = $this->_db->select('SELECT * FROM is_a_board_member bm
                                            JOIN person p USING (personId)');
       

        return $board_members;
    }
        
  
    
    
}