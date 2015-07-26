<div id="page-wrapper">
 
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Projects</h1>

                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <center><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#table">
                <i class="fa fa-arrow-down fa-fw"></i>
                SHOW MY Projects</button></center>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body " id="table">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="projectTable">
                                    <thead>
                                        <tr>
                                            <th>Project Name</th>
                                            <th>Project Description</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Budget</th>
                                            <th>Members</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($projects as $project):?>
                                        <tr class="even gradeC">
                                            <td><?php echo $project['name'];?></td>
                                            <td>
                                            <button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#desc<?php echo $project['project_id']?>">
                                            <i class="fa fa-arrow-down fa-fw"></i>
                                            </button>
                                            <div class="collapse" id="desc<?php echo $project['project_id']?>">
                                            <?php echo $project['desc']?>
                                            </div>
                                            </td>
                                            <td><?php echo $project['start_dt'];?></td>
                                            <td><?php echo $project['end_dt']; ?></td>
                                            <td><?php echo $project['budget']?></td>
                                            <td>
                                                <!-- <table class="table table-striped table-bordered table-hover"> -->
                                                
                                                        <button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#u1<?php echo $project['project_id']?>">
                                                        <i class="fa fa-arrow-down fa-fw"></i>
                                                        </button>
                                                    
                                                    <div class="collapse" id="u1<?php echo $project['project_id']?>">
                                                    <?php foreach($project_assigned as $pa){
                                                    if($pa['project_id'] ==$project['project_id'])
                                                    {
                                                        /*echo "<tr><td>";*/
                                                        foreach ($users as $user) {
                                                            if($user['user_id']==$pa['user_id'])
                                                            {
                                                                echo $user['user_name'];
                                                                echo "<br>";
                                                            }
                                                        }
                                                        /*echo "</td></tr>";*/
                                                        //echo "<tr><td> "+$pa['user_id']+"</td></tr>";
                                                    }
                                                     }?>
                                                    </div>
                                                <!-- </table> -->
                                               
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
                <div class="col-lg-8">
                
                    <div class="panel panel-default" >
                        <div class="panel-heading">
                           
                           <center><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#panel_forms">
                <i class="fa fa-arrow-down fa-fw"></i>
                Add Project</button></center>
                        </div>
                        <!-- /.panel-heading-->
                        <div class="panel-body collapse" id="panel_forms">
                            <form class="form-horizontal" id="form_project">
                            <!--<?php echo form_open("dashboard/project_submit"); ?>-->
                            <div id="addproject_alert" style="display:none" class="alert alert-danger"> 
                            </div>
                            <div class="form-group">
                                <label for="project_name" class="col-md-3 control-label">Project Name</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" id ="project_name" name="project_name" placeholder="Project Name" value=""> 
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="project_desc" class="col-md-3 control-label">Description</label>
                                <div class="col-md-9">
                                <textarea  name="project_desc" id="project_desc" rows="10" cols="80">
                                
                                </textarea> 
                                 <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'project_desc' );
                                CKEDITOR.add;
                                </script>
                                </div>
                            </div>                           

                            <div class="form-group">
                                <label for="start_date" class="col-md-3 control-label">Start Date</label>
                                <div class="col-md-9">
                                <input type="date" class="form-control" id="start_date" name="start_date"  value="<?php echo date('Y-m-d');?>">
                                </div>
                            </div>                                   
                                                
                                                  
                            <div class="form-group">
                                <label for="budget" class="col-md-3 control-label">Budget</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" id ="budget" name="budget" placeholder="Enter Budget" value="">
                                </div>
                            </div>

                            <div class="form-group">
                            <!-- Button -->
                                <div class="col-sm-12 controls">
                                <input type="submit" id="btn-project"  class="btn btn-danger btn-block" value="Add Project">                                     

                                </div>
                            </div>
                        </form>
                            <!--  <?php echo form_close(); ?> -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
               
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                <div class="panel-heading">
                <center><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#addppl">
                <i class="fa fa-arrow-down fa-fw"></i>
                Add Members</button></center>
                </div>
                <div class="panel-body " id="addppl">
                    <div class="form-horizontal">
                    <?php echo form_open("dashboard/add_project_assigned"); ?>
                    <div id="addprojectuser_alert" style="display:<?php if(!isset($error)) echo "none";?>" class="alert alert-danger"> 
                    <?php if(isset($error)) echo $error;?>;
                    </div>
                        <div class="form-group">
                            <label for="project_id" class="col-md-3 control-label">Projects</label>
                            <div class="col-md-9">
                            <select class="form-control" name="project_id" id="sel1">
                            <?php foreach($projects as $project):?>
                            <option value="<?php echo $project['project_id'];?>"><?php echo $project['name'];?></option>
                            <?php endforeach?>
                            </select>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="user_id" class="col-md-3 control-label">Users</label>
                            <div class="col-md-9">
                            <select class="form-control" name="user_id" id="sel1">
                            <?php foreach($users as $user):?>
                            <option value="<?php echo $user['user_id'];?>"><?php echo $user['user_name'];?></option>
                            <?php endforeach?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- Button -->
                                <div class="col-sm-12 controls">
                                <input type="submit" id="btn-project"  class="btn btn-danger btn-block" value="Add Member">                                     
                                </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    </div>
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
    $("#form_project").submit(function(e) {
    e.preventDefault();
    });
    $('#btn-project').click(function(){
        console.log('clicko');
        dataarray1 = $("#form_project").serialize();
        console.log(dataarray1);
     $.ajax({
            type: "Post",
            url: "<?php echo base_url();?>dashboard/project_submit",
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
                    window.location.replace("<?php echo base_url();?>dashboard/jqueryRedirect");
                    location.reload();
                }
            },
        });
    });
    </script>