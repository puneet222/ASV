<?php
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun('key-fa92398af728e7e2cb68e5780be6c981');
$domain = "sandbox530294b2de6c4dbea8d2235492c559aa.mailgun.org";

# Make the call to the client.
$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'Mailgun Sandbox <postmaster@sandbox530294b2de6c4dbea8d2235492c559aa.mailgun.org>',
                        'to'      => 'Puneet <aggarwal.puneet222@gmail.com>',
                        'subject' => 'Hello Puneet',
                        'text'    => 'Congratulations Puneet, you just sent an email with Mailgun!  You are truly awesome!  You can see a record of this email in your logs: https://mailgun.com/cp/log .  You can send up to 300 emails/day from this sandbox server.  Next, you should add your own domain so you can send 10,000 emails/month for free.'));


                      
?>
