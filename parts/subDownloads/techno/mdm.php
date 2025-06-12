<?php
print_r($payment);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once "../../../php/functions.php"; // Adjust the path if necessary

$current_page = basename(__FILE__, ".php");
require_once "./index.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Download Files</title>
  <link href="/css/downloads.css" rel="stylesheet" />
</head>

<body>
  <div class="Down">
    <h1 style="color: black;">Techno/mdm</h1>
    <?php foreach ($TecnoxMDMfiles as $mdm): ?>
      <div class="card_download">
        <div class="container_file">
          <img src="assets/images/file-earmark-zip.svg" alt="Image">
          <div class="content">
            <h2 class="title"><?php echo $mdm['file_name']; ?></h2>
            <label for="" id="size">Size: <?php echo $mdm['size']; ?></label>
            <a href="parts/downloads/redirect.php?file=<?= base64_encode($mdm['file_link']) ?>&file_id=<?= $download['id'] ?>&folder=<?= $current_page ?>" target="_blank">
              <button type="submit" name="download" style="background-color: rgb(185, 65, 35); border:none;width: 90px;height: 40px;border-radius: 5px;">
                Download
              </button>
            </a>

          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</body>

</html>