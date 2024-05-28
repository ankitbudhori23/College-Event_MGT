<?php
include_once 'classes/db1.php';
$result = mysqli_query($conn,"SELECT * FROM staff_coordinator s ,event_info ef ,student_coordinator st,events e where e.event_id= ef.event_id and e.event_id= s.event_id and e.event_id= st.event_id");
?>


<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>EventHub</title>
</head>
    
    <body>
<?php include 'utils/adminHeader.php'?>
 
    
        <div class = "content">
            <div class = "container">
                <div style="bg-color:#f2f2f2; display:flex;justify-content:space-between">
                <span>
<h1>Event details</h1></span>
<span>
<a class="btn btn-default" href = "createEventForm.php" style="bg-color:#f2f2f2;width:150px;background-color: #26bf9c;
    font-size: 18px;">Create Event</a></span>
                </div>
            
            <?php
if (mysqli_num_rows($result) > 0) {
?>
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            
                            <th>Event_name</th>
                            <th>No. of Participents</th>
                            <th>Price</th>
                            <th>Student Co-ordinator</th>
                            <th>Staff Co-ordinator</th>
   
                            <th>Date</th>
                        
                            <th>Time</th>
                            <th>location </th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                     $i=0;
                     while($row = mysqli_fetch_array($result)){
                            
                            echo '<a href="Registered_Participants.php">';
                            echo '<tr>';
                   
                            echo '<td>' .'<a href="Registered_Participants.php?id='.$row['event_id'].'&n='.$row['event_title'].'">'. $row['event_title'] .'</a>'.'</td>';                    
                            echo '<td>' . $row['participents'] . '</td>';
                            echo '<td>' . $row['event_price'] . '</td>';
                            echo '<td>' . $row['st_name'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>'.$row['Date'].'</td>';
                            echo '<td>'.$row['time'].'</td>';
                            echo '<td>'.$row['location'].'</td>';
                            
                            echo '<td>'
                        
                            .'<a class="delete" href="deleteEvent.php?id='.$row['event_id'].'">Delete</a> '
                            .'</td>';
                            echo '</tr>';
                            echo '</a>';
                             

                            
                $i++;
                
                        }
                      
                        ?>
                    </tbody>
                </table>
<?php
}

?>             
              
            </div>
        </div>
        
        <?php require 'utils/footer.php'; ?>
    </body>
</html>
