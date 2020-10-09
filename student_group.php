<?php
include('includes/config.php');
if(!empty($_POST["group"])) 
{
 $gid=intval($_POST['group']);
 if(!is_numeric($gid)){
 
 	echo htmlentities("Invalid Details");exit;
 }
 else{

     if($gid==1){
      $stmt = $dbh->prepare("SELECT SID,SNAME FROM FOURTHYEAR_CRIMINAL
      INNER JOIN FOURTHYEAR ON FOURTHYEAR_CRIMINAL.FOURTHYEARID = FOURTHYEAR.FOURTHYEARID
      INNER JOIN LLBSTUDENT ON LLBSTUDENT.SID = FOURTHYEAR.SID order by LLBSTUDENT.SNAME");
      $stmt->execute(array(':id' => $gid));
      ?><option value="">Select Student </option><?php
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
       ?>
<option value="<?php echo htmlentities($row['SID']); ?>"><?php echo htmlentities($row['SNAME']); ?></option>
<?php
      }
     }

     if($gid==2){
        $stmt = $dbh->prepare("SELECT SID,SNAME FROM FOURTHYEAR_BUSINESS
      INNER JOIN FOURTHYEAR ON FOURTHYEAR_BUSINESS.FOURTHYEARID = FOURTHYEAR.FOURTHYEARID
      INNER JOIN LLBSTUDENT ON LLBSTUDENT.SID = FOURTHYEAR.SID order by LLBSTUDENT.SNAME");
      $stmt->execute(array(':id' => $gid));
      ?><option value="">Select Student </option><?php
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
       ?>
<option value="<?php echo htmlentities($row['SID']); ?>"><?php echo htmlentities($row['SNAME']); ?></option>
<?php
        }
       }

       if($gid==43){
        $stmt = $dbh->prepare("SELECT SID,SNAME FROM FOURTHYEAR_CONSTITUTIONAL
      INNER JOIN FOURTHYEAR ON FOURTHYEAR_CONSTITUTIONAL.FOURTHYEARID = FOURTHYEAR.FOURTHYEARID
      INNER JOIN LLBSTUDENT ON LLBSTUDENT.SID = FOURTHYEAR.SID order by LLBSTUDENT.SNAME");
      $stmt->execute(array(':id' => $gid));
      ?><option value="">Select Student </option><?php
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
       ?>
<option value="<?php echo htmlentities($row['SID']); ?>"><?php echo htmlentities($row['SNAME']); ?></option>
<?php
        }
       }

       if($gid==44){
        $stmt = $dbh->prepare("SELECT SID,SNAME FROM FOURTHYEAR_ENVIRONMENT
        INNER JOIN FOURTHYEAR ON FOURTHYEAR_ENVIRONMENT.FOURTHYEARID = FOURTHYEAR.FOURTHYEARID
        INNER JOIN LLBSTUDENT ON LLBSTUDENT.SID = FOURTHYEAR.SID order by LLBSTUDENT.SNAME");
        $stmt->execute(array(':id' => $gid));
        ?><option value="">Select Student </option><?php
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
         ?>
<option value="<?php echo htmlentities($row['SID']); ?>"><?php echo htmlentities($row['SNAME']); ?></option>
<?php
        }
       }
     
 }


  }?>