<div id="page-wrapper">
 
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Milestones</h1>

                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <center><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#table">
                <i class="fa fa-arrow-down fa-fw"></i>
                Show Milestones</button></center>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body " id="table">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="projectTable">
                                    <thead>
                                        <tr>
                                            <th>Milestone Name</th>
                                            <th>Project Name</th>
                                            <th>Milestone Description</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Task Lists</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($milestones as $milestone):?>
                                        <tr class="even gradeC">
                                            <td><?php echo $milestone['name'];?></td>
                                            <td><?php
                                            foreach ($projects as $project) {
                                                 if($project['project_id'] == $milestone['project_id'])
                                                    echo $project['name'];
                                             }?></td>
                                            <td>
                                            <button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#desc<?php echo $milestone['mile_id']?>">
                                            <i class="fa fa-arrow-down fa-fw"></i>
                                            </button>
                                            <div class="collapse" id="desc<?php echo $milestone['mile_id']?>">
                                            <?php echo $milestone['desc']?>
                                            </div>
                                            </td>
                                            <td><?php echo $milestone['start_dt']; ?></td>
                                            <td><?php echo $milestone['end_dt']?></td>
                                            <td>
                                            <?php
                                            foreach ($tasklists as $tasklist) {
                                                echo "<ul>";
                                                if($tasklist['mile_id'] == $milestone['mile_id'])
                                                {
                                                    echo "<li>";
                                                    echo $tasklist['name'];
                                                    echo "</li>";
                                                }
                                                echo "</ul>";
                                            }
                                            ?>
                                            </td>
                                            
                                        <?php endforeach ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                      <div class="row">
                <div class="col-lg-8">
               <!--  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#panel_forms">
                <i class="fa fa-plus-circle fa-fw"></i>
                Add Project</button> -->
                </div>
                     <div class="row">
                <div class="col-lg-6">
                
                    <div class="panel panel-default" >
                        <div class="panel-heading">
                           
                           <center><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#panel_forms">
                <i class="fa fa-arrow-down fa-fw"></i>
                Add Milestones</button></center>
                        </div>
                        <!-- /.panel-heading-->
                        <div class="panel-body collapse" id="panel_forms">
                            <form class="form-horizontal" id="form_project">
                            <!--<?php echo form_open("dashboard/milestone_submit"); ?>-->
                            <div id="addproject_alert" style="display:none" class="alert alert-danger"> 
                            </div>
                            <div class="form-group">
                                <label for="milestone_name" class="col-md-3 control-label">Milestone Name</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" id ="milestone_name" name="milestone_name" placeholder="Milestone Name" value=""> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="project_id" class="col-md-3 control-label">Project</label>
                                <div class="col-md-9">
                                <select class="form-control" name="project_id" id="sel1">
                                <?php foreach($projects as $project):?>
                                <option value="<?php echo $project['project_id'];?>"><?php echo $project['name'];?></option>
                                <?php endforeach?>
                                </select>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="milestone_desc" class="col-md-3 control-label">Description</label>
                                <div class="col-md-9">
                                <textarea  name="milestone_desc" id="milestone_desc" rows="10" cols="80">
                                
                                </textarea> 
                                 <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'milestone_desc' );
                                CKEDITOR.add;
                                </script>
                                </div>
                            </div>                           

                            <div class="form-group">
                                <label for="start_date" class="col-md-3 control-label">Start Date</label>
                                <div class="col-md-9">
                                <input type="date" class="form-control" id="start_date" name="start_date" placeholder="" value="">
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="end_date" class="col-md-3 control-label">End Date</label>
                                <div class="col-md-9">
                                <input type="date" class="form-control" id="end_date" name="end_date" placeholder="" value="">
                                </div>
                            </div>                                 
                                                
                                                  
                            

                            <div class="form-group">
                            <!-- Button -->
                                <div class="col-sm-12 controls">
                                <input type="submit" id="btn-project"  class="btn btn-danger btn-block" value="Add Milestone">                                     

                                </div>
                            </div>
                            <!--<?php echo form_close(); ?>-->
                         </form> 
                               
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
               
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                <div class="panel-heading">
                <center><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#addtsklist">
                <i class="fa fa-arrow-down fa-fw"></i>
                Add TaskList to a Milestone</button></center>
                </div>
                <div class="panel-body collapse" id="addtsklist">
                    <form class="form-horizontal" id="addtasklist_form">
                    <!--<?php echo form_open("dashboard/add_project_assigned"); ?>-->
                        <div id="addtasklist_alert" style="display:none" class="alert alert-danger"> 
                    
                    </div>
                        <div class="form-group">
                            <label for="project_id" class="col-md-3 control-label">Project</label>
                            <div class="col-md-9">
                            <select class="form-control" name="project_id" id="select1">
                            <?php foreach($projects as $project):?>
                            <option value="<?php echo $project['project_id'];?>"><?php echo $project['name'];?></option>
                            <?php endforeach?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="milestone_id" class="col-md-3 control-label">Milestones</label>
                            <div class="col-md-9">
                            <select class="form-control" name="milestone_id" id="select2">
                            
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="tasklist_name" class="col-md-3 control-label">Name</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" id ="tasklist_name" name="tasklist_name" placeholder="TaskList Name" value=""> 
                                </div>
                            </div>
                            
                             <div class="form-group">
                                <label for="tasklist_desc" class="col-md-3 control-label">Description</label>
                                <div class="col-md-9">
                                <textarea  name="tasklist_desc" class="form-control"id="tasklist_desc" rows="10" cols="80">
                                </textarea>
                                <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'tasklist_desc' );
                                CKEDITOR.add;
                                </script> 

                                 
                            </div>  
                            
                        <div class="form-group">
                            <!-- Button -->
                                <div class="col-sm-12 controls">
                                <input type="submit" id="btn-project"  class="btn btn-danger btn-block" value="Add TaskList">                                     
                                </div>
                        </div>
                    
                    </form>
                    <!--<?php echo form_close(); ?>-->
                </div>

                </div>

            </div>
            </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>

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
   <script type="text/javascript">
   $(function(){
        var projects = <?php echo json_encode($projects);?>;
        var milestones = <?php echo json_encode($milestones);?>;
        console.log($("#select1").val());
        var project_id = $("#select1").val();
        for(var i = 0;i < milestones.length;i++)
        {
            if(milestones[i]['project_id'] == project_id)
            {
                $("#select2").append("<option value = "+milestones[i]['mile_id']+">"+milestones[i]['name']+"</option>");
            }
        }

    });
    $("#select1").change(function(){
        $('#select2').html('');
        var milestones = <?php echo json_encode($milestones);?>;
        var project_id = $("#select1").val();
        console.log("project id:"+project_id);
        for(var i = 0;i < milestones.length;i++)
        {
            if(milestones[i]['project_id'] == project_id)
            {
                $("#select2").append("<option value = "+milestones[i]['mile_id']+">"+milestones[i]['name']+"</option>");
            }
        }
    });
    $("#form_project").submit(function(e) {
    e.preventDefault();
        console.log('clicko');
        dataarray1 = $("#form_project").serialize();
        console.log(dataarray1);
     $.ajax({
            type: "Post",
            url: "<?php echo base_url();?>dashboard/milestone_submit",
            data: dataarray1,
            success: function(data) {
                ans = jQuery.parseJSON(data);
                console.log(ans);
                if(!ans.sucess)
                {
                    $('#addproject_alert').html(ans.errors);
                    $('#addproject_alert').addClass('show');
                }
                
                else
                {
                    console.log('sucess');
                    //window.location.replace("<?php echo base_url();?>dashboard/jqueryRedirect");
                    location.reload();
                }
            },
        });
    });
    $("#addtasklist_form").submit(function(e){
        e.preventDefault();
        console.log("SUBMIT");
        dataarray1 = $("#addtasklist_form").serialize();
        console.log(dataarray1);
        $.ajax({
            type: "Post",
            url: "<?php echo base_url();?>dashboard/tasklist_submit",
            data: dataarray1,
            success: function(data) {
                ans = jQuery.parseJSON(data);
                console.log(ans);
                if(!ans.sucess)
                {
                    $('#addtasklist_alert').html(ans.errors);
                    $('#addtasklist_alert').addClass('show');
                }
                
                else
                {
                    console.log('sucess');
                    //window.location.replace("<?php echo base_url();?>dashboard/jqueryRedirect");
                    location.reload();
                }
            },
        });
    });

    </script>   