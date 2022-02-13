<?php

/* 
 * Date          User            Desc
 * 2/11/21      cpalmer         Created page
 *  */

function addVisit($first_name, $email_address, $contact_reason, $contact_message) {
            $db = Database::getDB();
   $query = 'INSERT INTO contractor
	(first_name, email_address, contact_reason, contact_message, contact_date, contractor_id)
        VALUES (:name, :email, :subject, :message, NOW(), 1)';
       $statement = $db->prepare($query);
        $statement->bindValue(':name', $first_name);
        $statement->bindValue(':email', $email_address);
        $statement->bindValue(':subject', $contact_reason);
        $statement->bindValue(':message', $contact_message);
        $statement->execute();
        $statement->closeCursor();
}


function getVisitByCon($contractor_id) {
    $db = Database::getDB();
           $queryVisit = 'SELECT visit_id, visit.first_name, visit.email_address, visit_reason, '
                . 'visit.contact_id '
                . 'FROM visit '
                . 'JOIN contractor on visit.contractor_id = contractor.contractor_id '
                . 'WHERE contractor.contractor_id = :contractor_id '
                . 'ORDER BY visit_date ';

        $statement2 = $db->prepare($queryVisit);
        $statement2->bindValue(":contact_id", $contact_id);
        $statement2->execute();
        $visits = $statement2;
        return $visits;
}

function delVisit() {
    $queryDelete = 'DELETE FROM visit WHERE visit_id = :visit_id';
    $statement3->bindValue(":visit_id", $visit_id);
    $statement3->execute();
    $visits = $statement3;
    return $visits;
}
?>
