<?php

date_default_timezone_set('Asia/Singapore');
$date = date('Y-m-d H:i:s', time());
if(isset($_GET['type'])&&$_GET['type']!=null){
    if($_GET['type']==1||$_GET['type']==2||$_GET['type']==3||$_GET['type']==4){
        $type = $_GET['type'];
    }
}


header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename='.$date.'report.xls');
echo "<table border='1'>";

echo "<tr>";

    echo "<th>#</th>";
    echo "<th>Date</th>";
    echo "<th>Place</th>";
    echo "<th>Severity</th>";
    echo "<th>IP & Port</th>";
    echo "<th>Desc</th>";


echo "</tr>";

$handle = fopen("C:\\xampp\\htdocs\\swap.log", "r");
if ($handle) {
    $counter = 0;
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $counter++;
        

        $array = explode("] ",$line);
        // print_r($array);


        //removes all [
        $date = str_replace('[','',$array[0]); 
        $date = substr($date, 0, strpos($date, "."));


        $ip = str_replace('[','',$array[3]);
        $ip = str_replace('client','',$ip); 
        









        


        //if custom
        $custom = $array[4];
        //only custom has tpamc
        if (strpos($custom, 'TPAMC') !== false) {
            $custom=explode(":",$custom);
            // print_r($custom);

            $place=$custom[1];
            $severity=$custom[2];
            $desc=$custom[4];

            if(isset($type)&&$type!=null){
           
            
            

                if($severity==$type){
                    echo "<tr>";
                    echo "<td>$counter</td>";
                    echo "<td>$date</td>";
                    echo "<td>$place</td>";
    
                    if($severity==1){
                        echo "<td>Warning</td>";
    
                    }elseif($severity==2){
                        echo "<td>Error</td>";
                        
    
                    }elseif($severity==3){
                        echo "<td>Alert</td>";
    
                    }elseif($severity==4){
                        echo "<td>Emergency</td>";
    
                    } else {
                        echo "<td>-</td>";
                    }
                    
                    echo "<td>$ip</td>";
                    echo "<td>$desc</td>";
    
    
    
    
                    echo "</tr>";
    
                }
            } else {
                echo "<tr>";
                echo "<td>$counter</td>";
                echo "<td>$date</td>";
                echo "<td>$place</td>";
    
                if($severity==1){
                    echo "<td>Warning</td>";
    
                }elseif($severity==2){
                    echo "<td>Error</td>";
                    
    
                }elseif($severity==3){
                    echo "<td>Alert</td>";
    
                }elseif($severity==4){
                    echo "<td>Emergency</td>";
    
                } else {
                    echo "<td>-</td>";
                }
                
                echo "<td>$ip</td>";
                echo "<td>$desc</td>";
    
    
    
    
                echo "</tr>";
    
            }
            
        }

        
        

        

        


        


        













        
        

        // echo "<br><br><br>";

        
    }

    fclose($handle);
} else {
    // error opening the file.
} 

?>