<?php
$a=$_GET['p'];
$c=$_GET['c'];
$ename=$_GET['e'];
session_start();
include_once 'classes/db1.php';
include 'test.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>EventHub</title>
        
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        
    </head>
    <body>
    <?php require 'utils/header.php'; ?>
    <div class ="content"><!--body content holder-->
            <div class = "container">
                <div class ="col-md-6 col-md-offset-3">
    <form method="POST">

   
        <label>Enrollment No:</label><br>
        <input type="text" name="usn" class="form-control" required><br><br>

        <label>Student Name:</label><br>
        <input type="text" name="name" class="form-control" required><br><br>

        <label>Branch:</label><br>
        <input type="text" name="branch" class="form-control" required><br><br>

        <label>Semester:</label><br>
        <input type="text" name="sem" class="form-control" required><br><br>

        <label>Email:</label><br>
        <input type="text" name="email"  class="form-control" required ><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone"  class="form-control" required><br><br>
        <label>Aadhar No:</label><br>
        <input type="text" name="aadhar"  class="form-control" required><br><br>
        <label>College:</label><br>
        <select name="college" id="college">
        <?php 

        
        $result = mysqli_query($conn,"SELECT * FROM colleges");

        while($row = mysqli_fetch_array($result)) { ?>
        
            <option name="college" value=<?php echo $row["id"]?>><?php echo $row["name"]?></option>
            <?php 
        } ?>
        </select><br><br>
        <button type="submit" name="update" required>Submit</button><br><br>
        <a href="usn.php" ><u>Already registered ?</u></a>

    </div>
    </div>
    </div>
    </form>
    

    <?php require 'utils/footer.php'; ?>
    </body>
</html>

<?php

    if (isset($_POST["update"]))
    {
        $usn=$_POST["usn"];
        $name=$_POST["name"];
        $branch=$_POST["branch"];
        $sem=$_POST["sem"];
        $email=$_POST["email"];
        $phone=$_POST["phone"];
        $college=$_POST["college"];
        $aadhar=$_POST["aadhar"];

        if( !empty($usn) || !empty($aadhar) || !empty($name) || !empty($branch) || !empty($sem) || !empty($email) || !empty($phone) || !empty($college) )
        {
        
            include 'classes/db1.php';     
                $INSERT="INSERT INTO participent (usn,name,branch,sem,aadhar,email,phone,college) VALUES('$usn','$name','$branch','$sem','$aadhar','$email','$phone','$college')";
                $i="INSERT INTO registered (usn,event_id) VALUES('$usn','$a')";
                $par = "update events set participents=$c where event_id='$a'";
                if($conn->query($INSERT)===True && $conn->query($par)===True && $conn->query($i)===True){
                    
                    $einfo = mysqli_query($conn,"select *,c.phone as ph from event_info e,staff_coordinator c ,student_coordinator s where e.event_id='$a' and e.event_id=c.event_id and e.event_id=s.event_id");
                    $rr = mysqli_fetch_array($einfo);
                    $htmlContent = ' 
                            <html> 
                            <head> 
                                <title>Registration Successfull for '.$ename.' event</title> 
                            </head> 
                            <body> 
                                <h1>Registration Successfull for '.$ename.' event</h1> 
                                <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%; text-align: center;"> 
                                    <tr> 
                                        <th>Name:</th><td>'.$name.'</td> 
                                    </tr> 
                                    <tr> 
                                        <th>Enrollment No:</th><td>'.$usn.'</td> 
                                    </tr> 
                                    <tr> 
                                        <th>Email:</th><td>'.$email.'</td> 
                                    </tr> 
                                    <tr> 
                                        <th>Phone:</th><td>'.$phone.'</td> 
                                    </tr> 
                                    <tr> 
                                        <th>Event Date:</th><td>'.$rr['Date'].'</td> 
                                    </tr> 
                                    <tr> 
                                        <th>Event Time:</th><td>'.$rr['time'].'</td> 
                                    </tr> 
                                    <tr> 
                                    <th>Event Location:</th><td>'.$rr['location'].'</td> 
                                    </tr> 
                                    <tr> 
                                        <th>Student Coordinator Name:</th><td>'.$rr['st_name'].'</td> 
                                    </tr> 
                                    <tr> 
                                        <th>Student Coordinator Phone:</th><td>'.$rr['phone'].'</td> 
                                    </tr> 
                                    <tr> 
                                        <th>Staff Coordinator Name:</th><td>'.$rr['name'].'</td> 
                                    </tr> 
                                    <tr> 
                                        <th>staff Coordinator Phone:</th><td>'.$rr['ph'].'</td> 
                                    </tr> 
                                </table> 
                            </body> 
                            </html>'; 

                    $_SESSION['msg'] = "Registered Successfully check your mail";
                    smtp_mailer($email,'Registration Successfull for '.$ename.' event',$htmlContent);
                    echo "<script>
                    alert('Registered Successfully!');
                    window.location.href='usn.php';
                    </script>";
                }
                else
                {
                    echo"<script>
                    alert(' Already registered this usn');
                    window.location.href='usn.php';
                    </script>";
                }
               
                $conn->close();
            
        }
        else
        {
            echo"<script>
            alert('All fields are required');
            window.location.href='register.php';
                    </script>";
        }
    }
    
?>