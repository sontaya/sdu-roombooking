<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curl {
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function call_api($url, $method = 'GET', $data = [], $headers = [])
    {
        $ch = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($ch, CURLOPT_POST, 1);
                if (!empty($data)) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                }
                break;
            case "PUT":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                if (!empty($data)) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                }
                break;
            default:
                if (!empty($data)) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
        }

        // Set the URL
        curl_setopt($ch, CURLOPT_URL, $url);

        // Set headers if provided
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the request
        $result = curl_exec($ch);

        // Get information about the transfer
        $info = curl_getinfo($ch);

        // Check for errors
        $error = null;
        if(curl_errno($ch)) {
            $error = curl_error($ch);
        }

        // Close connection
        curl_close($ch);

        // Return response
        return [
            'response' => $result,
            'info' => $info,
            'error' => $error
        ];
    }
}
