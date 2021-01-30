<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Files</title>
  <style>
    .content form{
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="content">
    <h1>Upload Files</h1>
    <form method="POST" enctype="multipart/form-data" action="./config/upload.php">
        <input type="file" name="file" value="" multiple=""/>
        <input type="submit" value="Upload File"/>
    </form>
  </div>
  
</body>
</html>