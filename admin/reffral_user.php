<?php 
    require "inc/header.php";
    // Get Users
    $id=$_GET['reff'];
    $all_users = get_all_reffral_users($conn,$id)
?>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">

            <div class="card-header">Active Users</div>
            <div class="table-responsive">
                <table id="example"
                    class="table table-hover responsive nowrap align-middle mb-0 table table-borderless table-striped table-hover"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Task Completion</th>
                            <th>Reffral</th>
                          
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($all_users != 'no_user'){
                            while($row = $all_users->fetch_assoc()){
                                $id=$row['u_id'];
                            ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <p class="text-muted mb-0"><?php echo $row['u_email']; ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo get_user_task_stats($conn,$id); ?>%</td>
                            
                                <td>
                                    <div class="badge badge-success badge-success-alt">(<?php echo get_user_reffrals($conn,$id); ?>) Reffrals</div>
                                </td>
                                <td>
                                
                                <button type="button" class="btn mr-2 mb-2 btn-primary getUserDetails" data-userid="<?php echo $row['u_id']; ?>" >Details</button>
                                </td>
                            </tr>
                            <?php
                        }} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require "inc/footer.php"; ?>