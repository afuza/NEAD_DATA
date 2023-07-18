<?php

require '../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Ramsey\Uuid\Uuid;


/**
 * Uploads a file to AWS S3 bucket.
 *
 * @param array $file The uploaded file data from $_FILES.
 * @param string $strip The prefix to be added to the file key.
 * @return string|AwsException The public URL of the uploaded file, or an error message if the upload fails.
 */
function uploadFile($file, $strip)
{
    $myuuid = Uuid::uuid4();
    $key = $strip . '-' . $myuuid->toString();

    $profil_credentials = [
        'endpoint' => $_ENV['AWS_ENDPOINT'],
        'region' => $_ENV['AWS_REGION'],
        'version' => 'latest',
        'use_path_style_endpoint' => true,
        'credentials' => [
            'key'    => $_ENV['AWS_ACCESS_KEY_ID'],
            'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
        ],
        'http' => [
            'verify' => false,
        ],
    ];

    $s3 = new S3Client($profil_credentials);

    try {
        $result = $s3->putObject([
            'Bucket' => $_ENV['AWS_BUCKET'],
            'Key'    => $key,
            'SourceFile' => $file['tmp_name'],
            'ACL'    => 'public-read'
        ]);

        return $result['ObjectURL'];
    } catch (AwsException $e) {
        return $e->getMessage();
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
            'Content-Type' => 'application/json'
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
            'Content-Type' => 'application/json'
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
            'Content-Type' => 'application/json'
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
            'Content-Type' => 'application/json'
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
