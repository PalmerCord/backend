<?php

/*
 * Date          User            Desc
 * 2/11/21      cpalmer         Created page
 *  */


function addVisit($name, $email, $subject, $message) {
    $db = Database::getDB();
    $query = 'INSERT INTO visit
	(first_name, email_address, contact_reason, contact_message,
        contact_date, contractor_id)
        VALUES (:name, :email, :subject, :message, NOW(), 1)';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':subject', $subject);
    $statement->bindValue(':message', $message);
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
    $statement2->bindValue(":contractor_id", $contractor_id);
    $statement2->execute();
    $visits = $statement2;
    return $visits;
}

function delVisit($visit_id) {
    $db = Database::getDB();
    $queryDelete = 'DELETE FROM visit WHERE visit_id = :visit_id';
    $statement3 = $db->prepare($queryDelete);
    $statement3->bindValue(":visit_id", $visit_id);
    $statement3->execute();
    $statement3->closeCursor();
}

?>
