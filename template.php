<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="Styles/stylesheet.css" />
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <div id="wrapper">
            <div id="banner">

            </div>

            <nav id="navigation">
                <ul id="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="Coffee.php">Coffe</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="Managment.php">Managment</a></li>
                </ul>
            </nav>

            <div id="content_area">
                <?php echo $content; ?>
            </div>

            <div id="sidebar">

            </div>

            <footer>
                <p>All rights reserved <br/> <?php echo date("Y"); ?></p>
            </footer>
        </div>
    </body>
</html>