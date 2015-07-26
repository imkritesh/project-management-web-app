<!DOCTYPE html>
<?php
$page === "login"?$t=0:$t=1;
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN/SIGNUP</title>
<link class="cssdeck" rel="stylesheet" href="<?php echo base_url();?>/include/css/bootstrap.min.css">
<script class="cssdeck" src="<?php echo base_url();?>/include/jquery/jquery.min.js"></script>
<script class="cssdeck" src="<?php echo base_url();?>/include/js/bootstrap.min.js"></script>
<style type="text/css">
    body
    {
        background: url('<?php echo base_url();?>/include/background/3.jpg'); 
    /*-webkit-background-size: 100%;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: 100% 100%;*/
    }
    #signupalert{
        font-size: 12px;
        /*max-height: 20px;
        margin-top: 1px;
        margin-bottom: 1px;*/

    }
</style>
</head>
<body>
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
    <div class="container">
    <div style="margin-top:1%;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
<ul  class="nav nav-tabs nav-justified ">
  <li class="<?php if(!$t) echo "active";?>"><a href="#tab_a" data-toggle="tab">LOG IN</a></li>
  <li class="<?php if($t) echo "active";?>"><a href="#tab_b" data-toggle="tab">SIGN UP</a></li>
  
</ul>
</div>

<div class="tab-content">
        <div class="tab-pane <?php if(!$t) echo "active";?>" id="tab_a">
        <div id="loginbox" style="margin-top:0%;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
                    <?php
                    $error = 0;
                    if(isset($wrong_cred))
                      $error = 1;
                    elseif(isset($empty_fields))
                        $error = 2;
                    $msg1 = "UserName or password is wrong!";
                    $msg2 = "Fields are Empty";
                    ?>
                        <div style="display:<?php if(!$error) echo "none";?>" id="login-alert" class="alert alert-danger col-sm-12">
                        <?php if($error === 1) echo $msg1;elseif($error === 2)echo $msg2;?>
                        </div>
                            
                        <!-- <form id="loginform" class="form-horizontal" role="form"> -->
                        <?php echo form_open("login/logyouin"); ?>
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="username" type="text" class="form-control" name="username" value="<?php echo set_value('username'); ?>" placeholder="Enter username">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="pass" type="password" class="form-control" name="pass" value="<?php echo set_value('pass')?>"placeholder="Enter password">
                                    </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <input type="submit" id="btn-login"  class="btn btn-success btn-block" value="LOGIN">
                                      <!-- <a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a> -->

                                    </div>
                                </div> 
                                <?php echo form_close(); ?>
                           <!--  </form>      -->
                        </div>                     
                    </div>  
        </div>
        </div>
        <div class="tab-pane <?php if($t) echo "active";?>" id="tab_b">
        <div id="loginbox" style="margin-top:0%;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" >
        <div class="panel-heading">
                        <div class="panel-title">Sign Up</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"></div>
                    </div> 
        <div style="padding-top:30px" class="panel-body" >
            <!-- <form id="signupform" class="form-horizontal"role="form"> -->
            <div class="form-horizontal">
            <div id="signupalert" style="<?php if(!validation_errors()) echo 'display:none';?>" class="alert alert-danger"> 
            <?php echo validation_errors();?>
            </div>
<?php echo form_open("login/registration"); ?>
            <div class="form-group">
                <label for="userid" class="col-md-3 control-label">Username(Unique)</label>
                <div class="col-md-9">
                <input type="text" class="form-control" id ="user_id" name="user_id" placeholder="UserId" value="<?php echo set_value('user_id'); ?>"> 
                </div>
            </div>

            <div class="form-group">
                <label for="username" class="col-md-3 control-label">Name</label>
                <div class="col-md-9">
                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="UserName" value="<?php echo set_value('user_name'); ?>">
                </div>
            </div>                                   
                                
                                  
            <div class="form-group">
                <label for="email" class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                <input type="text" class="form-control" id ="email" name="email" placeholder="Email Address" value="<?php echo set_value('email'); ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="department" class="col-md-3 control-label">Department</label>
                <div class="col-md-9">
                <input type="text" class="form-control" id="department" name="department" placeholder="Department" value="<?php echo set_value('department'); ?>">
                </div>
            </div>


            <div class="form-group">
                <label for="mobileno" class="col-md-3 control-label">Mobile Number</label>
                <div class="col-md-9">
                <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile Number" value=<?php echo set_value('mobile_number'); ?>>
                </div>
            </div>

            <div class="form-group">
                <label for="gender" class="col-md-3 control-label">Gender</label>
                <div class="col-md-9">
                <label class="radio-inline"><input type="radio" name="gender"  value="m">Male</label>
                <label class="radio-inline"><input type="radio" name="gender"  value="f">Female</label>
                </div>
            </div>
                                
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Password</label>
                <div class="col-md-9">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>">
                </div>
            </div>
                                    
            <div class="form-group">
                <label for="cpassword" class="col-md-3 control-label">Confirm Password</label>
                <div class="col-md-9">
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Renter Password" value="<?php echo set_value('cpassword'); ?>">
                </div>
            </div>

            <div class="form-group">
            <!-- Button -->
                <div class="col-sm-12 controls">
                <input type="submit" id="btn-signup"  class="btn btn-info btn-block" value="SIGN UP">                                     

                </div>
            </div>
<?php echo form_close(); ?>
        <!-- </form> -->
        </div>
        </div>
        </div>
        </div>
        </div>
</div><!-- tab content -->
</div><!-- end of container -->
</body>
</html>