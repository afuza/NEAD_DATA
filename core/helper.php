<?php
require '../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Ramsey\Uuid\Uuid;

// Error handler to suppress "Undefined array key" and "Undefined variable" warnings
set_error_handler(function (int $errno, string $errstr) {
    return !(strpos($errstr, 'Undefined array key') !== false || strpos($errstr, 'Undefined variable') !== false);
}, E_WARNING);


@$refreshToken = $_COOKIE['refresh_Token'];

/**
 * Upload a file to AWS S3 bucket.
 *
 * @param array $file The uploaded file data from $_FILES.
 * @param string $strip The prefix to be added to the file key.
 * @return string|false The public URL of the uploaded file, or false if the upload fails.
 */
function uploadFile(array $file, string $strip): ?string
{
    // Check if required environment variables are set
    if (!isset($_ENV['AWS_ENDPOINT'], $_ENV['AWS_REGION'], $_ENV['AWS_ACCESS_KEY_ID'], $_ENV['AWS_SECRET_ACCESS_KEY'], $_ENV['AWS_BUCKET'])) {
        throw new Exception('AWS environment variables are not properly configured.');
    }

    $myuuid = Uuid::uuid4();
    $key = $strip . '-' . $myuuid->toString();

    $profil_credentials = getAwsClientConfiguration();

    try {
        $s3 = new S3Client($profil_credentials);
        $result = $s3->putObject([
            'Bucket' => $_ENV['AWS_BUCKET'],
            'Key' => $key,
            'SourceFile' => $file['tmp_name'],
            'ACL' => 'public-read',
        ]);

        return $result['ObjectURL'];
    } catch (AwsException $e) {
        // Log the error or handle it accordingly.
        // You might consider returning false instead of the raw error message for security reasons.
        return false;
    }
}

/**
 * Delete a file from AWS S3 bucket.
 *
 * @param string $key The key of the file to be deleted.
 * @return bool Whether the deletion was successful or not.
 */
function deleteFile(string $key): bool
{
    // Check if required environment variables are set
    if (!isset($_ENV['AWS_ENDPOINT'], $_ENV['AWS_REGION'], $_ENV['AWS_ACCESS_KEY_ID'], $_ENV['AWS_SECRET_ACCESS_KEY'], $_ENV['AWS_BUCKET'])) {
        throw new Exception('AWS environment variables are not properly configured.');
    }

    $profil_credentials = getAwsClientConfiguration();

    try {
        $s3 = new S3Client($profil_credentials);
        $result = $s3->deleteObject([
            'Bucket' => $_ENV['AWS_BUCKET'],
            'Key' => $key,
        ]);

        return $result['@metadata']['statusCode'] === 204;
    } catch (AwsException $e) {
        // Log the error or handle it accordingly.
        // Returning false might be more secure than exposing raw error messages.
        return false;
    }
}

/**
 * Get AWS S3 Client configuration.
 *
 * @return array The configuration array for AWS S3 Client.
 */
function getAwsClientConfiguration(): array
{
    return [
        'endpoint' => $_ENV['AWS_ENDPOINT'],
        'region' => $_ENV['AWS_REGION'],
        'version' => 'latest',
        'use_path_style_endpoint' => true,
        'credentials' => [
            'key' => $_ENV['AWS_ACCESS_KEY_ID'],
            'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
        ],
        'http' => [
            'verify' => false,
        ],
    ];
}


function AllEmail($apiUri)
{
    $header = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . getTokenAcc($apiUri)["accessToken"],
    ];
    $client = new Client([
        'verify' => false
    ]);
    $apiUri = "$apiUri/api/v1/email/data";
    $request = new Request('GET', $apiUri, $header);
    $res = $client->sendAsync($request)->wait();
    $code = $res->getStatusCode();
    $data = json_decode($res->getBody());
    if ($code === 200) {
        return $data;
    } else {
        return "DOWNLOAD ERROR";
    }
}

function getEmail($id, $apiUri)
{
    $header = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . getTokenAcc($apiUri)["accessToken"],
    ];
    $client = new Client([
        'verify' => false
    ]);
    $apiUri = "$apiUri/api/v1/email/data/$id";
    $request = new Request('GET', $apiUri, $header);
    $res = $client->sendAsync($request)->wait();
    $code = $res->getStatusCode();
    $data = json_decode($res->getBody());
    if ($code === 200) {
        return $data;
    } else {
        return "DOWNLOAD ERROR";
    }
}


/**
 * Saves email data by making a POST request to the API.
 *
 * @param array $body The email data to be saved.
 * @param string $apiUri The base API URI.
 * @return object|string The response data from the API if successful, or an error message if the request fails.
 */
function emailSave($body, $apiUri)
{
    try {
        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . getTokenAcc($apiUri)["accessToken"],
        ];
        $client = new Client([
            'verify' => false
        ]);

        $apiUri = "$apiUri/api/v1/email/data";
        $request = new Request('POST', $apiUri, $header, json_encode($body));
        $res = $client->sendAsync($request)->wait();
        $code = $res->getStatusCode();
        $data = json_decode($res->getBody());
        if ($code === 201) {
            return $data;
        } else {
            return "DOWNLOAD ERROR";
        }
    } catch (RequestException $e) {
        return $e->getMessage();
    }
}

/**
 * Updates email data by making a PUT request to the API.
 *
 * @param array $body The updated email data.
 * @param string $id The ID of the email to be updated.
 * @param string $apiUri The base API URI.
 * @return object|string The response data from the API if successful, or an error message if the request fails.
 */
function editEmail($body, $id, $apiUri)
{
    try {
        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . getTokenAcc($apiUri)["accessToken"],
        ];
        $client = new Client([
            'verify' => false
        ]);

        $apiUri = "$apiUri/api/v1/email/data/$id";
        $request = new Request('PUT', $apiUri, $header, json_encode($body));
        $res = $client->sendAsync($request)->wait();
        $code = $res->getStatusCode();
        $data = json_decode($res->getBody());
        if ($code === 200) {
            return $data;
        } else {
            return "DOWNLOAD ERROR";
        }
    } catch (RequestException $e) {
        return $e->getMessage();
    }
}

function deleteEmail($id, $apiUri)
{
    try {
        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . getTokenAcc($apiUri)["accessToken"],
        ];
        $client = new Client([
            'verify' => false
        ]);
        $apiUri = "$apiUri/api/v1/email/data/$id";
        $request = new Request('DELETE', $apiUri, $header);
        $res = $client->sendAsync($request)->wait();
        $code = $res->getStatusCode();
        return $code;
    } catch (RequestException $e) {
        return $e->getMessage();
    }
}


/**
 * Saves site data by making a POST request to the API.
 *
 * @param array $body The site data to be saved.
 * @param string $apiUri The base API URI.
 * @return object|string The response data from the API if successful, or an error message if the request fails.
 */
function siteSave($body, $apiUri)
{
    try {
        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . getTokenAcc($apiUri)["accessToken"],
        ];
        $client = new Client([
            'verify' => false
        ]);
        $apiUri = "$apiUri/api/v1/situs/data";
        $request = new Request('POST', $apiUri, $header, json_encode($body));
        $res = $client->sendAsync($request)->wait();

        $code = $res->getStatusCode();
        $data = json_decode($res->getBody());
        if ($code === 201) {
            return $data;
        } else {
            return "DOWNLOAD ERROR";
        }
    } catch (RequestException $e) {
        return $e->getMessage();
    }
}

/**
 * Updates site data by making a PUT request to the API.
 *
 * @param array $body The updated site data.
 * @param string $id The ID of the site to be updated.
 * @param string $apiUri The base API URI.
 * @return object|string The response data from the API if successful, or an error message if the request fails.
 */
function editSite($body, $id, $apiUri)
{
    try {
        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . getTokenAcc($apiUri)["accessToken"],
        ];
        $client = new Client([
            'verify' => false
        ]);

        $apiUri = "$apiUri/api/v1/situs/data/$id";
        $request = new Request('PUT', $apiUri, $header, json_encode($body));
        $res = $client->sendAsync($request)->wait();
        $code = $res->getStatusCode();
        $data = json_decode($res->getBody());
        if ($code === 200) {
            return $data;
        } else {
            return "DOWNLOAD ERROR";
        }
    } catch (RequestException $e) {
        return $e->getMessage();
    }
}

function allSite($apiUri)
{
    $header = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . getTokenAcc($apiUri)["accessToken"],
    ];
    $client = new Client([
        'verify' => false
    ]);
    $apiUri = "$apiUri/api/v1/situs/data";
    $request = new Request('GET', $apiUri, $header);
    $res = $client->sendAsync($request)->wait();
    $code = $res->getStatusCode();
    $data = json_decode($res->getBody());
    if ($code === 200) {
        return $data;
    } else {
        return "DOWNLOAD ERROR";
    }
}

function getSite($id, $apiUri)
{
    $header = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . getTokenAcc($apiUri)["accessToken"],
    ];
    $client = new Client([
        'verify' => false
    ]);
    $apiUri = "$apiUri/api/v1/situs/data/$id";
    $request = new Request('GET', $apiUri, $header);
    $res = $client->sendAsync($request)->wait();
    $code = $res->getStatusCode();
    $data = json_decode($res->getBody());
    if ($code === 200) {
        return $data;
    } else {
        return "DOWNLOAD ERROR";
    }
}

function deleteSite($id, $apiUri)
{
    try {
        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . getTokenAcc($apiUri)["accessToken"],
        ];
        $client = new Client([
            'verify' => false
        ]);
        $apiUri = "$apiUri/api/v1/situs/data/$id";
        $request = new Request('DELETE', $apiUri, $header);
        $res = $client->sendAsync($request)->wait();
        $code = $res->getStatusCode();
        return $code;
    } catch (RequestException $e) {
        return $e->getMessage();
    }
}


function getTokenAcc($apiUri)
{
    $refreshToken = $_COOKIE['refresh_Token'];

    try {
        $header = [
            'Content-Type' => 'application/json',
            'cookie' => 'refreshToken=' . $refreshToken . ';'
        ];

        $client = new Client([
            'verify' => false
        ]);

        $uri = "$apiUri/api/auth/refToken";
        $request = new Request('POST', $uri, $header);
        $res = $client->sendAsync($request)->wait();
        $code = $res->getStatusCode();
        $data = json_decode($res->getBody());
        $accessToken = $data->accessToken;
        if ($code === 200) {
            $data = [
                'accessToken' => $accessToken,
                'refreshToken' => $refreshToken
            ];
            return $data;
        } else {
            return "ERROR";
        }
    } catch (RequestException $e) {
        return $e->getMessage();
    }
}

function login($apiUri, $body)
{
    try {
        $header = [
            'Content-Type' => 'application/json',
        ];

        $client = new Client([
            'verify' => false
        ]);

        $uri = "$apiUri/api/auth/login";
        $request = new Request('POST',  $uri, $header, json_encode($body));
        $res = $client->sendAsync($request)->wait();

        $header = $res->getHeaders();
        $code = $res->getStatusCode();
        $data = json_decode($res->getBody());
        if ($code === 201) {
            $refreshToken = $header['Set-Cookie'][0];
            $refreshToken = explode(';', $refreshToken);
            $refreshToken = explode('=', $refreshToken[0]);
            $refreshToken = $refreshToken[1];
            setcookie('refresh_Token', $refreshToken, time() + (86400 * 7), "/", "", true, true);
            return "success";
        } else {
            return $data->message;
        }

        return $data;
    } catch (RequestException $e) {
        return $e->getMessage();
    }
}

function logout($apiUri)
{
    $refreshToken = $_COOKIE['refresh_Token'];
    try {
        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . getTokenAcc($apiUri)["accessToken"],
            'cookie' => 'refreshToken=' . $refreshToken . ';'
        ];

        $client = new Client([
            'verify' => false
        ]);

        $uri = "$apiUri/api/auth/logout";
        $request = new Request('DELETE', $uri, $header);
        $res = $client->sendAsync($request)->wait();
        $code = $res->getStatusCode();
        if ($code === 200) {
            setcookie('refresh_Token', '', time() - 3600, "/", "", true, true);
            setcookie('logout_alert_shown', '', time() + 3600, "/", "", false, true);
            return "success";
        } else {
            return "ERROR";
        }
    } catch (RequestException $e) {
        return $e->getMessage();
    }
}
