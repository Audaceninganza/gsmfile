<?php
include_once "./SubIndex.php";
?>

<body>

  <div id="content">
    <div id="file">
      <h1>List of file</h1>
      <div id="item">
        <?php foreach ($ZTE as $folders): ?>
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