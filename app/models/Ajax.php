<?php namespace models;


class Ajax extends \core\model{

    public function applicantSearch($searchTerm){
        $results = $this->_db->select("
            SELECT a.applicationId, a.hometown, a.dateOfBirth, a.gender, i1.issueName issue1, i2.issueName issue2, i3.issueName issue3
            FROM application a
            JOIN application_issues ai1 USING (applicationId)
            JOIN application_issues ai2 USING (applicationId)
            JOIN application_issues ai3 USING (applicationId)
            JOIN issue i1 ON ai1.issueId = i1.issueId
            JOIN issue i2 ON ai2.issueId = i2.issueId
            JOIN issue i3 ON ai3.issueId = i3.issueId
            WHERE ai1.rank = 1 AND ai2.rank = 2 AND ai3.rank = 3
            AND NOT (
                LOWER(i1.issueName) NOT LIKE :searchTerm
                AND LOWER(i2.issueName) NOT LIKE :searchTerm
                AND LOWER(i3.issueName) NOT LIKE :searchTerm
                AND LOWER(a.applicationId) NOT LIKE :searchTerm
                AND LOWER(a.hometown) NOT LIKE :searchTerm
                AND LOWER(a.gender) NOT LIKE :searchTerm
            )
        ", array(':searchTerm' => '%'.strtolower($searchTerm).'%'));

        foreach($results as $result){
            $result->age = \models\wishlist::get_age_at_time($result->dateOfBirth, date('Y-m-d', time()));
        }
        return $results;
    }

    public function applicantAnswers($applicationId){
        return $this->_db->select("
            SELECT * FROM application_answer aa
            JOIN application_question aq USING (applicationQuestionId)
            WHERE applicationId = :aid
        ", array(':aid' => $applicationId));
    }

    public function checkTurn(){
        return $this->_db->select("
            SELECT * FROM draft_order WHERE turn = 1
        ")[0];
    }

    public function draft($appId, $tripId){
        if($this->_db->select("SELECT * FROM draft WHERE applicationId = :appid", array(':appid' => $appId)) || $this->_db->select("SELECT COUNT(*) count FROM draft WHERE tripId = :tid", array(':tid' =>$tripId))[0]->count >= 10){
            return false;
        } else{
            $max = $this->_db->select("SELECT MAX(draftedOrder) max FROM draft WHERE tripId = :tid", array(':tid' => $tripId))[0]->max;
            if(!$max){
                $max = 0;
            }
            $postdata = array(
                'applicationId' => $appId,
                'tripId' => $tripId,
                'draftedOrder' => $max + 1
            );
            $this->_db->insert('draft', $postdata);
            return true;
        }
    }

    public function updateTurn($tripId){
        $this->_db->update('draft_order', array('turn' => 0), array('tripId' => $tripId));
        $trip = $this->_db->select("SELECT * FROM draft_order WHERE tripId = :tid", array(':tid' => $tripId))[0];
        $max = $this->_db->select("SELECT MAX(draftPosition) max FROM draft_order")[0]->max;
        $this->_db->update('draft_order', array('turn' => 1), array('draftPosition' => (($trip->draftPosition % $max) + 1)));
        return true;
    }

    public function getDrafted(){
        return $this->_db->select("SELECT * FROM draft");
    }

    public function startDraft(){
        $trips = $this->_db->select('SELECT * FROM trip');
        shuffle($trips);
        $postdata = array(
            'tripId' => NULL,
            'draftPosition' => NULL,
            'turn' => 0
        );
        $this->_db->truncate('draft_order');
        $index = 1;
        foreach($trips as  $trip){
            $postdata['tripId'] = $trip->tripId;
            $postdata['draftPosition'] = $index;
            $this->_db->insert('draft_order', $postdata);
            $index++;
        }
        $this->_db->update('draft_order', array('turn' => 1), array('draftPosition' => 1));
        return true;
    }

    public function finalizeDraft(){
        $draftDone = $this->_db->select("SELECT COUNT(*) count FROM draft GROUP BY tripId");
        $check = true;
        foreach($draftDone as $draftCount){
            if($draftCount->count != 10){
                $check = false;
            }
        }
        if($check){
            $draft = $this->_db->select("SELECT * FROM draft JOIN application USING (applicationId)");
            $postdata = array(
                'firstName' => NULL,
                'lastName' => NULL,
                'dateOfBirth' => NULL,
                'gender' => NULL,
                'phone' => NULL,
                'hometown' => NULL,
                'schoolYear' => NULL,
                'email' => NULL
            );
            $memberdata = array(
                'personId' => NULL,
                'tripId' => NULL,
                'applicationId' => NULL
            );
            foreach($draft as $draftEntry){
                $postdata['firstName'] = $draftEntry->firstName;
                $postdata['lastName'] = $draftEntry->lastName;
                $postdata['dateOfBirth'] = $draftEntry->dateOfBirth;
                $postdata['gender'] = $draftEntry->gender;
                $postdata['phone'] = $draftEntry->phone;
                $postdata['hometown'] = $draftEntry->hometown;
                $postdata['schoolYear'] = $draftEntry->schoolYear;
                $postdata['email'] = $draftEntry->email;
                $this->_db->insert('person', $postdata);
                $person = $this->_db->select('SELECT * FROM person WHERE email = :email', array(':email' => $postdata['email']))[0];
                $memberdata['personId'] = $person->personId;
                $memberdata['tripId'] = $draftEntry->tripId;
                $memberdata['applicationId'] = $draftEntry->applicationId;
                $this->_db->insert('is_a_trip_member', $memberdata);
            }
            return true;
        }else {
            return false;
        }
    }
    public function getDraftOrder(){
        return $this->_db->select("
            SELECT do.*, t.nickname
            FROM draft_order do
            JOIN trip t USING (tripId)
            ORDER BY do.draftPosition ASC");
    }
}