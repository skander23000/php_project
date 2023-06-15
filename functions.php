<?php

/**
 * pdo_connect_mysql
 *
 * return une instance de la classe PDO
 * 
 * @return PDO|never
 */
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'shoppingcart';

    try {
        $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8;port=3306', $DATABASE_USER, $DATABASE_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $exception) {
        // S'il y a une erreur avec la connexion, arrête le script et affiche l'erreur.
        exit('Failed to connect to database! ' . $exception->getMessage());
    }
}


// HEADER
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style4.css" rel="stylesheet" type="text/css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <h1>Gaming </h1>
                <nav>
                    <a href="index.php">Home</a>
                    
                </nav>
                <div class="link_cart">
                <a href="index.php?page=new_product">new product</a>
                </div>
                <div class="link_cart">               
                <a href="index.php?page=cart">cart</a>               
                </div>
               

            </div>
        </header>
        <main>
EOT;
}


// FOOTER
function template_footer() {
echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
               <ul>
                 <P > <span style="font-size:20px;font-weight:bold">contact us on : </span> </P>
                 <li>FACEBOOK :  Gaming_facebook</li>
                 <li>INSTAGRAM : Gaming_instagram</li>
                 <li>TWITTER :   Gaming_twitter</li>
               </ul>  
            </div>
        </footer>
        <script src="script.js"></script>
    </body>
</html>
EOT;
}
?>