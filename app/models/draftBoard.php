<?php namespace models;

class draftBoard extends \core\model {
    public function getDraftOrder(){
        return $this->_db->select("
            SELECT * FROM draft_order do
            JOIN trip t USING (tripId)
            ORDER BY draftPosition ASC
        ");
    }
}