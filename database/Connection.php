<?php
/** 
 * Page that creates the connection with database in secure way using OOP
 * @version 1.0
 */
class Connection
{
    private $data = array();
    /** Connection Object */
    protected $pdo = null;
    // Function that sets object values
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
    // returns requested object and its contents
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        // Exception handling
        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE
        );
        return null;
    }
    /** return $pdo variable */
    public function getPdo()
    {
        return $this->pdo;
    }

    function __construct($pdo = null)
    {
        /** 
         * Method that constructs the class
         * @version 1.0
         */
        $this->pdo = $pdo;
        if ($this->pdo == null)
            $this->connect();
    }

    
    public function connect()
    {
        /** 
         * Method to connect to database
         * @version 1.0
         */

        // Trys to create a connection
        try {
            $config = parse_ini_file("config.ini");
            // Creates an instance of the class, sets its host, database, username and password that will be used to manage the data
            $this->pdo = new PDO(
                "mysql:host=" . $config['host'] . ";dbname=" . $config['dbname'],
                $config['user'],
                $config['pass']

            );
            // Catch expection and print them
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    public function disconnect()
    {
        /**
         * Method that disconnects from databse
         * @version 1.0
         */
        // Clears the object
        $this->pdo = null;
    }

    public function select($sql)
    {
        /**
         * Function that fetchs data from database
         * @version 1.0
         */
        // Prepares command to execute
        $stmt = $this->pdo->prepare($sql);
        // Execute
        $stmt->execute();
        // Return result
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function execute($sql)
    {
        /**
         * Function that executes sql that was sent in the entry parameter
         * @version 1.0
         * @param $sql SQL Command
         */
        // Puts PDO in exception mode
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Try to execute sql
        try {
            $this->pdo->exec($sql);
            // returns true if execution was successful
            return TRUE;
        } catch (PDOException $e) {
            // otherwise returns false
            return FALSE;
        }

    }
}
?>