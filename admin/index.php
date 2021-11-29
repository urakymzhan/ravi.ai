<?php 
    require "inc/header.php";
    $user_count = get_total_user($conn);  
    $reffral_count = get_total_reffral($conn);  
    $total_amount=get_total_amount($conn);
    // Get Task Statistics
    $task_one_stats=round((task_one_stats($conn)/$user_count)*100);
    $task_two_stats=round((task_two_stats($conn)/$user_count)*100);
    $task_three_stats=round((task_three_stats($conn)/$user_count)*100);
    $task_four_stats=round((task_four_stats($conn)/$user_count)*100);
    // Get Users
    $all_users = get_all_users($conn)
?>

<div class="row">
    <div class="col-md-6 col-xl-4">
        <div class="card mb-3 widget-content bg-midnight-bloom">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Users</div>
                    <div class="widget-subheading">All time register</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span><?php echo $user_count; ?></span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="card mb-3 widget-content bg-arielle-smile">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Reffrals</div>
                    <div class="widget-subheading">All time register</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span><?php echo $reffral_count; ?></span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="card mb-3 widget-content bg-grow-early">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Payments</div>
                    <div class="widget-subheading">All payments</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>$ <?php echo $total_amount; ?></span></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-title">
            Task Completion
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-left card">
            <div class="widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left pr-2 fsize-1">
                            <div class="widget-numbers mt-0 fsize-3 text-danger"><?php echo $task_one_stats; ?>%</div>
                        </div>
                        <div class="widget-content-right w-100">
                            <div class="progress-bar-xs progress">
                                <div class="progress-bar bg-danger" role="progressbar"
                                    aria-valuenow="<?php echo $task_one_stats; ?>" aria-valuemin="0" aria-valuemax="100"
                                    style="width: <?php echo $task_one_stats; ?>%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content-left fsize-1">
                        <div class="text-muted opacity-6">Avg. Users Registration</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card-shadow-success mb-3 widget-chart widget-chart2 text-left card">
            <div class="widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left pr-2 fsize-1">
                            <div class="widget-numbers mt-0 fsize-3 text-success"><?php echo $task_two_stats; ?>%</div>
                        </div>
                        <div class="widget-content-right w-100">
                            <div class="progress-bar-xs progress">
                                <div class="progress-bar bg-success" role="progressbar"
                                    aria-valuenow="<?php echo $task_two_stats; ?>" aria-valuemin="0" aria-valuemax="100"
                                    style="width: <?php echo $task_two_stats; ?>%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content-left fsize-1">
                        <div class="text-muted opacity-6">Avg. Users Share</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card-shadow-warning mb-3 widget-chart widget-chart2 text-left card">
            <div class="widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left pr-2 fsize-1">
                            <div class="widget-numbers mt-0 fsize-3 text-warning"><?php echo $task_three_stats; ?>%
                            </div>
                        </div>
                        <div class="widget-content-right w-100">
                            <div class="progress-bar-xs progress">
                                <div class="progress-bar bg-warning" role="progressbar"
                                    aria-valuenow="<?php echo $task_three_stats; ?>" aria-valuemin="0"
                                    aria-valuemax="100" style="width: <?php echo $task_three_stats; ?>%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content-left fsize-1">
                        <div class="text-muted opacity-6">Avg. Users Fill Form</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card-shadow-info mb-3 widget-chart widget-chart2 text-left card">
            <div class="widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left pr-2 fsize-1">
                            <div class="widget-numbers mt-0 fsize-3 text-info"><?php echo $task_four_stats; ?>%</div>
                        </div>
                        <div class="widget-content-right w-100">
                            <div class="progress-bar-xs progress">
                                <div class="progress-bar bg-info" role="progressbar"
                                    aria-valuenow="<?php echo $task_four_stats; ?>" aria-valuemin="0"
                                    aria-valuemax="100" style="width: <?php echo $task_four_stats; ?>%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content-left fsize-1">
                        <div class="text-muted opacity-6">Avg. Users Payment Completed</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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