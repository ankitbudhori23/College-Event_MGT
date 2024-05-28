<div class="container">
            <div class="col-md-12">
            <hr>
            </div>

<div class="row">
                <section>
                    <div class="container">
                        <div class="col-md-6">
                             

                          <img src=" <?php  echo $row['img_link'];?>" class="img-responsive">
                        </div>
                        <div class="subcontent col-md-6">                        
                            <h1 style="color:#003300 ; font-size:38px ;" ><u><strong><?php echo '<td>' . $row['event_title'] . '</td>';?></strong></u></h1><!--title-->
                            <p style="color:#003300  ;font-size:20px "><!--content-->
                            <?php
                            
                            echo 'id:' . $row['event_id'] .'<br>';
                            echo 'Date:' . $row['Date'] .'<br>'; 
                            echo 'Time:' . $row['time'] .'<br>'; 
                            echo 'Location:' . $row['location'] .'<br>'; 
                            echo 'Student Co-ordinator:' . $row['st_name'] .'<br>'; 
                            echo 'Staff Co-ordinator:' . $row['name'] .'<br>'; 
                            echo 'Event Price:' . $row['event_price'].'<br>' ;
                            $a="register.php?p=".$row["event_id"]."&c=".$row["participents"]."&e=".$row["event_title"];
                            ?>
                            </p>
                            
                            <br><br>

                             <a class="btn btn-default" href="<?php echo $a ?>"> <span class="glyphicon glyphicon-circle-arrow-right"></span>Register</a>
                            
                                                        </div><!--subcontent div-->
                    </div><!--container div-->
                </section>
</div>
 </div><!--row div-->