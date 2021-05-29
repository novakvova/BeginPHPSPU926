<?php
     
    include 'database.php';
    if ( !empty($_POST)) {
        // keep track validation errors
        $errors = array();

        // keep track post values
        $name = htmlspecialchars($_POST['name']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $email = htmlspecialchars($_POST['email']);
        $mobile = htmlspecialchars($_POST['mobile']);
         
        if (empty($name)) {
            $errors["nameError"] = 'Please enter Name';
        }
        if(empty($last_name)){
            $errors["last_nameError"] = 'Please enter Last name';
        }        
        if (empty($email)) {
            $errors["emailError"] = 'Please enter Email Address';
        } 
        if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $errors["emailError"] = 'Please enter a valid Email Address';
        }
         
        if (empty($mobile)) {
            $errors["mobileError"] = 'Please enter Mobile Number';
        }

        // insert data
        if (count($errors)==0) {
            $pdo = Database::connect();
            $sql = "INSERT INTO customers (name, last_name, email, mobile) values(?, ?, ?, ?)";
            $stmt = new mysqli_stmt($pdo, $sql);       
            $stmt->bind_param('ssss', $name, $last_name, $email, $mobile);
            $stmt->execute();
            $stmt->close();
            Database::disconnect();
            header("Location: index.php");
        }
    }
?>
 
<?php require_once "_header.php"; ?>

<div class="container">
     
     <div class="span10 offset1">
        <div class="row">
            <div class="alert alert-success" role="alert">
                <h3>Create a Customer</h3>
            </div>
        </div>
  
         <form class="form-horizontal" method="post">
            <div class="form-group col-md-6">
                <label for="inputName">Name:</label>
                <input type="text" class="form-control" name="name" id="inputName" value=<?php echo !empty($name)?$name:'';?>>
                <?php if (!empty($errors["nameError"])): ?>
                    <span class="help-inline"><?php echo $errors["nameError"];?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group col-md-6">
                <label for="inputName">Last name:</label>
                <input type="text" class="form-control" name="last_name" id="inputName" value=<?php echo !empty($last_name)?$last_name:'';?>>
                <?php
                if (!empty($errors["last_nameError"])) {
                    echo "<span class='help-inline'>{$errors["last_nameError"]}</span>";
                }
                ?>
            </div>
            
            <div class="form-group col-md-6">
                <label for="inputEmail">Email:</label>
                <input type="text" class="form-control" name="email"id="inputEmail" value=<?php echo !empty($email)?$email:'';?>>
                <?php if (!empty($errors["emailError"])): ?>
                    <span class="help-inline"><?php echo $errors["emailError"];?></span>
                <?php endif; ?>
            </div>

            <div class="form-group col-md-6">
                <label for="inputMobilePhone">Mobile number:</label>
                <input type="text" class="form-control" name="mobile"id="inputMobilePhone" value=<?php echo !empty($mobile)?$mobile:'';?>>
                <?php if (!empty($errors["mobileError"])): ?>
                    <span class="help-inline"><?php echo $errors["mobileError"];?></span>
                <?php endif; ?>
            </div>  
           <div class="form-actions">
               <button type="submit" class="btn btn-success">Create</button>
               <a class="btn btn-info" href="/">Back</a>
             </div>
         </form>
     </div>
      
    </div>
  </body>
</html>
