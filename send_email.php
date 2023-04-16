<?php

ini_set('display_errors', 0);

function SendMail($sendTo, $subject, $template, $customer_address, $customer_purchase, $check_purchase)
    /** Sends emails to the sender defined on $sendTo, requires a $sendTo, $subject and $content. Also accepts 3 additional variables
        * @version 1.1
        * @param string $sendTo Email address to send the email
        * @param string $subject Email Subject
        * @param string $content Email template/body id, must match one of the implemented emails (email_sale / email_markenting)
    **/
{
    # Include the Sendinblue library
    require_once("vendor/autoload.php");
    # Instantiate the client and load api key
    $config = parse_ini_file("config.ini");

    // Sender 
    $from = $config['sendinblue_email'];

    $content = require_once("email_html.php");
    // defines the email html template
    switch($template) { 
        case 'email_sale':    
            $content = $content[0];
            break;
        case 'email_markenting': 
            $content = $content[1];
            break;  
    }

    $credentials = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', $config['sendinblue_key']);
    $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(),$credentials);

    $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
        'subject' => $subject,
        'sender' => ['name' => 'Blunder Car', 'email' => $from],
        'replyTo' => ['name' => 'Blunder Car', 'email' => $from],
        'to' => [['email' => $sendTo]],
        'htmlContent' => $content, 
        'params' => ['bodyMessage' => 'made just for you!']
    ]);
    
    try {
        $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
    } catch (Exception $e) {
        echo $e->getMessage(),PHP_EOL;
        die();
    }

}

if(isset($_POST['email-markenting'])){
    require_once('database/Authenticate.php');
    // variables
    $email = $_POST['email'];
    $go_back = $_POST['go_back'];
    $DB = new Authenticate();
    // test for null/empty inputs, which can't exist
    $FormData = array($email, $go_back);
    if ($DB->IsEmpty($FormData)) {
        // exception
        http_response_code(400);
        header('Location: '.$go_back);
        die();
    }

    // new db instance
    $DB->type = 'MarkentingEmail';
    $DB->param = array($email);
    $DB->Insert();
    SendMail($email, "Thank you for subscribing to our newsletter!", "email_markenting", 0, 0, 0);
    header('Location: '.$go_back);
    die();
}
?>