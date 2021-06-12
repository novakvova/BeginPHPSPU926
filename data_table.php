<?php
$name="";
if(isset($_GET["name"]))
{
    $name=$_GET["name"];
}
?>


<form method="get">
    <div class="mb-3">
        <label for="name" class="form-label">Назва</label>
        <input type="text" class="form-control" id="name"
               value="<?php echo $name; ?>"
               name="name">
    </div>

    <button type="submit" class="btn btn-primary">Шукать</button>

</form>

<h2>Список тварин</h2>

<a href="/add.php" class="btn btn-danger">Додати</a>

<?php
include "connection_database.php";

$page = 1;
if(isset($_GET["page"]))
    $page=$_GET["page"];
$show_item = 3;
$where = "where name LIKE :name";
$sql = "SELECT COUNT(*) as count FROM `animals` ".$where;

$command = $myPDO->prepare($sql);
$command->execute(["name"=> '%'.$name.'%']);
$row = $command->fetch(PDO::FETCH_ASSOC);
$cout_items=$row["count"];
$count_pages= ceil($cout_items/$show_item);
echo"<h1>$count_pages</h1>";

$command = $myPDO->prepare("SELECT `id`,`name`,`image` FROM `animals` ".$where." LIMIT ".($page-1)*$show_item.", ".$show_item);
$command->execute(["name"=> '%'.$name.'%']);
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

    while ($row = $command->fetch(PDO::FETCH_ASSOC)) {
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

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php
        $show_begin=13;
        for($i=1;$i<=$count_pages;$i++)
        {
            $active ="active";
            if($i!=$page)
                $active = "";
            if($page<=8 and $i<=$show_begin)  {
                echo "<li class='page-item {$active}'><a class='page-link' href='?page={$i}&name={$name}'>{$i}</a></li>";
            }

            if($page>=9)
            {
                if($i<=3) {
                    echo "<li class='page-item {$active}'><a class='page-link' href='?page={$i}&name={$name}'>{$i}</a></li>";
                }
                else if($i==4) {
                    echo "<li class='page-item'><a class='page-link' href='?page={$i}&name={$name}'>...</a></li>";
                }
                else if(($page-4)<=$i && $i<=($page+5)) {
                    echo "<li class='page-item {$active}'><a class='page-link' href='?page={$i}&name={$name}'>{$i}</a></li>";
                }
            }

            //echo "<li class='page-item $active'><a class='page-link' href='?page=$i'>$i</a></li>";
        }
        if(($page+6)<$i) {
            $i--;
            echo "<li class='page-item'><a class='page-link' href='?page={$i}&name={$name}'>...</a></li>";
            echo "<li class='page-item'><a class='page-link' href='?page={$i}&name={$name}'>$i</a></li>";
        }
        ?>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>