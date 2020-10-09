<?php
include('includes/config.php');
if(!empty($_POST["programmeid"])) 
{
 $cid=intval($_POST['programmeid']);
 if(!is_numeric($cid)){
   echo htmlentities("Invalid Programme");
   exit;
 }
 else{
  if($cid == 1 || $cid == 2 || $cid == 3){
      $stmt = $dbh->prepare("SELECT SID,SNAME FROM LLBSTUDENT WHERE PRGID = :id ORDER BY SNAME ");
      $stmt->execute(array(':id' => $cid));
     ?><option value="">Select Student </option><?php
     while($row=$stmt->fetch(PDO::FETCH_ASSOC))
     {
      ?>
<option value="<?php echo htmlentities($row['SID']); ?>"><?php echo htmlentities($row['SNAME']); ?></option>
<?php
}
     } 
else if($cid == 4 || $cid == 5){
$stmt = $dbh->prepare("SELECT GRPID,GRPNAME FROM LLBGROUP");
$stmt->execute();
?><option value="">Select BA LL.B Academic Group </option><?php
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
      ?>
<option value="<?php echo htmlentities($row['GRPID']); ?>"><?php echo htmlentities($row['GRPNAME']); ?></option>
<?php
      }
    }
    else if ($cid == 6 || $cid == 7){
      $stmt = $dbh->prepare("SELECT GRPID,GRPNAME FROM LLMGROUP");
      $stmt->execute();
      ?><option value="">Select LL.M Academic Group </option><?php
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
      ?>
<option value="<?php echo htmlentities($row['GRPID']); ?>"><?php echo htmlentities($row['GRPNAME']); ?></option>
<?php
      }
    }
    
   }
 

}
// Code for Subjects
if(!empty($_POST["classid1"])) 
{
 $cid1=intval($_POST['classid1']);
 if(!is_numeric($cid1)){
 
  echo htmlentities("invalid Class");exit;
 }
 else{
 $status=0;	
 $stmt = $dbh->prepare("SELECT tblsubjects.SubjectName,tblsubjects.id FROM tblsubjectcombination join  tblsubjects on  tblsubjects.id=tblsubjectcombination.SubjectId WHERE tblsubjectcombination.ClassId=:cid and tblsubjectcombination.status!=:stts order by tblsubjects.SubjectName");
 $stmt->execute(array(':cid' => $cid1,':stts' => $status));
 
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {?>
<p> <?php echo htmlentities($row['SubjectName']); ?><input type="text" name="marks[]" value="" class="form-control"
        required="" placeholder="Enter marks out of 100" autocomplete="off"></p>

<?php  }
}
}


?>

<?php

if(!empty($_POST["studclass"])) 
{
 $id= $_POST['studclass'];
 $dta=explode("$",$id);
$id=$dta[0];
$id1=$dta[1];
 $query = $dbh->prepare("SELECT StudentId,ClassId FROM tblresult WHERE StudentId=:id1 and ClassId=:id ");
//$query= $dbh -> prepare($sql);
$query-> bindParam(':id1', $id1, PDO::PARAM_STR);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{ ?>
<p>
    <?php
echo "<span style='color:red'> Result Already Declare .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
 ?></p>
<?php }


  }?>