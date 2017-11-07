<?php 
    function doHead() {
        ?>
        <link rel="stylesheet" type="text/css" href="./styles/style.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <?php
    }
    function doHeader() {
        ?>
        <header>
            <nav>
                <div>
                    <h1>Games!</h1>
                </div>
                <div class="spacer"></div>
                <div>
                    <?php 
                    if(isset($_SESSION['username'])) {
                        ?>
                        <a href="?logout=logout">Logout</a>
                        <?php
                    } 
                    ?>
                </div>
            </nav>
        </header>
        <?php
    }
    function doFooter() {
        ?>
        <footer>
            <div>
                <span>Brett</span>
                <span>Khide</span>
            </div>
        </footer>
        <?php
    }
?>