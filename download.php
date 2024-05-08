<?php
// Check if filename parameter is set
if(isset($_GET['filename'])) {
    // Get the filename from the URL parameter
    $filename = $_GET['filename'];


    // Check if the file exists in the uploads directory
    if(file_exists($filename)) {
        // Set headers to force download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Content-Length: ' . filesize($filename));

        // Read the file and output its contents
        readfile($filename);
        exit;
    } else {
        // File not found
        echo 'File not found.';
    }
} else {
    // Filename parameter is not set
    echo 'Filename parameter is not set.';
}
?>
