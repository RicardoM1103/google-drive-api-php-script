<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

use w3lifer\google\Drive;
use Google\Service\Drive\Resource\Permissions;

$googleDrive = new Drive([
    'pathToCredentials' => __DIR__ . '/credentials.json', // Required
    'pathToToken' => __DIR__ . '/token.json', // Required
]);

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
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

function createGoogleDriveFolder($folderName, $email = null)
{
    global $googleDrive;
    $folderId = null;
    // Check if the folder already exists
    $existingFolderId = getFolderIdByName($folderName);
    if ($existingFolderId) {
        $folderUrl = getFolderUrl($existingFolderId);
        $folderId = $existingFolderId;
    } else {
        // Create a new folder
        $newFolderId = $googleDrive->createFolder($folderName);
        $folderId = $newFolderId;
        // Set sharing permission
        // $permission = new Permissions([
        //     'type' => 'user',
        //     'role' => 'writer',
        //     'emailAddress' => $email,
        // ]);
        // $driveService->permissions->create($folderId, $permission);

        $folderUrl = getFolderUrl($folderId);

        // Store the folder URL in the database
        saveFolderUrl($newFolderId, $folderName, $folderUrl);
    }

    return compact('folderUrl', 'folderId', 'folderName');
}


function saveFolderUrl($folderId, $folderName, $folderUrl) {
    global $mysqli;
    $query = "INSERT INTO folders (folder_id, folder_name, folder_url) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('sss', $folderId, $folderName, $folderUrl);
    $stmt->execute();
    $stmt->close();
}
// $fileId = $googleDrive->upload(
//     __DIR__ . '/hello.txt',  // Required
//     // [ // Optional
//     //     '<folder id>',
//     //     '<folder id>',
//     // ]
// );

// Main logic
$ret = createGoogleDriveFolder(ROOT_FOLDER_NAME);
var_dump($ret);

$mysqli->close();

