<?php include("./inc/header.php"); ?>
<?php include('./inc/nav.php'); ?>




<?php

    $row = $db->find('employees',$_POST['id']);
 if(isset($_POST['id']) && is_numeric($_POST['id']) && $row) :


 
?>

<?php 
    $departmentes = array("it","cs","com");
    $error = '';
    $success = '';
?>


<?php

    if(isset($_POST['submit']))
    {
         
        foreach($_POST as $key => $value){

            $$key = trim(htmlspecialchars(htmlentities($value)));
        }

        if(empty($name) or empty($email) or empty($department))
        {
            $error = "Please Fill All Fields";
        }
        else 
        {
            if(strlen($name) > 3)
            {
                if(filter_var($email,FILTER_VALIDATE_EMAIL))
                {
                    $department = strtolower($department);
                    if(in_array($department,$departmentes))
                    {
                        if(!empty($password))
                        {
                         
                            if (strlen($password) >= 6) 
                            {
                                $password = $db->encPassword($password); 
                        
                            }
                            else 
                            {
                                $error = "password Must be Grater Than 6 chars !";
                            }

                        }
                        else 
                        {
                            $password = $row['password'];
                         
                        }


                        if(!$error)
                        {
                            // $query = "UPDATE employees SET `name`='$name',`email`='$email',`department`='$department',
                            // `password`='$password' WHERE `id`='$row[id]' ";

                            $query = "UPDATE employees SET name='$name',email='$email',department='$department',
                            password='$password' WHERE id='" . $row['id'] . "' ";
                            
                            $success = $db->update($query); // appear success message if is query true
                        }
                        
                        
                    }
                    else 
                    {
                        $error = "This Department Not Found ";
                    }
                }
                else 
                {
                    $error = "Please Type Valid Email";
                }
            }
            else 
            {
                $error = "name Must be Grater Than 3 chars !";
            }
        }
    }

?>


<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="p-3 col text-center mt-5 text-white bg-primary">  Edit Employee </h2>
        </div>


        <div class="col-sm-12">
            <?php if($error !=''): ?>
            <h2 class="p-2 col text-center mt-5  alert alert-danger"> <?php echo $error; ?>  </h2>
            <?php endif; ?>

            <?php if($success !=''): ?>
            <h2 class="p-2 col text-center mt-5  alert alert-success"> <?php echo $success; ?>  </h2>
            <?php endif; ?>
        </div>
        <div class="col-sm-12">
            <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="<?php echo $row['name']; ?>"   class="form-control" id="name"  placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label for="department">Department</label>
                    <input type="text" name="department" value="<?php echo $row['department']; ?>" class="form-control" id="department"  placeholder="Enter department">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>


                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
            
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>


<?php else: ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="alert alert-danger mt-5 text-center"> Not Found </h3>
            </div>
        </div>
    </div> 
    

<?php  endif;  ?>

<?php include("./inc/footer.php"); ?>



  