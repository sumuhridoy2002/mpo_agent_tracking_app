<?php

namespace App\Traits;

/**
 * Trait for handling OTP Send.
 *
 * @author Hridoy
 */
trait SendOTP
{
    use HttpResponse;

    /**
     * Send OTP.
     *
     * @param string $message
     * @param int $code
     *
     * @return bool
     */
    protected function sendOTP(string $phone, int $code)
    {
        $token   = env('GREENWEB_TOKEN'); // GreenWeb API access token
        $to      = $phone;
        $message = $code . " is your verification code.";

        $data = [
            'to'      => $to,
            'message' => $message,
            'token'   => $token,
        ];

        $url = "http://api.greenweb.com.bd/api.php?json";

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL request
        $smsresult = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            // Handle cURL errors here
            curl_close($ch); // Close cURL resource
            $this->sendError('curl_errno error arise on SendOTP trait.', 500); // Indicate an error
            return false;
        }

        // Close cURL resource
        curl_close($ch);

        // Decode the JSON response
        $decodedResult = json_decode($smsresult);

        // Check if JSON decoding was successful and the status property exists
        if ($decodedResult && isset($decodedResult[0]) && isset($decodedResult[0]->status) && $decodedResult[0]->status == 'SENT') return true;
        $this->sendError('Could not decode $smsresult on SendOTP trait.', 500); // Indicate an error (invalid JSON response)
        return false;
    }
}