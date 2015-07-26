
 <div id="page-wrapper">
 
         
        
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Project Report</h1>
                    </div>
                    <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4> <strong>Report of</strong> <?php echo $project['name'];?> 
                           <!--  <div style = "position:relative;left:80%;"> -->
                            <strong>FROM:</strong><?php echo $start_date;?>
                            <strong>TO:</strong> <?php echo $end_date;?>
                            <!-- </div> -->
                            </h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
        
                       
                        <br>
                        <div class="col-lg-4">
                        <p><strong>Project Name: </strong> <?php echo $project['name']?></p>
                        <p><strong>Start Date: </strong> <?php echo $project['start_date']?></p>
                        <p><strong>End Date:</strong> <?php echo $project['end_date']?></p>
                        <p><strong>Budget:</strong> <?php echo $project['budget']?></p>
                        <!-- <p><strong>Mobile:</strong> <?php echo $user['mobile']?></p>
                        <p><strong>Phone:</strong> <?php echo $user['phone']?></p>
                        <p><strong>Gender:</strong> <?php if($user['gender']=='m') echo "male";else echo "female";?></p> -->
                        </div>
                        
                        <div class="col-lg-4">
                         <div class="panel panel-default">
                         <div class="panel-heading">
                             Tasks Completed
                         </div>
                         <div class="panel-body" id="task_desc">
                          <div class="list-group">
                        <?php foreach($tasks as $task):?>
                        <div class="list-group-item">
                   			<?php echo $task['name'];?>
                        
                         <span class="pull-right text-muted small"><em id="status2_<?php echo $task['task_id'];?>">
                          	<?php if($task['status'] == 'F'){?>
                            <i class="fa fa-check fa-fw"></i> 
                            <?php }else{?>
                            <i class="fa fa-times fa-fw"></i> 
                            <?php }?>
                            </em>
                         </span>
                        </div>
                    	<?php endforeach;?>
                    	</div>   
                             
                         </div>
                         </div>                        
                    	</div>
                        
                        
                        <div class="col-lg-4">
                         <div class="panel panel-default">
                         <div class="panel-heading">
                             Project Description
                         </div>
                         <div class="panel-body" id="task_desc">
                          <div class="list-group">
                            <?php echo $project['description']; ?>
                        </div>   
                             
                         </div>
                         </div>                        
                        </div>

                    </div>
                    <!-- /.panel -->
                    </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                    
                   
                     
            <?php
            $base_url = base_url();
            //require_once($base_url+'/pdf_php/fpdf.php');
            ?>
                     
                     
               
                <!-- /.row -->
                </div>
                        
                </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url();?>/include_files/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>/include_files/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>/include_files/bower_components/metisMenu/dist/metisMenu.min.js"></script>
     <!-- ckeditor -->
   
    
    <!-- ckeditor -->
    
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>/include_files/dist/js/sb-admin-2.js"></script>
    <style type="text/css">
    .show
    {
        display: inline-block;
    }
    </style>
    
    

</body>

</html>
