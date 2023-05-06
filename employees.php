<?php include("./inc/header.php"); ?>
<?php include('./inc/nav.php'); ?>




<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="p-3 col text-center mt-5 text-white bg-primary">  All Employees </h2>
        </div>

        <?php if(count($db->read("employees"))): ?>

        <div class="col-sm-12">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    

                    <?php foreach($db->read("employees") as $row): ?>
                        <tr>
                            <td><?php echo strtoupper($row['name']);  ?></td>
                            <td><?php echo $row['email'];  ?></td>
                            <td><?php echo strtoupper($row['department']);  ?></td>

                       
                            
                            <td>
                                    <form method="POST" action="editEmployee.php">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="btn btn-link text-primary">
                                            <i class="fa fa-pencil-square-o fa-2x"></i>
                                        </button>
                                    </form>
                            </td>
                        

                            <td>

                                <form method="POST" action="deleteEmployee.php">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="btn btn-link text-danger">
                                        <i class="fa fa-times fa-2x"></i>
                                    </button>
                                </form>

                            </td>

                          


                        </tr>
                    <?php endforeach; ?>
                    
                </tbody>
            </table>
        </div>

        <?php else: ?>

            <div class="col-sm-12">
                <h3 class="alert alert-danger mt-5 text-center"> Not Found Data </h3>
            </div>

        <?php endif; ?>
        
        
        
    </div>
</div>


<?php include("./inc/footer.php"); ?>



  