<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once("database\Authenticate.php");

final class AuthenticateTest extends TestCase
{
    // Test if the nick  fullfills the requirements of regex
    public function testValidNick() : void
    {
        $nick = 'blabla';
        $Authenticate = new Authenticate();
        $this->assertTrue($Authenticate->isValidNick($nick));
    }
    //
    public function testInvalidNick() : void
    {
        $nick = '';
        $Authenticate = new Authenticate();
        $this->assertFalse($Authenticate->isValidNick($nick));
    }

    // Test if the email fullfills the requirements of regex
    public function testValidEmail() : void
    {
        $email = 'text@example.com';
        $Authenticate = new Authenticate();
        $this->assertSame($Authenticate->isValidEmail($email), $email);
    }
    // Test if the email doesn't fullfill the requirements of regex
    public function testInvalidEmail() : void {
        $email = 'textexample.com';
        $Authenticate = new Authenticate();
        $this->assertFalse($Authenticate->isValidEmail($email));
    }
    
    // Test if the array is empty
    public function testisEmpty() : void {
        $data_array = array("");
        $Authenticate = new Authenticate();
        $this->assertTrue($Authenticate->isEmpty($data_array));
    }
    // Test if the array is not empty
    public function testIsNotEmpty() : void {
        $data_array = array("test");
        $Authenticate = new Authenticate();
        $this->assertFalse($Authenticate->isEmpty($data_array));
    }

    

}
?>