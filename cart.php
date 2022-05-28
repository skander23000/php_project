<?php

//////////////////////////////////////////PARTIE AJOUT DES PRODUITS DE LA CARTE////////////////////////////////////////////////////////////////

// Si l'utilisateur a cliqué sur le bouton Ajouter au panier , on vérifie les données du formulaire avec "isset"
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Définissez les variables de publication afin de les identifier facilement, assurez-vous également qu'elles sont entières
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Préparer l'instruction SQL, nous vérifions essentiellement si le produit existe dans notre base de données
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_POST['product_id']]);
    // Récupère le produit de la base de données et renvoie le résultat sous forme de tableau
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Vérifie si le produit existe (le tableau n'est pas vide)
    if ($product && $quantity > 0) {
        // Le produit existe dans la base de données, maintenant nous pouvons créer/mettre à jour la variable de session pour le panier
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Le produit existe dans le panier, il suffit donc de mettre à jour la quantité
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Le produit n'est pas dans le panier alors ajoutez-le
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
           // Il n'y a pas de produits dans le panier, ceci ajoutera le premier produit au panier
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Empêcher la resoumission du formulaire...
    header('location: index.php?page=cart');
    exit;
}
//////////////////////////////////////////////PARTIE SUPRRESSION DES PRODUITS DE LA CARTE///////////////////////////////////////////////////////


// Supprimez le produit du panier, vérifiez le paramètre d'URL "remove", c'est l'identifiant du produit, assurez-vous qu'il s'agit d'un nombre et vérifiez s'il est dans le panier
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Supprimer le produit du panier
    unset($_SESSION['cart'][$_GET['remove']]);
}

//////////////////////////////////Obtenir des produits dans le panier et sélectionner dans la base de données///////////////////////////////////

// Vérifier la variable de session pour les produits dans le panier
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// S'il y a des produits dans le panier
if ($products_in_cart) {
   // Il y a des produits dans le panier, nous devons donc sélectionner ces produits dans la base de données
   // Produits dans le tableau du panier vers le tableau de chaînes de points d'interrogation, nous avons besoin de l'instruction SQL pour inclure IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    // Nous n'avons besoin que des clés du tableau, pas des valeurs, les clés sont les identifiants des produits
    $stmt->execute(array_keys($products_in_cart));
    // Récupère les produits de la base de données et renvoie le résultat sous forme de tableau
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calcule le prix total
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
}
?>

<!------------------------------------------------- LA PARTIE  HTML  DE LA CARTE  ------------------------------------------------------------->

<?=template_header('Cart')?>

<div class="cart content-wrapper">
    <h1>Shopping Cart</h1>
    <form action="index.php?page=cart" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="img">
                        <a href="index.php?page=product&id=<?=$product['id']?>">
                            <img src="imgs/<?=$product['img']?>" width="50" height="50" alt="<?=$product['name']?>">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?page=product&id=<?=$product['id']?>"><?=$product['name']?></a>
                        <br>
                        <a href="index.php?page=cart&remove=<?=$product['id']?>" class="remove">Remove</a>
                    </td>
                    <td class="price">&dollar;<?=$product['price']?></td>

                    <td class="quantity">
                        <?=$products_in_cart[$product['id']]?>
                    </td>

                    <td class="price">&dollar;<?=$product['price'] * $products_in_cart[$product['id']]?></td>

                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">total price</span>
            <span class="price">&dollar;<?=$subtotal?></span>
        </div>

    </form>
</div>

<?=template_footer()?>