<?php
// on vérifie que le paramètre id est spécifié dans l'URL
if (isset($_GET['id'])) {
    // Préparation de l'instruction et exécution, empêche l'injection SQL
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Récupère le produit de la base de données et renvoie le résultat sous forme de tableau
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Vérifie si le produit existe 
    if (!$product) {
        // Erreur simple à afficher si l'id du produit n'existe pas 
        exit('Product does not exist!');
    }
} else {
   // Erreur simple à afficher si l'identifiant n'a pas été spécifié
    exit('Product does not exist!');
}
?>


<!------------------------------------------------- LA PARTIE  HTML  DU PRODUIT  ------------------------------------------------------------->


<?=template_header('Product')?>

<div class="product content-wrapper">
    <img src="imgs/<?=$product['img']?>" width="500" height="500" alt="<?=$product['name']?>">
    <div>
        <h1 class="name"><?=$product['name']?></h1>
        <span class="price">
            &dollar;<?=$product['price']?>
        </span>
        <form action="index.php?page=cart" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>"
                placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
            <input type="submit" value="Add To Cart">
        </form>
        <div class="description">
            <?=$product['desc']?>
        </div>
    </div>
</div>

<?=template_footer()?>