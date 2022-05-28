<?php

if(isset($_POST['add']))
{
$name = $_POST['name'];
$desc = $_POST['desc'];
$price=$_POST['price'];
$quantity = $_POST['quantity'];
$img = $_POST['img'];
$date_added= $_POST['date_added'];

$sql = "INSERT INTO products (name, desc, price, quantity, img, date_added)  VALUES (:name, :desc, :price, :quantity, :img, :date_added)";

$stmt = $pdo->prepare($sql);

$stmt->execute([':name' => $name,':desc' => $desc,':price' => $price,':quantity' => $quantity,':img' => $img,':date_added' => $date_added]);

}
?>
<!------------------------------------------------- LA PARTIE  HTML/CSS  DU NEW_PRODUIT  ------------------------------------------------------->

<?=template_header('Cart')?>
<style>
label {
    width: 100px;
    display: inline-block;
}

input[type="submit"] {
    background: #4e5c70;
    border: 0;
    color: #ffffff;
    width: 200px;
    padding: 8px 0;
    margin: 8px;
    text-transform: uppercase;
    font-size: 14px;
    font-weight: bold;
    border-radius: 5px;
}
</style>

<div class="add_product" style="margin:20px;">
    <form method="post" action="index.php?page=new_product">
        <center>
            <table width="50%" border=1 cellpadding=5 cellspacing=0 style="margin-bottom:10px;">
                <tr>
                    <td>
                        <center>NEW PRODUCT</center>
                    </td>
                </tr>
            </table>
            <table width="50%" border="1" cellpadding=10 cellspacing=0>
                <tr>
                    <td>
                        <center>

                            <label>name:</label>
                            <input type="text" name="name"></br><br>
                            <label>desc:</label>
                            <input type="text" name="desc"></br><br>
                            <label>price:</label>
                            <input type="text" name="price"></br><br>
                            <label>quantity:</label>
                            <input type="text" name="quantity"></br><br>
                            <label>image:</label>
                            <input type="text" name="img"></br><br>
                            <label>date:</label>
                            <input type="datetime-local" name="date_added"></br><br>
                            <input type="submit" name="add" value="add">
                        </center>

                    </td>
                </tr>
            </table>
        </center>
    </form>
</div>



<?=template_footer()?>