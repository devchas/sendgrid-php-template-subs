<?php
namespace SendGrid;
require 'vendor/autoload.php';

// Array of objects containing emails, customer and shopping list information
// This would need to be created for this script to work
// In a real scenario, pulls from the database
$customers = array(...);

$from = new Email("Sender Name", "sender@test.com");
$subject = "Sending with SendGrid is Fun";
$to = new Email("Recipient Name", "recipient@test.com");
$content = new Content("text/html", "Placeholder content");
$mail = new Mail($from, $subject, $to, $content);
// Replace with actual template ID
$mail->setTemplateId("<TEMPLATE_ID>");

// Create the personalization
foreach ($customers as $value) {
  $personalization = new Personalization();
  $email = new Email($value->name, $value->email);
  $personalization->addTo($email);
  // The following assumes you have a template with the %shoppingList% placeholder
  $personalization->addSubstitution("%shoppingList%", createHTMLBlock($value->shoppingList));
  $mail->addPersonalization($personalization);
}


$apiKey = $_ENV["SG_API_KEY"];
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
echo $response->statusCode();
print_r($response->headers());
echo $response->body();


// Create your custom shopping list html block here
function createHTMLBlock($value) {
  return "
    <div>" . $value . "</div>
  ";
}