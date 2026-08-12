<?php

include('../shared/database.php');

$successmessage="";
 $errormessage="";


// delete category
if(isset($_GET['delete'])){
    $id=$_GET['delete'];

    try{
 $deletequey="DELETE FROM employees where id=$id";
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
$employeesquery=" SELECT * FROM employees";
$employees=mysqli_query($conn,$employeesquery);

?>

<?php
include('../shared/open.php');
include('../shared/nav.php');
?>



<div class="container py-5">
    <div class="row  justify-content-center ">
        <div class="col-md-6 p-4 ">
            <?php include('../shared/alert.php');?>
          <h1  class=" py-2 text-center"style=" color:#17365D;">List ALL Clients </h1>
            
        </div>
    </div>
</div>
<div class="container">
    
<div class="row justify-content-center">
    <div class=" col-10  table-responsive rounded"style="background-color:#2F8FEF; padding:10px;">
        <table class="table" >
            <tr class="text-center" >
                <th> ID</th>
                 <th> Name</th>
                  <th> Email</th>
                 <th> address</th>
                 <th> password</th>
                 <th> gender</th>
                 <th> age</th>
                 <th> phone</th>
                 
                  <th> Action</th>

            </tr>
            <?php foreach($employees as $item){?>
            <tr class="text-center">
                <td><?php echo $item['id']?> </td>
                 <td><?php echo $item['name']?></td>
                 <td><?php echo $item['email']?></td>
                  <td><?php echo $item['address']; ?></td>
            <td><?php echo $item['password']; ?></td>
            <td><?php echo $item['gender']; ?></td>
            <td><?php echo $item['age']; ?></td>
             <td><?php echo $item['phone']; ?></td>

                  <td>
                    <a class="mx-3 fs-4 text-danger" href=" Employee/list.php?delete=<?php echo $item['id']?>" ><i class="bi bi-trash"></i></a>
<a class="mx-3 fs-4"
   style="color:#854EE4"
   href="/nti/FinalProject/ecommerce-project/Employee/edit.php?edit=<?php echo $item['id']; ?>">
    <i class="bi bi-pencil-square"  style="color:#2F8FEF;"></i>
</a>                     </td>

            </tr>
            <?php }?>
        </table>
    </div>
</div>
</div>
  <?php
include('../shared/close.php');

?>