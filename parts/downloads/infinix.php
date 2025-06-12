<!-- <?php
        print_r($payment);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        include_once "../../php/functions.php"; // Adjust the path if necessary

        $current_page = basename(__FILE__, ".php");


        // Define download links and details
        $downloads = [
            [
                'id' => 1,
                'file_name' => 'N985F U11 ANDROID 13 ROOT',
                'file_link' => 'https://drive.google.com/file/d/1gT8DF5j4YRvhSOyUEDPdvsRkWIjw6HdR/view',
                'size' => '2.4 GB'
            ],
            [
                'id' => 2,
                'file_name' => 'N985F U11 ANDROID 13 ROOT',
                'file_link' => 'https://drive.google.com/file/d/1gT8DF5j4YRvhSOyUEDPdvsRkWIjw6HdR/view',
                'size' => '4.3 GB'
            ],

            [
                'id' => 3,
                'file_name' => 'N985F U11 ANDROID 13 ROOT',
                'file_link' => 'https://drive.google.com/file/d/1gT8DF5j4YRvhSOyUEDPdvsRkWIjw6HdR/view',
                'size' => '5.6 GB'
            ],
        ];

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
    <h1 style="color: black;">Infinix</h1>
    <?php foreach ($downloads as $download): ?>
    <div class="card_download">
        <div class="container_file">
            <img src="assets/images/file-earmark-zip.svg" alt="Image" >
            <div class="content">
                <h2 class="title"><?php echo $download['file_name']; ?></h2>
                <label for="" id="size">Size: <?php echo $download['size']; ?></label>
                <a href="parts/downloads/redirect.php?file=<?= base64_encode($download['file_link']) ?>&file_id=<?= $download['id'] ?>&folder=<?= $current_page ?>" target="_blank">
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
</html> -->
<?php
include_once "./SubIndex.php";
?>

<body>

    <div id="content">
        <div id="file">
            <h1>List of file</h1>
            <div id="item">
                <?php foreach ($infinix as $folders): ?>
                    <div id="item_box" class="item1">
                        <a href="#" class="load-content" data-url="<?php echo $folders['url']; ?>">
                            <img src="<?php echo $folders['img'] ?>" alt="file" width="100px" height="100px">
                            <div>
                                <h1 id="model"><?php echo $folders['title'] ?></h1>
                                <p><?php echo $folders['description'] ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>