<?php

include('../shared/database.php');

$successmessage="";
 $errormessage="";


// delete category
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    try{
 $deletequey="DELETE FROM categories where id=$id";
    $deleteresult=mysqli_query($conn,$deletequey);
    if($deleteresult){
        $successmessage="Deleted Successfully";
    }else{
         $errormessage=" Can Not Deleted";
    }


    }catch(Exception $e){


    }

   
}
//all category
$clientsquery=" SELECT * FROM categories";
$categories=mysqli_query($conn,$clientsquery);

?>

<?php
include('../shared/open.php');
include('../shared/nav.php');
?>



<div class="container py-5">
    <div class="row  justify-content-center ">
        <div class="col-md-6 p-4 ">
            <?php include('../shared/alert.php');?>
          <h1  class=" py-2 text-center"style=" color:#854EE4;">List ALL Categories </h1>
            
        </div>
    </div>
</div>
<div class="container">
    
<div class="row justify-content-center">
    <div class=" col-10 table-responsive rounded "style="background-color:#854EE4; padding:10px;">
        <table class="table" >
            <tr class="text-center" >
                <th> ID</th>
                 <th> Name</th>
                  <th> Action</th>

            </tr>
            <?php foreach($categories as $item){?>
            <tr class="text-center">
                <td><?php echo $item['id']?> </td>
                 <td><?php echo $item['name']?></td>
                  <td>
                    <a class="mx-3 fs-4 text-danger" href=" ./list.php?delete=<?php echo $item['id']?>" ><i class="bi bi-trash"></i></a>
                       <a class="mx-3 fs-4" style="color:#854EE4" href=" ./edit.php?edit=<?php echo $item['id']?>"><i class="bi bi-pencil-square"></i> </a>
                     </td>

            </tr>
            <?php }?>



        </table>



    </div>
</div>
</div>
    
  



  <?php
include('../shared/close.php');


?>