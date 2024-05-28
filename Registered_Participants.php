<?php
$e_id=$_GET['id'];
$e_n=$_GET['n'];
include_once 'classes/db1.php';

if(isset($_GET['c']))
{
  $c=$_GET['c'];
  $result = mysqli_query($conn,"SELECT p.usn,p.name,p.branch,p.sem,p.email,p.phone,c.name as cname FROM events,registered r ,participent p,colleges c WHERE c.id=p.college and events.event_id=r.event_id and events.event_id='$e_id' and r.usn=p.usn and p.college='$c' ");
}else{
  $result = mysqli_query($conn,"SELECT p.usn,p.name,p.branch,p.sem,p.email,p.phone,c.name as cname FROM events,registered r ,participent p,colleges c WHERE c.id=p.college and events.event_id=r.event_id and events.event_id='$e_id' and r.usn=p.usn ");
}
?>
<!DOCTYPE html>
<html>

<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>EventHub</title>
        <title></title>
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        
    </head>

<body><?php include 'utils/adminHeader.php'?>
<div class = "content">
<div class = "container">

<?php
if (mysqli_num_rows($result) > 0) {
?>
<div style="display: flex;
    justify-content: space-between;
    align-items: center;
">
<h1><?php echo $e_n; ?></td></h1>

<div class="dropdown">
  <label for="c">choose a college</label>
  <select id="c" onchange="if (this.value) window.location.href=this.value">
  <option value="choose">Choose</option>
  <option value="http://localhost:8080/project/Registered_Participants.php?id=<?php echo $e_id ?>&n=<?php echo $e_n ?>">All Colleges</option>
  <?php 
$res = mysqli_query($conn,"SELECT * FROM colleges ORDER BY name");
while ($row = mysqli_fetch_array($res)) {
?>
<option value="http://localhost:8080/project/Registered_Participants.php?id=<?php echo $e_id ?>&n=<?php echo $e_n ?>&c=<?php echo $row["id"] ?>"><?php echo $row["name"]; ?></option>
  <?php
      }
      ?>  
  </select>
</div>
</div>

 <table class="table table-hover" >
  
  <tr>
    <th> S.No </th>
  <th>USN</th>
    <th>Name</th>
    <th>Branch</th>
    <th>Sem</th>
    <th>Email</th>
    <th>Phone</th>
    <th>College</th>
  </tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
  <td><?php echo $i+1; ?></td>
<td><?php echo $row["usn"]; ?></td>
    <td><?php echo $row["name"]; ?></td>
    <td><?php echo $row["branch"]; ?></td>
    <td><?php echo $row["sem"]; ?></td>
    <td><?php echo $row["email"]; ?></td>
    <td><?php echo $row["phone"]; ?></td>
    <td><?php echo $row["cname"]; ?></td>
   
</tr>
<?php
$i++;
}
?>
</table>
 <?php
}
else{
    echo "<h1>No result found</h1>";
}
?>
</div>
</div>
<?php include 'utils/footer.php'?>;
 </body>
</html>