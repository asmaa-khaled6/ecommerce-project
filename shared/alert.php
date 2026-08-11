     <?php if(!empty($successmessage)){ ?>
    
     <div class="alert  alert-success alert-dismissible fade show" role="alert">
 <?php echo $successmessage?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?>
         
           <?php if(!empty($errormessage)){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <?php echo $errormessage?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
<?php } ?>
