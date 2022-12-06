<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VoiceGrant;
use Twilio\TwiML\VoiceResponse;

class PhoneController extends Controller
{
    /**
     * Get twilio access token.
     */
    public function getAccessToken(Request $request)
    {
        // Get the access token from twilio via their package.
        $access_token = new AccessToken(
            env('TWILIO_ACCOUNT_SID'),
            env('TWILIO_API_KEY'),
            env('TWILIO_API_SECRET'),
            3600,
            'Mathew_James',
            'us1'
        );

        // Grant voice permissions.
        $voiceGrant = new VoiceGrant();
        $voiceGrant->setOutgoingApplicationSid(env('TWILIO_TWIML_APP_SID'));

        // Grant incoming call permissions.
        $voiceGrant->setIncomingAllow(true);

        // Add grant to access token.
        $access_token->addGrant($voiceGrant);

        // Render our token to a JWT
        $token = $access_token->toJWT();

        return response()->json([
            'identity' => 'Mathew_James',
            'token' => $token
        ]);
    }

    /**
     * Function to handle inbound/outbound phone calls for twilio.
     */
    public function handleCallRouting(Request $request)
    {
        // Get the number we are calling.
        $dialledNumber = $request->get('To') ?? null;

        // Set up instance of voice response.
        $voiceResponse = new VoiceResponse();

        if ($dialledNumber != env('TWILIO_CALLER_ID')) {
            # Outbound phone call.

            // Remove any html special characters.
            $number = htmlspecialchars($dialledNumber);

            // Dial.
            $dial = $voiceResponse->dial('', ['callerId' => env('TWILIO_CALLER_ID')]);

            if (preg_match("/^[\d+\-\(\) ]+$/", $number)) {
                # Standard outbound phone call to telephone number.
                $dial->number($number);
            } else {
                # Client to client (Agent - Agent) phone call.
            }
        }elseif($dialledNumber == env('TWILIO_CALLER_ID')){
            # Inbound phone calls

            // Setup a dial / response.
            $dial = $voiceResponse->dial('');

            // Dial the client. (Hardcoded for now.)
            $dial->client('Mathew_James');

        }else{
            $voiceResponse->say("Thank you for calling up!");
        }

        return (string)$voiceResponse;
    }
}
