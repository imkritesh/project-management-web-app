
 <div id="page-wrapper">
 <?php
        @session_start(); 
        //echo "yoo";
        if(!empty( $this->session->userdata('upload_error')))
        {
        $error_msg = $this->session->userdata('upload_error');
        $this->session->unset_userdata('upload_error');
        }
        if(!empty( $this->session->userdata('upload_sucess')))
        {
        $sucess_msg = $this->session->userdata('upload_sucess');
        $this->session->unset_userdata('upload_sucess');
        }
        ?>
         <div id="s-alert" class="col-lg-9 alert alert-success alert-dismissable" role="alert" style="display:
         <?php if(!isset($sucess_msg)) echo "none";?>">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:
        </span>
        <?php if(isset($sucess_msg))echo $sucess_msg;?>        
        </div>
        <div class="col-lg-9 alert alert-danger alert-dismissable" role="alert" style="display:
        <?php if(!isset($error_msg)) echo "none";?>">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        <?php if(isset($error_msg))echo $error_msg;?>
        </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">DASHBOARD</h1>
                    </div>
                    <div class="col-lg-4">
                         <div class="panel panel-default">
                         <div class="panel-heading">
                            <i class="fa fa-folder fa-fw"></i> My Projects
                        </div>
                         <div class="panel-body">
                          <div class="list-group">
                          <?php foreach($projects as $project):?>
                                <a href="<?php echo $project['desc']?>" class="list-group-item projects" name=<?php echo $project['project_id'];?>>
                                    <i class="fa fa-tag fa-fw"></i> 
                                    <?php echo $project['name'];?>
                                    <span class="pull-right text-muted small"><em><?php echo $project['start_dt']?></em>
                                    </span>
                                </a>
                                <div class="list-group-item" id="pro_bt_<?php echo $project['project_id'];?>" style="display:none">
                                <?php foreach($all_tasks as $task):?>
                                    <?php if($task['project_id'] == $project['project_id']){?>
                                        <div class="list-group-item">
                                             <i class="fa fa-tasks fa-fw"></i> 
                                             <?php echo $task['name']?>
                                              <span class="pull-right text-muted small"><em id="status2_<?php echo $task['task_id'];?>">
                                              <?php if($task['status'] == 'F'){?>
                                                <i class="fa fa-check fa-fw"></i> 
                                                <?php }else{?>
                                                <i class="fa fa-times fa-fw"></i> 
                                                <?php }?>
                                              </em>
                                              </span>
                                        </div>
                                     <?php }// endelse;?> 
                                <?php endforeach;?>
                                </div>
                            <?php endforeach?>
                          </div>
                            <div id="project_notification" style="width:100%;display:none"class="alert alert-success" role="alert">
                            </div>
                         </div>
                         </div>
                    </div>
                    <!-- project ends -->
                    <div class="col-lg-4">
                         <div class="panel panel-default">
                         <div class="panel-heading">
                             Description
                         </div>
                         <div class="panel-body" id="task_desc">
                             
                         </div>
                         </div>
                     </div>
                     <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-folder fa-fw"></i> Tasks Assigned To me
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        
                            <div class="list-group">
                                
                                <?php foreach($tasks as $task):?>
                                <a href="<?php echo $task['desc'];?>" class="list-group-item tasks" name="<?php echo $task['task_id'];?>">
                                    <i class="fa fa-tasks fa-fw"></i> 
                                    <?php echo $task['name'];
                                    ?>

                                    <span class="pull-right text-muted small"><em id="status_<?php echo $task['task_id'];?>">
                                    <?php //echo $task['desc'];?>
                                    <?php if($task['status'] == 'F'){?>
                                     <i class="fa fa-check fa-fw"></i> 
                                     <?php }
                                     else{?> 
                                     <i class="fa fa-times fa-fw"></i> 
                                     <?php }// endelse;?>

                                    </em>
                                    </span>
                                </a>
                                <div class="list-group-item" id="bt_<?php echo $task['task_id'];?>" style="display:none">
                                    <button type="button" class="btn-xs btn-success mark_done" href="<?php echo $task['task_id'];?>" name="<?php echo $task['task_id'];?>">
                                    <i class="fa fa-check fa-fw"></i>
                                    Mark Done</button>
                                    <button type="button" class="btn-xs btn-danger mark_undone" href="<?php echo $task['task_id'];?>" name="<?php echo $task['task_id'];?>">
                                    <i class="fa fa-times fa-fw"></i>
                                    Mark Undone</button>
                                </div>
                            <?php endforeach?>
    
                               <input style="display:none" type="date" id="p_date"value="<?php echo date('Y-m-d'); ?>" />
                            </div>
                            <!-- /.list-group -->
                            <!-- <a href="#" class="btn btn-default btn-block">View All Alerts</a> -->
                            <div id="task_notification" style="width:100%;display:none"class="alert alert-success" role="alert">
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
               
                     </div>
            
                     
                     
               
                <!-- /.row -->
                </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                 <div class="panel-heading">
                      <i class="fa fa-book fa-fw"></i> Generate Report of A user
                 </div>
                 <div class="panel-body">
                    <div class="form-horizontal">
                    <?php echo form_open("dashboard/reportUser"); ?>
                    <div id="signupalert" style="<?php if(!validation_errors()) echo 'display:none';?>" class="alert alert-danger"> 
                    <?php if($x === 0) echo validation_errors();?>
                   
                    </div>
                        <div class="form-group">
                                <label for="start_date" class="col-md-3 control-label">Start Date</label>
                                <div class="col-md-9">
                                <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo date('Y-m-d');?>">
                                </div>
                        </div> 
                        <div class="form-group"><!--  -->
                                <label for="end_date" class="col-md-3 control-label">End Date</label>
                                <div class="col-md-9">
                                <input type="date" class="form-control" id="end_date" name="end_date"  value="<?php echo date('Y-m-d');?>">
                                </div>
                            </div> 
                            <?php $dp_mapping = array();?>
                         <div class="form-group">
                            <label for="user_id" class="col-md-3 control-label">Users</label>
                            <div class="col-md-9">
                            <select class="form-control" name="user_id" id="sel1">
                            <?php foreach($users as $user):?>
                            <option value="<?php echo $user['user_id'];?>"><?php echo $user['user_name'];?></option>
                            <?php $dp_mapping[$user['user_id']] = $user['avatar'];?>
                            <?php endforeach?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- Button -->
                                <div class="col-sm-12 controls">
                                <input type="submit" id="btn-project"  class="btn btn-danger btn-block" value="Generate Report">                                     
                                </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    </div>
                     
                 </div>
                 </div>   
                 <div class="col-lg-6">
                    <div class="panel panel-default">
                 <div class="panel-heading">
                      <i class="fa fa-book fa-fw"></i> Generate Report of A Project
                 </div>
                 <div class="panel-body">
                    <div class="form-horizontal">
                    <?php echo form_open("dashboard/reportProject"); ?>
                    <div id="signupalert" style="<?php if(!validation_errors()) echo 'display:none';?>" class="alert alert-danger"> 
                    <?php if($x === 1) echo validation_errors();?>
                    </div>
                        <div class="form-group">
                                <label for="start_date" class="col-md-3 control-label">Start Date</label>
                                <div class="col-md-9">
                                <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo date('Y-m-d');?>">
                                </div>
                        </div> 
                        <div class="form-group"><!--  -->
                                <label for="end_date" class="col-md-3 control-label">End Date</label>
                                <div class="col-md-9">
                                <input type="date" class="form-control" id="end_date" name="end_date"  value="<?php echo date('Y-m-d');?>">
                                </div>
                            </div> 
                         <div class="form-group">
                            <label for="project_id" class="col-md-3 control-label">Users</label>
                            <div class="col-md-9">
                            <select class="form-control" name="project_id" id="sel1">
                            <?php foreach($projects as $project):?>
                            <option value="<?php echo $project['project_id'];?>"><?php echo $project['name'];?></option>
                            <?php endforeach?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- Button -->
                                <div class="col-sm-12 controls">
                                <input type="submit" id="btn-project"  class="btn btn-danger btn-block" value="Generate Report">                                     
                                </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    </div>

                     
                 </div>
                 </div>  
                 <div class="col-lg-3" id="chat-box">
                 <div class="chat-panel panel panel-default">
                        <div class="panel-heading" id="chat-button">
                       
                        <i class="fa fa-comments fa-fw"></i>
                            Chat                   
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div  id="chat-content">
                        <div class="panel-body" id="chat-holder"> 
                            <ul class="chat" id="chat-body">
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 12 mins ago
                                            </small>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                               
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <div class="input-group">
                                <input id="chat-text" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="chat-send">
                                        Send
                                    </button>
                                </span>
                            </div>
                        </div>
                        </div> <!-- extra div -->
                        <!-- /.panel-footer -->
                    </div>
                     
                 </div> 
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
    
    #chat-box
    {
        position: fixed;
        bottom: 0;
        right: 0;
        max-width: 100%;
        max-height: 100%;
        
    }
    #chat-button
    {
        color: rgb(255,0,50);
    }
    </style>
    
    <script type="text/javascript">
   // $('.present_date').val(new Date().toDateInputValue());
         var base_url = "<?php echo base_url();?>";
         var dp_mapping = <?php echo json_encode($dp_mapping);?>;
         console.log(dp_mapping);
        $('#chat-body').html('');
        $('#chat-content').hide();
        var chat_id = 0;
        var chat_show = true;
        (function poll() {
            var url = base_url+"dashboard/get_messages";
        $.ajax({
            url: url,
            type: "POST",
            data: { chat_id : chat_id},
            success: function(data) {
                console.log("polling");
                if(data.length > 0)
                    update(data);
            },
            dataType: "json",
            complete: setTimeout(function() {poll()}, 500),
            timeout: 500
        })
    })();
        function update(data){
            console.log('update');
            //console.log(data);
            //$('#chat-body').html('');
            for (var i = 0; i < data.length; i++) {
               
            //var url = base_url+"dashboard/get_messages";
                var dp = base_url+"uploads/";
                if(dp_mapping[data[i]['user_id']] != null)
                    dp += dp_mapping[data[i]['user_id']];
                else
                    dp += "default.png";
                console.log(dp);
               var v1 ='<li class="left clearfix"><span class="chat-img pull-left"><img src="'+ dp +' " alt="" class="img-circle" hieght="30px" width="30px"/></span>';
               var v2 ='<div class="chat-body clearfix"><div class="header"><strong class="primary-font">';
               //Jack Sparrow
               var v3 ='</strong><small class="pull-right text-muted"><i class="fa fa-clock-o fa-fw"></i>';
               //12 mins ago
               var v4 ='</small></div><p>';
               //Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                 var v5='</p></div></li>';
                $('#chat-body').append(v1 + v2 + data[i]['user_id'] + v3 + data[i]['posted_on'] +v4+ data[i]['msg']+ v5);
                  $('#chat-body').animate({scrollTop: $('#chat-body').prop("scrollHeight")}, 500);
                  chat_id = data[i]['chat_id'];
            };
        }
        $('#chat-button').click(function(e){
            console.log('chat-click');
            if(!chat_show)
                $('#chat-content').hide();
            else
                 $('#chat-content').show();
             chat_show = !chat_show;
        });
        $('#chat-send').click(function(e){
            console.log('chat-send');
            var msg = $('#chat-text').val();
            $('#chat-text').val('');
            console.log(msg);
            base_url = "<?php echo base_url();?>";
            url = base_url+"dashboard/chat_msg";
            $.post(url,{msg:msg},function(data,status){
                console.log(data+' ');
            });

        });
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
