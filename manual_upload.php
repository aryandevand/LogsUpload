
<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


$accessKeyId = '';
$secretAccessKey = '';
$region = 'us-east-1';
$bucket = 'myawslogbucket2025';


$s3 = new S3Client([
    'version' => 'latest',
    'region'  => $region,
    'credentials' => [
        'key'    => $accessKeyId,
        'secret' => $secretAccessKey
    ]
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['files']) && !empty($_FILES['files']['name'][0])) {
    $uploadedFiles = $_FILES['files'];
    $fileCount = count($uploadedFiles['name']);

    $currentDate = new DateTime();
    $year = $currentDate->format('Y');
    $month = $currentDate->format('m');
    $timestamp = $currentDate->format('Y-m-d_H-i-s');

    try {
        for ($i = 0; $i < $fileCount; $i++) {
            $tmpFilePath = $uploadedFiles['tmp_name'][$i];
            $fileName = "mu_{$timestamp}.log";
            $s3Key = "{$year}/{$month}/{$fileName}";

            $s3->putObject([
                'Bucket' => $bucket,
                'Key'    => $s3Key,
                'Body'   => fopen($tmpFilePath, 'rb'),
                //'ACL'    => 'private',
            ]);
        }

        header("Location: index.php?success=manual");
        exit();
    } catch (S3Exception $e) {
        header("Location: index.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: index.php?error=No files selected");
    exit();
}
?>
