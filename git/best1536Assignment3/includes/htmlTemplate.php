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
                
            <?php 
            if(isset($_SESSION['username'])) {
                ?>
                <div>
                    <a href="?logout=logout">
                        <h2>Logout</h2>
                    </a>
                </div>
                <?php
            } 
            ?>
                
            </nav>
        </header>
        <?php
    }
    function doFooter() {
        ?>
        <footer>
            <div>
                <span>Brett & Khide</span>
            </div>
        </footer>
        <?php
    }
?>