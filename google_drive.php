<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\Resource\Permissions;

// Initialize Google API client
$client = new Client();
// $client->setClientId(CLIENT_ID);
// $client->setClientSecret(CLIENT_SECRET);
$client->setAuthConfig(CLIENT_CREDENTIALS);
$client->setRedirectUri(REDIRECT_URI);
$client->setScopes(GOOGLE_OAUTH_SCOPE);
// $client->setScopes([Drive::DRIVE]);

// Initialize MySQL connection
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Function to create Google Drive folder and set sharing permission
function createGoogleDriveFolder($folderName, $email)
{
    global $client;

    // Authorize the client
    $client->setAccessType('offline');
    $client->setApprovalPrompt('force');
    $client->setAccessToken(getAccessToken());

    // Create Google Drive service
    $driveService = new Google_Service_Drive($client);

    // Check if the folder already exists
    $existingFolderId = getFolderIdByName($folderName);
    if ($existingFolderId) {
        $folderUrl = getFolderUrl($existingFolderId);
    } else {
        // Create a new folder
        $folder = new Drive\Model\DriveFile([
            'name' => $folderName,
            'mimeType' => 'application/vnd.google-apps.folder',
        ]);
        $createdFolder = $driveService->files->create($folder);

        // Set sharing permission
        $permission = new Permissions([
            'type' => 'user',
            'role' => 'writer',
            'emailAddress' => $email,
        ]);
        $driveService->permissions->create($createdFolder->id, $permission);

        $folderUrl = getFolderUrl($createdFolder->id);
    }

    return $folderUrl;
}

// Function to get access token
function getAccessToken()
{
    global $client;
    
    // Load previously authorized token from file if it exists
    $tokenPath = 'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired, refresh the token
    if ($client->isAccessTokenExpired()) {
        $refreshToken = $client->getRefreshToken();
        $client->fetchAccessTokenWithRefreshToken($refreshToken);
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    $token = $client->getAccessToken();
    // Check for errors
    if (is_null($token)) {
        // Handle the error, log it, or print it for debugging
        echo "Error: " . $error;
        exit;
    }
    file_put_contents($tokenPath, json_encode($token));
    return $token;
}

// Function to get folder ID by name
function getFolderIdByName($folderName)
{
    global $mysqli;

    $query = "SELECT folder_id FROM folders WHERE folder_name = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $folderName);
    $stmt->execute();
    $stmt->bind_result($folderId);
    $stmt->fetch();
    $stmt->close();

    return $folderId;
}

// Function to get folder URL by ID
function getFolderUrl($folderId)
{
    return "https://drive.google.com/drive/folders/$folderId";
}

// Main logic
$folderUrl = createGoogleDriveFolder(ROOT_FOLDER_NAME, SHARED_PERMISSION_EMAIL);
echo "folderUrl" . $folderUrl;
// Store the folder URL in the database
$query = "INSERT INTO folders (folder_name, folder_url) VALUES (?, ?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('ss', ROOT_FOLDER_NAME, $folderUrl);
$stmt->execute();
$stmt->close();

$mysqli->close();
