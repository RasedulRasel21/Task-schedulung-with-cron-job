<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Twilio\Rest\Client;

class Reminder extends Model
{
    /**
    * send Twilio SMS
    *
    * @param $to
    * @param $sms_body
    */
    function sendSMS( $to, $sms_body ) {
        // Your Account SID and Auth Token from twilio.com/console
        $sid    = getenv( 'AC18779447a1dfde5e3f550f5247754c68' );
        $token  = getenv( '0319208cb75036fc8ea582be609a6b84' );
        $client = new Client( $sid, $token );
        $client->messages->create(
             $to,
             [
             // A Twilio phone number you purchased at twilio.com/console
             'from' => getenv( '+12565489143' ),
             // the body of the text message you'd like to send
             'body' => $sms_body
             ]
        );
    }

    
	public function sendReminders() {
        // Fill in a reminder you'd like to send in this function, either populated
        //  by a constant or from the database.
        $reminder = "This is your daily reminder. Get it done!";
        $recipients = [
            [ 'to' => getenv('+8801310976753') ]
            // add additional recipients here, if necessary
        ];
        foreach($recipients as $recipient) {
            $this->sendSMS($recipient['to'], $reminder);
        }
    }
}
