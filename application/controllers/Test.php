<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller
{
    private $auth_key = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6Imlncm91cCJ9.YXLTjqvvzC9jhwEd3BTTKVewNb78Kv93_2w-gW_UnF8'; // Replace with your actual authentication key

    public function __construct()
    {
        parent::__construct();
        $this->load->library('curl');
    }

    public function index()
    {
        // API URL
        $url = 'https://eprofile.dusit.ac.th/app/api/get_faculty_master';

        // Post data - Convert to JSON string
        $data = json_encode(array(
            'code_faculty' => '01'
        ));

        // Headers
        $headers = array(
            'Authorization: ' . $this->auth_key,
            'Content-Type: application/json',
            'Accept: application/json'
        );

        try {
            // Initialize cURL
            $ch = curl_init();

            // Set cURL options
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $data, // Send JSON string directly
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_SSL_VERIFYPEER => false, // Only for testing
                CURLOPT_SSL_VERIFYHOST => false  // Only for testing
            ));

            // Execute request
            $response = curl_exec($ch);

            // Check for cURL errors
            if(curl_errno($ch)) {
                throw new Exception(curl_error($ch));
            }

            // Get HTTP status code
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            // Close cURL
            curl_close($ch);

            // Log raw response for debugging
            log_message('debug', 'Raw API Response: ' . $response);

            // Check HTTP status
            if($http_status != 200) {
                throw new Exception('HTTP Status: ' . $http_status);
            }

            // Decode JSON response
            $result = json_decode($response, true);

            // Check for JSON decode errors
            if (json_last_error() !== JSON_ERROR_NONE) {
                log_message('error', 'JSON Decode Error: ' . json_last_error_msg());
                log_message('error', 'Response that failed to decode: ' . $response);
                throw new Exception('Invalid JSON response: ' . json_last_error_msg());
            }

            $output = array(
                'status' => 'success',
                'data' => $result
            );

        } catch (Exception $e) {
            $output = array(
                'status' => 'error',
                'message' => $e->getMessage(),
                'debug_info' => [
                    'url' => $url,
                    'sent_data' => $data,
                    'response' => isset($response) ? $response : null,
                    'http_status' => isset($http_status) ? $http_status : null
                ]
            );
            log_message('error', 'API Error: ' . print_r($output, true));
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($output));
    }

    // Debug method to test API connection
    public function test()
    {
        $url = 'https://eprofile.dusit.ac.th/app/api/get_faculty_master';

        $data = json_encode(array(
            'code_faculty' => '01'
        ));

        $headers = array(
            'Authorization: ' . $this->auth_key,
            'Content-Type: application/json',
            'Accept: application/json'
        );

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_VERBOSE => true
        ));

        // For debugging - capture verbose output
        $verbose = fopen('php://temp', 'w+');
        curl_setopt($ch, CURLOPT_STDERR, $verbose);

        $response = curl_exec($ch);

        // Get debug info
        $info = curl_getinfo($ch);

        rewind($verbose);
        $verboseLog = stream_get_contents($verbose);

        echo "<pre>";
        echo "Request Headers:\n";
        print_r($headers);
        echo "\nRequest Data:\n";
        print_r($data);
        echo "\nResponse Info:\n";
        print_r($info);
        echo "\nRaw Response:\n";
        print_r($response);
        echo "\nVerbose Log:\n";
        print_r($verboseLog);
        echo "</pre>";

        curl_close($ch);
        fclose($verbose);
    }
}
