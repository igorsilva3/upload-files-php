<?php

$PATH = dirname(__DIR__, 2);
$AUTOLOAD_PATH = realpath($PATH.'/vendor/autoload.php');
$UPLOAD_PATH = realpath($PATH.'/uploads');

require_once $AUTOLOAD_PATH;

$storage = new \Upload\Storage\FileSystem($UPLOAD_PATH);
$files = new \Upload\File('files', $storage);

// Optionally you can rename the file on upload
$new_filenames = array_map("newName", 
  is_array($files->getName()) ? 
    $files->getName() : array($files->getName())
);

// set name for file
for ($i=0; $i < count($files); $i++) { 
  $file = $files[$i];
  $file->setName($new_filenames[$i]);
} 

// Create new name for file
function newName(string $originalName){
  return $originalName . uniqid("-");
}

// Validate file upload
// MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
// $file->addValidations(array(
//     // Ensure file is of type "image/png"
//     new \Upload\Validation\Mimetype('image/jpeg'),

//     //You can also add multi mimetype validation
//     //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

//     // Ensure file is no larger than 5M (use "B", "K", M", or "G")
//     new \Upload\Validation\Size('5M')
// ));

// Access data about the file that has been uploaded
$data = array(
    'name'       => $files->getNameWithExtension(),
    'extension'  => $files->getExtension(),
    'mime'       => $files->getMimetype(),
    'size'       => $files->getSize(),
    'md5'        => $files->getMd5(),
    'dimensions' => $files->getDimensions()
);

// Try to upload files
try {
    // Success!
    $response = $files->upload();
    if ($response) {
      echo json_encode($data);
    }
} catch (\Exception $e) {
    // Fail!
    $errors = $files->getErrors();
    echo json_encode($errors);
}