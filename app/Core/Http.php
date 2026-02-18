<?php
namespace App\Core;

class Http
{
    public static function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public static function getRequestUri(): string
    {
        return $_SERVER['REQUEST_URI'] ?? '/';
    }

    public static function getRequestData(): array
    {
        $data = [];
        if (self::getRequestMethod() === 'POST') {
            $data = $_POST;
        } elseif (self::getRequestMethod() === 'GET') {
            $data = $_GET;
        }
        return $data;
    }

    public static function getHeaders(): array
    {
        return getallheaders();
    }

    public static function getQueryParams(): array
    {
        return $_GET;
    }

    public static function getBody(): string
    {
        return file_get_contents('php://input');
    }

    public static function getJson(): array
    {
        $body = self::getBody();
        return json_decode($body, true) ?? [];
    }

    public static function getFiles(): array
    {
        return $_FILES;
    }

    public static function getCookies(): array
    {
        return $_COOKIE;
    }

    public static function getSession(): array
    {
        return $_SESSION;
    }

    public static function getClientIp(): string
    {
        return $_SERVER['REMOTE_ADDR'] ?? '';
    }

    public static function getUserAgent(): string
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? '';
    }   

    public static function getReferrer(): string
    {
        return $_SERVER['HTTP_REFERER'] ?? '';
    }   

    public static function getHost(): string
    {
        return $_SERVER['HTTP_HOST'] ?? '';
    }

    public static function getProtocol(): string
    {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https' : 'http';
    }

    public static function getFullUrl(): string
    {
        return self::getProtocol() . '://' . self::getHost() . self::getRequestUri();
    }   

    public static function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    public static function isSecure(): bool
    {
        return self::getProtocol() === 'https';
    }

    public static function isJson(): bool
    {
        return strpos(self::getHeaders()['Content-Type'] ?? '', 'application/json') !== false;
    }

    public static function isForm(): bool
    {
        return strpos(self::getHeaders()['Content-Type'] ?? '', 'application/x-www-form-urlencoded') !== false;
    }   

    public static function isMultipart(): bool
    {
        return strpos(self::getHeaders()['Content-Type'] ?? '', 'multipart/form-data') !== false;
    }

    public static function isGet(): bool
    {
        return self::getRequestMethod() === 'GET';
    }

    public static function isPost(): bool
    {
        return self::getRequestMethod() === 'POST';
    }

    public static function isPut(): bool
    {
        return self::getRequestMethod() === 'PUT';
    }

    public static function isDelete(): bool
    {
        return self::getRequestMethod() === 'DELETE';
    }

    public static function isPatch(): bool
    {
        return self::getRequestMethod() === 'PATCH';
    }

    public static function isOptions(): bool
    {
        return self::getRequestMethod() === 'OPTIONS';
    }

    public static function isHead(): bool
    {
        return self::getRequestMethod() === 'HEAD';
    }

    public static function isCli(): bool
    {
        return php_sapi_name() === 'cli';
    }

    public static function isMobile(): bool
    {
        $userAgent = self::getUserAgent();
        return preg_match('/Mobile|Android|iP(hone|od|ad)|IEMobile|BlackBerry|Opera Mini/i', $userAgent);
    }

    public static function isBot(): bool
    {
        $userAgent = self::getUserAgent();
        return preg_match('/bot|crawl|slurp|spider/i', $userAgent);
    }

    public static function isApi(): bool
    {
        return strpos(self::getRequestUri(), '/api/') === 0;
    }   

    public static function isAdmin(): bool
    {
        return strpos(self::getRequestUri(), '/admin/') === 0;
    }

    public static function getHttpCode(): int|false
    {
        return http_response_code();
    }

    public static function setHttpCode(int $code): void
    {
        http_response_code($code);
    }

    public static function getHttpCodeMessage(): string
    {
        $code = self::getHttpCode();
        $codes = json_decode(file_get_contents(ROOT . '/config/http_codes.json'), true);

        return $codes[$code] ?? '';
    }

    public static function getRemoteResponse(string $url): string
    {
        $curl = new cUrl();
        return $curl->request($url);
    }

}