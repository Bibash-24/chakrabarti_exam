<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
if(isset($_POST['submit']))
{
    $studentname=$_POST['fullanme'];
    $rollid=$_POST['rollid']; 
    $studentemail=$_POST['emailid']; 
    $gender=$_POST['gender']; 
    $examid=$_POST['examid']; 
    $phone=$_POST['phone']; 
    $program=$_POST['programme']; 
    $batch=$_POST['batch'];
    

    if($program == 1 || $program == 2 || $program == 3){
        $sql="INSERT INTO  LLBSTUDENT(SNAME,EXAM_NO,ROLL_NO,EMAIL,PHONE_NO,GENDER,BATCH,PRGID) VALUES(:studentname,:examid,:rollid,:studentemail,:phone,:gender,:batch,:program)";
        $query = $dbh->prepare($sql);
    }
    else if($program == 4 || $program == 5){
        $group=$_POST['group'];
        $sql="INSERT INTO  LLBSTUDENT(SNAME,EXAM_NO,ROLL_NO,EMAIL,PHONE_NO,GENDER,BATCH,PRGID,GRPID) VALUES(:studentname,:examid,:rollid,:studentemail,:phone,:gender,:batch,:program,:group)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':group',$group,PDO::PARAM_STR);
    }
    else if($program == 6 || $program == 7){
        $group=$_POST['group'];
        $sql="INSERT INTO  LLMSTUDENT(SNAME,EXAM_NO,ROLL_NO,EMAIL,PHONE_NO,GENDER,BATCH,PRGID,GRPID) VALUES(:studentname,:examid,:rollid,:studentemail,:phone,:gender,:batch,:program,:group)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':group',$group,PDO::PARAM_STR);
    }
    

    $query->bindParam(':studentname',$studentname,PDO::PARAM_STR);
    $query->bindParam(':rollid',$rollid,PDO::PARAM_STR);
    $query->bindParam(':studentemail',$studentemail,PDO::PARAM_STR);
    $query->bindParam(':gender',$gender,PDO::PARAM_STR);
    $query->bindParam(':examid',$examid,PDO::PARAM_STR);
    $query->bindParam(':phone',$phone,PDO::PARAM_STR);
    $query->bindParam(':batch',$batch,PDO::PARAM_STR);
    $query->bindParam(':program',$program,PDO::PARAM_STR);
    

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{ 
$msg="Student info added successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMS Admin| Student Admission< </title>
            <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
            <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
            <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
            <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
            <link rel="stylesheet" href="css/prism/prism.css" media="screen">
            <link rel="stylesheet" href="css/select2/select2.min.css">
            <link rel="stylesheet" href="css/main.css" media="screen">
            <script src="js/modernizr/modernizr.min.js"></script>

            <script>
                function getGroup() {

                    var selectBox = document.getElementById('programmeid');
                    var userInput = selectBox.options[selectBox.selectedIndex].value;
                    if (userInput == 4 || userInput == 5) {
                        document.getElementById('groupid').style.visibility = 'visible';
                    }
                    else if (userInput == 6 || userInput == 7) {
                        document.getElementById('mgroupid').style.visibility = 'visible';
                    }
                    else{
                        document.getElementById('groupid').style.visibility = 'hidden';
                    }
                    return false;
                }

            </script>

</head>

<body class="top-navbar-fixed">
    <div class="main-wrapper">

        <!-- ========== TOP NAVBAR ========== -->
        <?php include('includes/topbar.php');?>
        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
        <div class="content-wrapper">
            <div class="content-container">

                <!-- ========== LEFT SIDEBAR ========== -->
                <?php include('includes/leftbar.php');?>
                <!-- /.left-sidebar -->

                <div class="main-page">

                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">Student Admission</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>

                                    <li class="active">Student Admission</li>
                                </ul>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>Fill the Student info</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php if($msg){?>
                                        <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                        </div><?php } 
else if($error){?>
                                        <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                        <form class="form-horizontal" method="post">

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Full Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="fullanme" class="form-control"
                                                        id="fullanme" required="required" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Exam Id</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="examid" class="form-control" id="examid"
                                                        required="required" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Roll No.</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="rollid" class="form-control" id="rollid"
                                                        required="required" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" name="emailid" class="form-control" id="email"
                                                        required="required" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Phone No.</label>
                                                <div class="col-sm-10">
                                                    <input type="number" name="phone" class="form-control" id="phone"
                                                        required="required" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Batch</label>
                                                <div class="col-sm-10">
                                                    <input type="number" name="batch" class="form-control" id="batch"
                                                        required="required" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Gender</label>
                                                <div class="col-sm-10">
                                                    <input type="radio" name="gender" value="Male" required="required"
                                                        checked="">Male <input type="radio" name="gender" value="Female"
                                                        required="required">Female <input type="radio" name="gender"
                                                        value="Other" required="required">Other
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Class</label>
                                                <div class="col-sm-10">
                                                        <select name="programme" class="form-control"
                                                            id="programmeid" onChange="getGroup();" required="required">
                                                            <option value="">Select Year</option>
                                                            <?php $sql = "SELECT * from PROGRAMME";
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                            if($query->rowCount() > 0)
                                                            {
                                                            foreach($results as $result)
                                                            {   ?>
                                                            <option
                                                                value="<?php echo htmlentities($result->PRGID); ?>">
                                                                <?php echo htmlentities($result->PRGNAME); ?>
                                                            </option>
                                                            <?php }} ?>
                                                        </select>
                                                </div>
                                            </div>

                                            <div class="form-group" style="visibility: hidden;">
                                                        <label for="default" class="col-sm-2 control-label">Group</label>
                                                        <div class="col-sm-10">
                                                            <select name="group" class="form-control" id="groupid">
                                                            <option value="">Select Class</option>
                                                            <?php $sql = "SELECT * from LLBGROUP";
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                            if($query->rowCount() > 0)
                                                            {
                                                            foreach($results as $result)
                                                            {   ?>
                                                            <option
                                                                value="<?php echo htmlentities($result->GRPID); ?>">
                                                                <?php echo htmlentities($result->GRPNAME); ?>
                                                            </option>
                                                            <?php }} ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" style="visibility: hidden;">
                                                        <label for="default" class="col-sm-2 control-label">Group</label>
                                                        <div class="col-sm-10">
                                                            <select name="mgroup" class="form-control" id="mgroupid">
                                                            <option value="">Select Class</option>
                                                            <?php $sql = "SELECT * from LLMGROUP";
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                            if($query->rowCount() > 0)
                                                            {
                                                            foreach($results as $result)
                                                            {   ?>
                                                            <option
                                                                value="<?php echo htmlentities($result->GRPID); ?>">
                                                                <?php echo htmlentities($result->GRPNAME); ?>
                                                            </option>
                                                            <?php }} ?>
                                                            </select>
                                                        </div>
                                                    </div>


                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="submit"
                                                        class="btn btn-primary">Add</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <!-- /.col-md-12 -->
                        </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
        $(function($) {
            $(".js-states").select2();
            $(".js-states-limit").select2({
                maximumSelectionLength: 2
            });
            $(".js-states-hide").select2({
                minimumResultsForSearch: Infinity
            });
        });
        </script>

        
</body>

</html>
<?PHP } ?>