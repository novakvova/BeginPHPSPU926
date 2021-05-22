<h2>Список тварин</h2>
<?php
$myPDO = new PDO('mysql:host=localhost;dbname=db_spu926', 'root', '');

$result = $myPDO->query("SELECT `id`,`name`,`image` FROM `animals`");

foreach ($result as $row) {
    print $row['id'] . "\t";
    print $row['name'] . "\t";
    print $row['image'] . "\n";
}

?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
    </tr>
    <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <td colspan="2">Larry the Bird</td>
        <td>@twitter</td>
    </tr>
    </tbody>
</table>