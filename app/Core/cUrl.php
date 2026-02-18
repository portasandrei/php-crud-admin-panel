<?php

namespace App\Core;

class cUrl
{
    public const DEFAULT_TIMEOUT = 30;
    public const DEFAULT_RANDOM_DELAY = 3; // seconds 
    public const DEFAULT_FREQUENCY = 15 * 60; // 15 minutes

    /**
     * cURL wrapper for making HTTP requests.
     * Provides methods for GET requests and retrieving response details.
     * Can be extended to support POST, PUT, DELETE, etc. as needed.
     * 
     * 
     * 1. Rate/frequency control: Implement delays between requests to avoid hitting rate limits.
     * 2. Randomized User-Agent: Rotate User-Agent strings to mimic different clients.
     * 3. Other headers: Add support for custom headers like Referer, Accept-Language, Accept-Encoding, etc.
     * 4. Request type: Prefer GET requests for simple status checks, as they are less likely to be blocked than POST requests. (or Head requests if you only need headers)
     * 5. Cookies: Handle cookies if the target site uses them for session management or rate limiting. Usually leave empty for simple status checks. Only set Cookie if the site requires it for authentication or to bypass certain restrictions.
     * 6. TLS/SSL: Ensure proper handling of SSL certificates, especially if the target site uses HTTPS. You can set CURLOPT_SSL_VERIFYPEER and CURLOPT_SSL_VERIFYHOST to true for secure connections.
     * 
     */

    public function __construct()
    {
        if (!function_exists('curl_init')) {
            throw new \Exception('cURL is not enabled on this server.');
        }
    }

    public function request(string $url): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch);
        return $response;
    }

    public function requestOld(string $url): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch);

        $code = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        $headerSize = (int) curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $error = curl_error($ch) ?: null;

        if ($response === false) {
            return [
                'code'    => 0,
                'headers' => [],
                'body'    => '',
                'error'   => $error,
            ];
        }

        $headerBlock = substr($response, 0, $headerSize);
        $body = substr($response, $headerSize);

        $headers = [];
        foreach (explode("\r\n", trim($headerBlock)) as $line) {
            if (strpos($line, ':') !== false) {
                [$name, $value] = explode(':', $line, 2);
                $headers[trim($name)] = trim($value);
            }
        }

        return [
            'code'    => $code,
            'headers' => $headers,
            'body'    => $body,
            'error'   => $error,
        ];
    }
}