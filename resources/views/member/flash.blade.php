        
        <?php
session_start();
if( isset($_SESSION['flash-success-message']) && !empty($_SESSION['flash-success-message'])) 
{
    $success_message = $_SESSION['flash-success-message'];
    ?>
      <div class="alert bg-success text-white alert-styled-left alert-dismissible" style="background-color: #009688 !important;">
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            <span class="font-weight-semibold">Well done!</span> {!! $success_message !!}
        </div> 
         
    <?php
    unset($_SESSION['flash-success-message']); 
} 
   ?>
          
       
    
<?php 

if( isset($_SESSION['flash-error-message']) && !empty($_SESSION['flash-error-message'])) 
{
     $error_message = $_SESSION['flash-error-message'];
     ?> 
        <div class="alert bg-danger text-white alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            <span class="font-weight-semibold">Oh snap!</span> {!! $error_message !!}.
        </div> 
     <?php
     unset($_SESSION['flash-error-message']); 
}
?>
       
  