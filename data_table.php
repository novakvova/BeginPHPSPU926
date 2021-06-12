<h2>Список тварин</h2>

<a href="/add.php" class="btn btn-danger">Додати</a>

<?php
include "connection_database.php";

$page = 1;
if(isset($_GET["page"]))
    $page=$_GET["page"];
$show_item = 3;
$sql = "SELECT COUNT(*) as count FROM `animals`";

$command = $myPDO->prepare($sql);
$command->execute();
$row = $command->fetch(PDO::FETCH_ASSOC);
$cout_items=$row["count"];
$count_pages= ceil($cout_items/$show_item);
echo"<h1>$count_pages</h1>";

$result = $myPDO->query("SELECT `id`,`name`,`image` FROM `animals` LIMIT ".($page-1)*$show_item.", ".$show_item);

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
                echo "<li class='page-item {$active}'><a class='page-link' href='?page={$i}'>{$i}</a></li>";
            }

            if($page>=9)
            {
                if($i<=3) {
                    echo "<li class='page-item {$active}'><a class='page-link' href='?page={$i}'>{$i}</a></li>";
                }
                else if($i==4) {
                    echo "<li class='page-item'><a class='page-link' href='?page={$i}'>...</a></li>";
                }
                else if(($page-4)<=$i && $i<=($page+5)) {
                    echo "<li class='page-item {$active}'><a class='page-link' href='?page={$i}'>{$i}</a></li>";
                }
            }

            //echo "<li class='page-item $active'><a class='page-link' href='?page=$i'>$i</a></li>";
        }
        if(($page+6)<$i) {
            $i--;
            echo "<li class='page-item'><a class='page-link' href='?page={$i}'>...</a></li>";
            echo "<li class='page-item'><a class='page-link' href='?page={$i}'>$i</a></li>";
        }
        ?>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>