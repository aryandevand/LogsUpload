<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AWS S3 Log Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .upload-container {
            max-width: 500px;
            margin: 50px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }
        .upload-container h2 {
            text-align: center;
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .form-group input {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 10px;
        }
        .btn-custom {
            display: block;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
        }
        .btn-upload {
            background-color: #007bff;
            color: white;
            border: none;
        }
        .btn-upload:hover {
            background-color: #0056b3;
        }
        .btn-manual {
            background-color: #ffc107;
            color: black;
            border: none;
        }
        .btn-manual:hover {
            background-color: #d39e00;
        }
    </style>
</head>
<body>

<div class="upload-container">
    <h2>Upload Logs to AWS S3</h2>


    <!-- Normal Upload (Uploads all logs from /logs folder) -->
<form action="upload.php" method="POST">
    <button type="submit" class="btn btn-custom btn-upload">Upload All Logs</button>
</form>

    <hr>

    <h2>Manual Upload</h2>
    <form action="manual_upload.php" method="POST" enctype="multipart/form-data">
        <div class="form-group mb-3">
            <input type="file" name="files[]" class="form-control" multiple required>
        </div>
        <button type="submit" class="btn btn-custom btn-manual">Upload Manual Logs</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
