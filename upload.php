


<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

// AWS Credentials
$accessKeyId = '';
$secretAccessKey = '';
$region = 'eu-north-1'; 
$bucket = 'myawslogbucket2025';

// Initialize S3 Client
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => $region,
    'credentials' => [
        'key'    => $accessKeyId,
        'secret' => $secretAccessKey
    ]
]);

// Logs folder path
$logsDirectory = __DIR__ . '/logs';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get current date structure
    $currentDate = new DateTime();
    $year = $currentDate->format('Y');
    $month = $currentDate->format('m');
    $day = $currentDate->format('d');

    try {
        // Scan logs directory for files
        $files = array_diff(scandir($logsDirectory), array('.', '..'));

        if (empty($files)) {
            header("Location: index.php?error=No log files found in logs directory");
            exit();
        }

        foreach ($files as $file) {
            $filePath = $logsDirectory . '/' . $file;
            
            if (is_file($filePath)) {
                $s3Key = "{$year}/{$month}/{$day}/{$file}";

                $s3->putObject([
                    'Bucket' => $bucket,
                    'Key'    => $s3Key,
                    'Body'   => fopen($filePath, 'rb'),
                    //'ACL'    => 'private',
                ]);
            }
        }

        header("Location: index.php?success=logs_uploaded");
        exit();
    } catch (S3Exception $e) {
        header("Location: index.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: index.php?error=Invalid request");
    exit();
}
?>
