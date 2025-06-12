<?php
include_once "parts/index.php"
?>


<body>
    <div id="content">
        <div id="file">
            <!-- <div id="formContainer">
                <h3>For quick access search here</h3>
                <form action="" class="form">
                    <div class="searchbar">
                        <input type="text" id="search" onkeyup="search_model()" placeholder="Search by model" />
                        <button>GO</button>
                    </div>
                </form>
            </div> -->


            <h1>List of file</h1>
            <div id="item">
                <?php foreach ($folder as $folders): ?>
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

    <div class="footer">
        <div id="logofooter">
            <img src="assets/images/AI21.png" alt="log" width="70" height="70">
        </div>
        <span>&copy; Copyright © 2024 AIINFOGSM All Rights Reserved.</span>
    </div>

    <script>
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('menu');
        const overlay = document.getElementById('overlay');

        // Toggle sidebar and overlay
        hamburger.addEventListener('click', () => {
            sidebar.style.right = '0';
            overlay.style.display = 'block';
        });

        // Close sidebar when clicking outside
        overlay.addEventListener('click', () => {
            sidebar.style.right = '-250px';
            overlay.style.display = 'none';
        });
    </script>
</body>

</html>