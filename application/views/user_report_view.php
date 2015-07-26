
 <div id="page-wrapper">
 
         
        
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User Report</h1>
                    </div>
                    <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4> <strong>Report of</strong> <?php echo $user['name'];?> 
                           <!--  <div style = "position:relative;left:80%;"> -->
                            <strong>FROM:</strong><?php echo $start_date;?>
                            <strong>TO:</strong> <?php echo $end_date;?>
                            <!-- </div> -->
                            </h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
        
                        <div class = "col-lg-4">
                           <img id ="dp" src="<?php echo base_url();?>uploads/<?php if($user['avatar'])
                           echo $user['avatar']; else echo "default.png"?>" class="img-defautl" alt="" height="120" width="120" style="">
                           <br>
                           <br>
                           
                            
                            


 
                        </div>
                        <br>
                        <div class="col-lg-4">
                        <p><strong>NAME: </strong> <?php echo $user['name']?></p>
                        <p><strong>UserId: </strong> <?php echo $user['user_id']?></p>
                        <p><strong>Email:</strong> <?php echo $user['email']?></p>
                        <p><strong>Department:</strong> <?php echo $user['department']?></p>
                        <p><strong>Mobile:</strong> <?php echo $user['mobile']?></p>
                        <p><strong>Phone:</strong> <?php echo $user['phone']?></p>
                        <p><strong>Gender:</strong> <?php if($user['gender']=='m') echo "male";else echo "female";?></p>
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

                        <?php
                        $base = base_url();
                        // require("$base.'pdf_php/fpdf.php'");?>
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
    
    <script type="text/javascript">
   // $('.present_date').val(new Date().toDateInputValue());
        $('.tasks').click(function(e){
            /*return false;*/
            //console.log('click');
            var task_id = $(this).attr('href');
            //console.log(task_id);
            $('#task_desc').html(task_id);

            return false;
            
        });
        var toggle = [];
        var toggle2 = [];
        $(function(e){
            var tasks = <?php echo json_encode($tasks);?>;
            var projects = <?php echo json_encode($projects);?>;
        for (var i = tasks.length - 1; i >= 0; i--) {
            toggle[tasks[i]['task_id']] = false;
        };
        for (var i = 0; i < projects.length; i++) {
            toggle2[projects[i]['project_id']] = false;
        };
        console.log(toggle2);
        });

        $('.tasks').dblclick(function(e){
            console.log("dbl");
            var task_id = $(this).attr('name');
            if(!toggle[task_id])
                $('#bt_'+task_id).show();
            else
                $('#bt_'+task_id).hide();
            toggle[task_id] = !toggle[task_id];
        });
        $('.projects').dblclick(function(e){
            console.log('dblclick_projects');
            var project_id = $(this).attr('name');
            //console.log(project_id);pro_bt_
            if(!toggle2[project_id])
                $('#pro_bt_'+project_id).show();
            else
                $('#pro_bt_'+project_id).hide();
            toggle2[project_id] = !toggle2[project_id];

        });
        $('.projects').click(function(e){
            /*return false;*/
            console.log('click');
            var task_id = $(this).attr('href');
            //console.log(task_id);
            $('#task_desc').html(task_id);

            return false;
        });
        $('.mark_done').click(function(e){
            var task_id = $(this).attr('href');
            console.log(task_id);

            base_url = "<?php echo base_url()?>";
            url = base_url+"dashboard/mark_task_done";
            var date = $('#p_date').val();
            console.log(date);
            var d = {task_id: task_id, date: date}; 
            $.getJSON(url,d ,function(data){
            console.log(data);
            if(data.v){
                 console.log('sucess');
                 $('#status_'+task_id).html('<i class="fa fa-check fa-fw"></i>');
                 $('#status2_'+task_id).html('<i class="fa fa-check fa-fw"></i>');
                 $('#bt_'+task_id).hide();
                 toggle[task_id] = !toggle[task_id];
            }
            else{
                console.log('false');
            }
            });
        });
        $('.mark_undone').click(function(e){
            var task_id = $(this).attr('href');
            console.log(task_id);

            base_url = "<?php echo base_url()?>";
            url = base_url+"dashboard/mark_task_undone/"+task_id;
            $.getJSON(url, function(data){
            console.log(data);
            if(data.v){
                 console.log('sucess');
                 $('#status_'+task_id).html('<i class="fa fa-times fa-fw"></i>');
                 $('#status2_'+task_id).html('<i class="fa fa-times fa-fw"></i>');
                 $('#bt_'+task_id).hide();
                 toggle[task_id] = !toggle[task_id];
            }
            else{
                console.log('false');
            }
            });
        });
        $('.tasks').hover(function(e){
            console.log('HOVER');
            $('#task_notification').html('Double Click to mark Done or Undone!');
            $('#task_notification').show();
        },function(e){
            console.log('HOVER_GONE');
             $('#task_notification').hide();
        });
        $('.projects').hover(function(e){
            console.log('HOVER');
            $('#project_notification').html('Double Click to View Tasks!');
            $('#project_notification').show();
        },function(e){
            console.log('HOVER_GONE');
             $('#project_notification').hide();
        });
    </script>

</body>

</html>
