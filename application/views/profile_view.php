
        <!-- Page Content -->
        
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
                        <h1 class="page-header">Profile</h1>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4> Details</h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
        
                        <div class = "col-lg-4">
                            <div id="notification-profile2" style="width:75%;display:none"class="alert alert-success" role="alert">
                            </div>
                           <img id ="dp" src="<?php echo base_url();?>uploads/<?php if($avatar)
                           echo $avatar; else echo "default.png"?>" class="img-defautl" alt="" height="120" width="120" style="">
                           <br>
                           <br>
                           <div class="btn-group" style="display:<?php if(!$edit) echo "none";?>">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changepicture" id="bt"><i class="glyphicon glyphicon-camera"></i>
                            </button>
                            <button type="button" class="btn btn-primary" id="bt1"><i class="glyphicon glyphicon-remove"></i>
                            </button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changeinformation" id="bt3"><i class="glyphicon glyphicon-pencil"></i>
                            </button>
                            </div>
                            <div id="notification-profile" style="width:75%;display:none"class="alert alert-success" role="alert">
                            </div>
                            


 
                        </div>
                        <br>
                        <div class="col-lg-4">
                        <p><strong>NAME: </strong> <?php echo $name?></p>
                        <p><strong>UserId: </strong> <?php echo $user_id?></p>
                        <p><strong>Email:</strong> <?php echo $email?></p>
                        <p><strong>Department:</strong> <?php echo $department?></p>
                        <p><strong>Mobile:</strong> <?php echo $mobile?></p>
                        <p><strong>Phone:</strong> <?php echo $phone?></p>
                        <p><strong>Gender:</strong> <?php if($gender=='m') echo "male";else echo "female";?></p>
                        </div>
                        <div class="col-lg-4">
                        <p><strong>Address1:</strong> <?php echo $add1?></p>
                        <p><strong>Adress2:</strong> <?php echo $add2?></p>
                        <p><strong>City:</strong> <?php echo $city?></p>
                        <p><strong>state:</strong> <?php echo $state?></p>
                        <p><strong>pin:</strong> <?php echo $pin?></p>
                        <p><strong>country:</strong> <?php echo $country?></p>

                            
                        </div>

                    </div>
                    <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->


    </div>
    <!-- /#wrapper -->
<!-- MODAL IMAGE -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Profile Picture</h4>
      </div>
      <div class="modal-body" >
        <img src="" id="imagepreview" style="width: 100%; height: 400px;" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  <!-- MODAL 1 -->
<div class="modal fade" id="changepicture" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog " id="md1" >
        <!--<div class="modal-content">
            </div>-->

    <div class="modal-header">
        <h4 class="modal-title" style="color:rgb(50,50,200)">UPLOAD PICTURE</h4>
      </div>
      

      <!--<div class="modal-body">-->
    <!-- <form role="form" action="" method="post" enctype="multipart/form-data"> -->

    <?php echo form_open_multipart('profile/do_upload');?>
    <div class="form-group">
    <label>Select image to upload:</label>

    <input type="file" name="userfile" id="userfile" class="btn btn-default">
    </div>
     <!-- </div>-->


      <div class="modal-footer">
        <input type="submit" value="upload" name="submit" class="btn btn-primary" >
         </form>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="bt2">Close</button>
        
      </div>
</div>
</div>


<div class="modal fade" id="changeinformation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" id="md2" >
        <!--<div class="modal-content">
            </div>-->

    <div class="modal-header">
        <h4 class="modal-title" style="color:rgb(50,50,200)">EDIT PROFILE</h4>
      </div>
      
       <br>
     <div class="modal-body">
          <div class="row">
            <div class="col-md-6">   
           <!--  <div class="form-horizontal"> -->
           <form id="form1" class="form-horizontal" role="form">

            <div id="alert-changeinfo" style="display:none" class="alert alert-danger"> 
            </div>
           

            <div class="form-group">
                <label for="username" class="col-md-3 control-label">Name</label>
                <div class="col-md-9">
                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="UserName" value="<?php echo $name?>">
                </div>
            </div>                                   
                                
                                  
            <div class="form-group">
                <label for="email" class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                <input type="text" class="form-control" id ="email" name="email" placeholder="Email Address" value="<?php echo $email; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="department" class="col-md-3 control-label">Department</label>
                <div class="col-md-9">
                <input type="text" class="form-control" id="department" name="department" placeholder="Department" value="<?php echo $department; ?>">
                </div>
            </div>


            <div class="form-group">
                <label for="mobileno" class="col-md-3 control-label">Mobile Number</label>
                <div class="col-md-9">
                <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile Number" value=<?php echo $mobile; ?>>
                </div>
            </div>
                                
           <!--  <div class="form-group">
                <label for="password" class="col-md-3 control-label">New Password</label>
                <div class="col-md-9">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo ""; ?>">
                </div>
            </div>
                                    
            <div class="form-group">
                <label for="cpassword" class="col-md-3 control-label">Confirm New Password</label>
                <div class="col-md-9">
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Renter Password" value="<?php echo ""; ?>">
                </div>
            </div> -->

            </form>

            </div>


         <div class="col-md-6">  
         <form id="form2" class="form-horizontal" role="form"> 
                <div class="form-group">
                    <label for="phone" class="col-md-3 control-label">Phone(Landline)</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" value="<?php echo $phone; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="add1" class="col-md-3 control-label">Address 1</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" id="add1" name="add1" placeholder="Enter Address1" value="<?php echo $add1; ?>">
                    </div>
                </div>  

                <div class="form-group">
                    <label for="add2" class="col-md-3 control-label">Address 2</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" id="add2" name="add2" placeholder="Enter Address2" value="<?php echo $add2; ?>">
                    </div>
                </div> 

                <div class="form-group">
                    <label for="city" class="col-md-3 control-label">City</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" value="<?php echo $city; ?>">
                    </div>
                </div> 

                 <div class="form-group">
                    <label for="state" class="col-md-3 control-label">State</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" id="state" name="state" placeholder="Enter State" value="<?php echo $state; ?>">
                    </div>
                </div> 

                 <div class="form-group">
                    <label for="pin" class="col-md-3 control-label">Pin</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" id="pin" name="pin" placeholder="Enter Pin" value="<?php echo $pin; ?>">
                    </div>
                </div> 

                 <div class="form-group">
                    <label for="country" class="col-md-3 control-label">Country</label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country" value="<?php echo $country; ?>">
                    </div>
                </div> 
            </form>   
        </div>
            


          <!-- </div> -->

    </div>


      <div class="modal-footer">
        <div class="form-group"> 
    
        <button id="submit-modal" type="submit" class="btn btn-primary">Submit</button>
        <!-- </form> -->
        <button type="button" class="btn btn-default" data-dismiss="modal" id="bt4">Close</button>
        
      </div>
</div>
</div>
</div>


<!-- MODAL 2 -->


    <!-- jQuery -->
    <script src="<?php echo base_url();?>/include_files/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>/include_files/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>/include_files/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>/include_files/dist/js/sb-admin-2.js"></script>
<style>
#md1    
{
    width:300px;
}
.modal-backdrop {
   
}
#md2
{
    width:350px;
}

.show
{
    display: inline-block;
}
@media screen and (min-width: 768px) {
    
    #imagemodal .modal-dialog  {width:400px;height:100px;}
    #changeinformation .modal-dialog  {width:900px;height:100px;}

}
</style>
<script>
$(document).ready(function(){
  $("#bt").click(function(){
    //console.log("1");
    $("#page-wrapper").css("-webkit-filter","blur(2px) grayscale(1) opacity(0.5)");
  });
  $("#page-wrapper").mouseover(function(){
    $("#page-wrapper").css("-webkit-filter","blur(0px) grayscale(0) opacity(1)");
  });

   $("#bt2").click(function(){
    $("#page-wrapper").css("-webkit-filter","blur(0px) grayscale(0) opacity(1)");
  });
  

$("#bt3").click(function(){
    $("#page-wrapper").css("-webkit-filter","blur(2px) grayscale(1) opacity(0.5)");
  });
 $("#bt4").click(function(){
    $("#page-wrapper").css("-webkit-filter","blur(0px) grayscale(0) opacity(1)");
  });
/* $('#dp').hover(function() {
    console.log('1');
        $("#dp").addClass('transition');

    }, function() {
        console.log('2');
        $("#dp").removeClass('transition');
    });*/

 $('#bt').hover(function() {
    //console.log('1');
    $("#notification-profile").text("Update Profile Picture!");
    $("#notification-profile").addClass('show');

    }, function() {
        //console.log('2');
        $("#notification-profile").removeClass('show');
    });
 $('#bt1').hover(function() {
    //console.log('3');
    $("#notification-profile").text("Remove Profile Picture!");
       $("#notification-profile").addClass('show');

    }, function() {
        //console.log('4');
       $("#notification-profile").removeClass('show');
    });
$('#bt3').hover(function() {
    //console.log('5');
    $("#notification-profile").text("Edit Profile!");
      $("#notification-profile").addClass('show');

    }, function() {
        //console.log('6');
       $("#notification-profile").removeClass('show');
    });
$('#bt1').click(function() {
    console.log('click');
    base_url = "<?php echo base_url()?>";
    url = base_url+"profile/removeAvatar";
    //alert(url);
    $.getJSON(url, function(data){
        console.log(data);
    if(data.v){
         $('#dp').attr('src', base_url+'uploads/default.png');        
        console.log('DP REMOVED');
        $("#notification-profile2").text("DP REMOVED!");
    }
    else{
        console.log('NO DP');
        $("#notification-profile2").text("SET A DP FIRST!");
    }
    $("#notification-profile2").delay(500).fadeIn();
    $("#notification-profile2").delay(2000).fadeOut();
    });

    });
$('#dp').dblclick(function(){
    console.log("double click");
    imgpath = $('#dp').attr('src');
    
    default_imgpath = "<?php echo base_url();?>uploads/default.png";
    console.log(default_imgpath);
    if(imgpath === default_imgpath)
        return;
    $('#imagepreview').attr('src',imgpath); 
    $('#imagemodal').modal('show');
});
$('#dp').hover(function() {
    //console.log('5');
    $("#notification-profile").text("Double Click To Expand!");
      $("#notification-profile").addClass('show');

    }, function() {
        //console.log('6');
       $("#notification-profile").removeClass('show');
    });
$('#submit-modal').click(function(){
    console.log('click');
    dataarray1 = $("#form1").serialize();
    //console.log(dataarray1);
    dataarray2 = $("#form2").serialize();
    dataarray2 = dataarray1+'&'+dataarray2;
    console.log(dataarray2);
     $.ajax({
            type: "Post",
            url: "<?php echo base_url();?>profile/updateData",
            data: dataarray2,
            success: function(data) {
                ans = jQuery.parseJSON(data);
                console.log(ans);
                if(!ans.sucess)
                {
                    $('#alert-changeinfo').html(ans.errors);
                    $('#alert-changeinfo').addClass('show');
                }
                /*IF TRUE IS RETURNED*/
                else
                {
                    window.location.replace("<?php echo base_url();?>profile/jqueryRedirect");
                    //location.reload();
                }
            },
        });
});


});
</script>


</body>

</html>
