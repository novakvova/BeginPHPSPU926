<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    echo "<h3>Зберігаємо в БД</h3>";

    $name = $_POST['name'];
    $image = $_POST['image'];
    $myPDO = new PDO('mysql:host=localhost;dbname=db_spu926', 'root', '');
    $sql = "INSERT INTO `animals` (`name`, `image`) VALUES (?, ?);";
    $myPDO->prepare($sql)->execute([$name, $image]);
    //echo $name.'    '.$image.'<br/>';
    header('Location: /');
    exit;
}
?>

<?php include 'head.php'; ?>

<h1>Додати тварину</h1>

<form class="row g-3 needs-validation" novalidate method="post">
    <div class="col-md-4">
        <label for="name" class="form-label">Назва</label>
        <input type="text" class="form-control" id="name" name="name">
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-md-8">
        <label for="image" class="form-label">Фото</label>
        <input type="text" class="form-control" id="image" name="image">
    </div>

    <div class="col-12">
        <button class="btn btn-primary" type="submit">Додати тварину</button>
    </div>
</form>

</div>
</body>
</html>