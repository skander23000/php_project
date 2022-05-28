<?php
// Obtenez les 12 derniers produits ajoutés
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 12');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Home')?>

<div class="featured">
    <h2> gaming hardware </h2>
    <p>buy all what you need for your gaming setup</p>
</div>

<!-------------------------------- LA PARTIE PHP AFFICHAGE DE PRODUIT SUR HOME   --------------------------------------->

<?php
// Les quantités de produits à afficher sur chaque page
$num_products_on_each_page = 12;
// La page actuelle
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Sélectionner les produits commandés par date d'ajout
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT ?,?');
// bindValue nous permettra d'utiliser un entier dans l'instruction SQL, nous devons utiliser pour LIMIT
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Récupère les produits de la base de données AVEC FETCH et renvoie le résultat sous forme de tableau 
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total_products = $pdo->query('SELECT * FROM products')->rowCount();
?>

<!-------------------------------- LA PARTIE HTML AFFICHAGE DE PRODUIT SUR HOME   --------------------------------------->

<div class="products content-wrapper">
    <h1>Products</h1>
    <p><?=$total_products?> Products</p>
    <div class="products-wrapper">
        <?php foreach ($products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
            <span class="name"><?=$product['name']?></span>
            <span class="price">
                &dollar;<?=$product['price']?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>

</div>

<?=template_footer()?>