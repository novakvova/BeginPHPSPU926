<h2>Список тварин</h2>

<a href="/add.php" class="btn btn-danger">Додати</a>

<?php
$myPDO = new PDO('mysql:host=localhost;dbname=db_spu926', 'root', '');

$result = $myPDO->query("SELECT `id`,`name`,`image` FROM `animals`");

?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Image</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($result as $row) {
    echo "
    <tr>
        <th scope='row'>{$row['id']}</th>
        <td>{$row['name']}</td>
        <td><img src='/img/{$row['image']}' width='100'></td>
    </tr>
    ";
    }

    ?>

    </tbody>
</table>