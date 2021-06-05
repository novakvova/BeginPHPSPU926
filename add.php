<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    <div class="col-md-12">
        <label for="name" class="form-label">Назва</label>
        <input type="text" class="form-control" id="name" name="name">
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-md-12">
        <label for="image" class="form-label">Фото</label>
        <img src="/img/no-image.png" width="250" alt="Обране фото" id="imgSelect" style="cursor: pointer;">
        <!--        <input type="text" class="form-control" id="image" name="image">-->
    </div>

    <div class="col-12">
        <button class="btn btn-primary" type="submit">Додати тварину</button>
    </div>
</form>

</div>
<?php include "modal.php"; ?>

<script src="/js/jquery-3.6.0.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/cropper.min.js"></script>

<script>
    $(function () {

        const image = document.getElementById('image-modal');
        const cropper = new Cropper(image, {
            aspectRatio: 1 / 1
        });

        let $uploader;
        $("#imgSelect").on("click", function () {
            $uploader = $('<input type="file" accept="image/*" style="display: none;"/>');
            $uploader.click();
            $uploader.on("change",function() {
                const [file] = $uploader[0].files

                if (file) {
                    var reader  = new FileReader();
                    reader.onload = function(event)
                    {
                        var data = event.target.result;
                        //console.log("-------data-----",data);
                        $("#croppedModal").modal("show");
                        cropper.replace(data);
                    }
                    reader.readAsDataURL($uploader[0].files[0]);
                }
            });

        });

        $("#btnCropped").on("click", function() {
            var dataCropper = cropper.getCroppedCanvas().toDataURL();
            $("#imgSelect").attr("src", dataCropper);
            $("#croppedModal").modal("hide");
        });
    });

</script>

</body>
</html>