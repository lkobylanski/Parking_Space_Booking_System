<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css" />
	
</head>
<body>
    <div class="container">
        <?php
        // próba wystawienia RESTful webservice
        require_once('settings.php');

        $link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if(!$link){
            die("ERROR ".mysqli_connect_error());
        }

        if(!isset($_GET['function'])){
            //die('Some error occured');
        }

        function GetReservations($db){
            $num = (int)$_POST['num'];
            $sql = mysqli_query($db,"SELECT * FROM `rezerwacje_miejsc` WHERE `NR_MIEJSCA`=".$num.";");
            $data = array();

            if(mysqli_num_rows($sql) > 0){
                while($row = mysqli_fetch_array($sql)){
                    $data[] = $row['NR_MIEJSCA']." ".$row['START']." ".$row['KONIEC']."<br><br>";
                    $data[] = $row['NR_MIEJSCA']." ".$row['START']." ".$row['KONIEC']."<br><br>";
                }
            }
            print json_encode($data);
        }
        
        GetReservations($link);
        ?>
        <br><br><br>
        <a href="index.html"><button class="btn btn-warning">Go Back</button></a>
    </div>
</body>
</html>

