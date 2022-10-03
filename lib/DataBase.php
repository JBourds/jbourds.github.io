<?php // Lab 4 Version
class DataBase {

    const DB_DEBUG = false;

    public function __construct($dataBaseUser, $dataBaseName) {
        $this->pdo = null;

        include 'pass.php';

        $DataBasePassword = '';

        switch(substr($dataBaseUser, strpos($dataBaseUser, "_") + 1)) {
            case 'reader':
                $DataBasePassword = $dbReader;
                break;
            case 'writer';
                $DataBasePassword = $dbWriter;
                break;
        }

        $query = null;

        $dsn = 'mysql:host=webdb.uvm.edu;dbname=' . $dataBaseName;

        if (self::DB_DEBUG) {
            print '<p>' . $dataBaseUser . '</p>';
            print '<p>' . $DataBasePassword . '</p>';
            print '<p>' . $dsn . '</p>';
        }

        // Try to make the connection
        try {
            $this->pdo = new PDO($dsn, $dataBaseUser, $DataBasePassword);

            if(!$this->pdo) {
                if (self::DB_DEBUG) {
                    print PHP_EOL . '<!-- NOT Connected -->' . PHP_EOL;
                }
                $this->pdo = 0;
            } else {
                if (self::DB_DEBUG) {
                    print PHP_EOL . '<!-- Connected -->' . PHP_EOL;
                }
            }
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            if (self::DB_DEBUG) {
                print '<!-- Error Connecting : ' . $errorMessage . '-->' . PHP_EOL;
            }
        }

        return $this->pdo;
    }

    public function select($query, $values = '') {
        // Prepare SQL query for execution
        $statement = $this->pdo->prepare($query);

        if (is_array($values)) {
            $statement->execute($values);
        } else {
            $statement->execute();
        }

        $recordSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        return $recordSet;
    }

    public function insert($query, $values = '') {
        // Initialize the return code to null and change it depending on whether the insert is successful
        $returnCode = null;
        $statement = $this->pdo->prepare($query);

        if (is_array($values)) {
            $returnCode = $statement->execute($values);
        } else {
            $returnCode = $statement->execute();
        }

        $statement->closeCursor();

        return $returnCode;


    }

    public function displaySQL($sql, $values = '') {
        // Iterate through every value passed into the SQL statement and for each value find the associated ? character and replace it with the value
        // Only iterates if it is passed in an array of values- slightly changed from starter code
        if (is_array($values)) {
            foreach ($values as $value) {
                $pos = strpos($sql, '?');
                if ($pos !== false) {
                    $sql = substr_replace($sql, '"' . $value . '"', $pos, strlen('?'));
                }
            }
        }

        return '<p>SQL: ' . $sql . '</p>';
    }

    public function getLastID() {
        $lastID = $this->pdo->lastInsertID();
        return $lastID;
    }

}
