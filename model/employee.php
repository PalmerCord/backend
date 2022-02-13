<?php





//class Employee {
//    
//    private $first_name
//}

class Contractor {
    private $first_name, $last_name;
    public function __construct($first_name, $last_name) {
        $this->first_name = $first_name;
        $this->last_name = $last_name; //last_name
    }
    public function getFirstName() {
        return $this->first_name;
        
    }
    public function getLastName() {
        return $this->last_name;
    }
}
class ContractorDB{
    public static function getContractors() {
        $db = Database::getDB();
        $query = 'SELECT first_name, last_name FROM contractors '
                . ' ORDER BY last_name';
        // prepare, execute, fetchall, close cursor 
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        
        $contractors = array();
        foreach ($rows as $row) {
            $contractorObject = new Contractor($row['first_name'], 
                    $row['last_name']);
            $contractors[] = $contractorObject;
        }
        return $contractors;
    }
}

?>

