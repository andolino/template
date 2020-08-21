<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>CBAM-ERS | LOGIN</title>
<link rel="shortcut icon" href="<?= base_url('assets/image/misc/ico.ico') ?>" type="image/x-icon">
<link href="<?php echo base_url('assets/css/login.css'); ?>" rel="stylesheet" id="bootstrap-css">
<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" id="bootstrap-css">
<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/swal.js'); ?>"></script>
<script type="text/javascript">
  $(document).ready(function($) {
    $(document).on('submit', '#frm-login', function(e) {
      e.preventDefault();
      var frm = $(this).serialize();
      $.ajax({
        url: 'submit-login',
        type: 'POST',
        dataType: 'JSON',
        data: frm,
        success: function(res){
          var cnt = Object.keys(res).length;
          // console.log(typeof res.msg, typeof cnt);
          if (cnt === 1 && res.msg == 'failed') {
            Swal.fire(
              'Oops!',
              'Invalid Credentials',
              'error'
            ); 
          } 
          else if(res.msg == 'success'){
            window.location.href = res.redirect;
          } else {
            $.each(res, function(index, el) {
              $('div[ref="'+index+'"]').html(el).show();
              setTimeout(function(){
                $('div[ref="'+index+'"]').html(el).hide();
              }, 3000);
            });
          }
        }
      });
    }); 
  });
</script>
</head>

<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first pt-4">
      <img 
        src="<?php echo base_url('assets/image/misc/logo.png'); ?>" 
        class="m-4" 
        id="icon" 
        alt="User Icon" 
        style=""/>
    </div>

    <!-- Login Form -->
    <form id="frm-login">
      <input type="text" id="username" class="fadeIn second" name="username" placeholder="Username">
      <div ref="username" class="invalid-feedback">
        
      </div>
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
      <div ref="password" class="invalid-feedback">
        
      </div>
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="<?php echo base_url('forgot-password'); ?>">Forgot Password?</a>
    </div>

  </div>
  <p style="font-size:9px;" class="help-block font-8 text-right d-none" id="upload-file-status">Powered by: TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES <img src="" alt=""><img 
        src="<?php echo base_url('assets/image/misc/logo4.png'); ?>" 
        class="m-4" 
        id="icon" 
        alt="User Icon" 
        style="width:10%;"/></p>
</div>
</body>
<script>
  setTimeout(() => {
    $('#upload-file-status').removeClass('d-none');
  }, 1000);
</script>
<style>
  #upload-file-status {
    position: absolute;
    bottom: 0;
    right: 0;
    color: #939090;
  }
</style>
</html>