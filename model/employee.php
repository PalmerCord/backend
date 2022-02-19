<?php

//class Employee {
//    
//    private $first_name
//}

class Contractor {

    private $first_name, $email_address, $contractor_id;

    public function __construct($first_name, $email_address, $contractor_id) {
        $this->first_name = $first_name;
        $this->email_address = $email_address; //last_name
        $this->contractor_id = $contractor_id;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getEmailAddress() {
        return $this->email_address;
    }
    
    public function getContractorID() {
        return $this->contractor_id;
    }

}

class ContractorDB {

    public static function getContractors() {
        $db = Database::getDB();
        
        
        $query = 'SELECT first_name, email_address, contractor_id FROM contractors '
                . ' ORDER BY first_name';
        // prepare, execute, fetchall, close cursor 
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $contractors = array();
        foreach ($rows as $row) {
            $contractorObject = new Contractor($row['first_name'],
                    $row['email_address'], $row['contractor_id']);
            $contractors[] = $contractorObject;
        }
        return $contractors;
    }

    public static function getCon() {
        $db = Database::getDB();
        $queryContractor = 'SELECT * FROM contractor';
        $statement1 = $db->prepare($queryContractor);
        $statement1->execute();
        $contractors = $statement1;
        return $contractors;
    }

}
?>

