<?php
/** 
 * Pages that authenticates 
 * @version 1.0
 */
require_once('Connection.php');

// Class derives from db connections
class Authenticate extends Connection
{
	private $data = array();
	// constructor
	public function __construct()
	{
		$this->error = '';
	}
	// Set values for object
	public function __set($name, $value)
	{
		$this->data[$name] = $value;
	}
	// return requested object and its contents
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

	public function IsEmpty(array $data_array)
	{
		/**
		 * Function tests whether a given array is empty or contains some empty string, used to help verify form inputs
		 * returns true if some element in array is empty/null
		 * @version 1.0
		 * @param $data_array Array containing all required data
		 */
		return in_array("", $data_array);
	}

	public function isValidNick(string $nick)
	{
		/**
		 * function tests whether a given string contains any invalid character, used to help verify usernames 
		 * returns true if it's a valid username
		 * @version 1.0
		 * @param $nick Nickname to be validated
		 */
		// 
		return !preg_match('/[^A-Za-z0-9]/', $nick) && strlen($nick) > 1 && strlen($nick) < 21;
	}

	public function isValidEmail(string $email){
		/**
		 * function tests whether a given string is a valid email address
		 * returns true if it's a valid email
		 * @version 1.0
		 * @param $email Email to be validated
		 */
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	 
	
	public function isValidDate(string $date)
	{
		/**
		 * function tests wheter a given date is valid, 
		 * @version 1.0
		 * @param $date string containing the date, should be in format YYYY-MM-DD
		 */
		// set array with day, month and year by exploding string into array 
		$birth_array = explode('-', $date);
		// tests if array is set, countable and has only 3 elements
		if (isset($birth_array) && count($birth_array) === 3) {
			// set variables
			$day = $birth_array[2];
			$month = $birth_array[1];
			$year = $birth_array[0];
			// check for valid date
			if (checkdate($month, $day, $year)) {
				// valid
				return TRUE;
			} else {
				// invalid date
				return FALSE;
			}
		} else {
			// array not set or invalid
			return FALSE;
		}
	}

	public function isDuplicateOrInvalidEmail(string $email)
	{
		/**
		 * function tests whether a given email is already in use or invalid
		 * @version 1.0
		 * @param $email Email to be validated
		 */
		if (!$this->isValidEmail($email)) {
			return true;
		}
		$this->type = 'CheckEmail';
		$this->param = array($email);
		$result = $this->Fetch();

		if (isset($result) && !empty($result)) {
			return true;
		}
		return false;
	}
	
	public function Insert()
	{
		/**
		 * function Insert data in database based on Type parameter
		 * @version 1.6
		 * @param $this->type String containing type of insert
		 * @param $this->param Array containing all data required for INSERT
		 */
		try {
			// Creates new connection
			$db_handle = new Connection();
			// Set PDO to exception mode
			$db_handle->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// get insert type
			switch ($this->type) {
				case 'MarkentingEmail':
					$insert = "INSERT INTO newsletter(Email) VALUES(?);";
					break;
				
				case 'PostComment':
					$insert = "INSERT INTO lib_comment(lib_user_ID, book_ID, contents) VALUES (?, ?, ?)";
					break;

				case 'InsertOrder':
					$insert = "INSERT INTO sales (OrderID, ClientID, ItemID, quantity, Total_price, More_information) VALUES (?, ?, ?, ?, ?, ?);";
					break;

				case 'CreateClient':
					$insert = "INSERT INTO clients (Name, Email, Phone_number, Country, Address, Postal_code, City) 
					VALUES (?, ?, ?, ?, ?, ?, ?);";
					break;
				
				case 'CreateClientLogin':
					$insert = "INSERT INTO client_login (ClientID, Password) VALUES (?, ?);";
					break;
				default:
					throw new Exception("Not a Valid Request");
			}
			// Prepare the query
			$stmt = $db_handle->pdo->prepare($insert);
			// execute and bind parameters
			$stmt->execute($this->param);
			// Disconnect
			$stmt = null;
			return TRUE;
		} catch (PDOException $e) {
			// on any error, return false
			return FALSE;
		}
	}

	public function Update(){
		/**
		 * function updates data in database based on Type parameter
		 * @version 1.2
		 * @param $this->type String containing type of insert
		 * @param $this->param Array containing all data required for UPDATE
		 */
		try {
			// Creates new connection
			$db_handle = new Connection();
			// Set PDO to exception mode
			$db_handle->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// get insert type
			switch ($this->type) {
				case 'UpdateClientInfo':
					$update = "UPDATE clients SET Name = ?, Email = ?, Phone_number = ?, Country = ?, Address = ?, Postal_Code = ?, City = ? WHERE IDClient = ?;";
					break;
				default:
					throw new Exception("Not a Valid Request");
			}
			// Prepare the query
			$stmt = $db_handle->pdo->prepare($update);
			// execute and bind parameters
			$stmt->execute($this->param);
			// Disconnect
			$stmt = null;
			return TRUE;
		} catch (PDOException $e) {
			// on any error, return false
			return FALSE;
		}
	}

	public function Delete(){
		/**
		 * function deletes data in database based on Type parameter
		 * @version 1.1
		 * @param $this->type String containing type of insert
		 * @param $this->param Array containing all data required for DELETE
		 */
		try {
			// Creates new connection
			$db_handle = new Connection();
			// Set PDO to exception mode
			$db_handle->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// get insert type
			switch ($this->type) {
				case 'DeleteClientInfo':
					$update = "DELETE FROM clients WHERE IDClient = ?;";
					break;
				default:
					throw new Exception("Not a Valid Request");
			}
			// Prepare the query
			$stmt = $db_handle->pdo->prepare($update);
			// execute and bind parameters
			$stmt->execute($this->param);
			// Disconnect
			$stmt = null;
			return TRUE;
		} catch (PDOException $e) {
			// on any error, return false
			return FALSE;
		}
	}

	public function Fetch()
	{
		/**
		 * function Fetchs data from database based on Type parameter
		 * @version 2.3
		 * @param $this->type Parameter must contain one of the already defined type on switch: CheckEmail, LoginUser, LoginIntern, GetSales
		 * @param $this->param Array containing all data required for SELECT
		 */
		try {
			// Creates new connection
			$db_handle = new Connection();
			// Set PDO to exception mode
			$db_handle->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// get update type
			switch ($this->type) {
				case 'CheckEmail':
					$query = "SELECT * FROM clients WHERE Email = ? LIMIT 1";
					break;
				case 'LoginUser':
					$query = "SELECT * FROM client_login AS lg
					INNER JOIN clients AS c ON c.IDClient = lg.ClientID
					WHERE c.Email = ? AND lg.Password = ? LIMIT 1";
					break;
				case 'LoginIntern':
					$query = "SELECT * FROM users WHERE Email = ? AND Password = ? LIMIT 1";
					break;
				case 'GetSales':
					$query = "SELECT * FROM sales";
					break;
				case 'GetSalesByMonth':
					$query = "SELECT * from sales WHERE YEAR(Sale_date) = ? AND MONTH(Sale_date) = ?";
					break;
				case 'GetItems':
					$query = "SELECT * FROM items";
					break;
				case 'GetItemById':
					$query = "SELECT * FROM items WHERE IDItem = ? LIMIT 1";
					break;
				case 'GetClientById':
					$query = "SELECT * FROM clients WHERE IDClient = ? LIMIT 1";
					break;
				case 'GetOrderById':
					$query = "SELECT * FROM sales WHERE OrderID = ? LIMIT 1";
					break;
				case 'GetClientByEmail':
					$query = "SELECT * FROM clients WHERE Email = ? LIMIT 1";
					break;
				default:
					throw new Exception("Not a Valid Request");
			}
			// Prepare the query
			$stmt = $db_handle->pdo->prepare($query);
			// execute and bind parameters
			$stmt->execute($this->param);
			// fetch results
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// Disconnect
			$stmt = null;
			// validate db fetch returned data
			if (!empty($result) && count($result)) {
				// success
				return $result;
			} else {
				// failure
				return FALSE;
			}
		} catch (PDOException $e) {
			// on any error, return false
			return FALSE;
		}
	}
}
?>