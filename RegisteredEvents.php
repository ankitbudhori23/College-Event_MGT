<?php
require_once 'utils/header.php';
require_once 'utils/styles.php';

$usn=$_POST['usn'];


include_once 'classes/db1.php';
$result = mysqli_query($conn,"SELECT * FROM staff_coordinator s ,event_info ef ,student_coordinator st,events e ,registered r where r.usn = $usn and ef.event_id= r.event_id and r.event_id= e.event_id and r.event_id= s.event_id and r.event_id= st.event_id ");
?>

<div class = "content">
            <div class = "container">
             <?php
if (mysqli_num_rows($result) > 0) {
?> <center><h2><?php echo $usn; ?></h2></center>
<h1> Registered Events</h1>
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            
                            <th>Event_name</th>             
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
                    while($row = mysqli_fetch_array($result)) {

                            echo '<tr>';
                            echo '<td>' . $row['event_title'] . '</td>';                    
                            echo '<td>' . $row['st_name'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                           
                            echo '<td>'.$row['Date'].'</td>';
                            echo '<td>'.$row['time'].'</td>';
                            echo '<td>'.$row['location'].'</td>';
                            
                         
                            echo '</tr>';  

                            $i++;
                        }
                      
                        ?>
                    </tbody>
                </table>
                    <?php }
                    else{
                    echo '<center><h1>No registration details found for '.$usn.' </h1></center>';
                    
                    }?>
                
               
            </div>
        </div>
        <?php
    
        // $result = mysqli_query($conn, );
        ?>
        
        </div>
        <?php include 'utils/footer.php'; ?> 