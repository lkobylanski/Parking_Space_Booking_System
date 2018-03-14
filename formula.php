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
        //including of settings file which contains db login information
        require_once ('settings.php');

        // conect to mySQL db
        $link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if(!$link){
            die("ERROR ".mysqli_connect_error());
        }

        // user data input from formula
        $number = (int)$_POST['number'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $user_name = $_POST['user_name'];
        $phone = $_POST['phone'];
        $reservation_counter = 0;

        $validation_query = "SELECT * FROM `rezerwacje_miejsc` WHERE `NR_MIEJSCA`=".$number." AND (`START` BETWEEN '$start' AND '$end' OR `KONIEC` BETWEEN '$start' AND '$end');";
        $query = "INSERT INTO `rezerwacje_miejsc` (`NR_MIEJSCA`, `START`, `KONIEC`, `IMIE_NAZWISKO`, `TELEFON`) VALUES ('$number', '$start', '$end', '$user_name', '$phone');";

        if($res=mysqli_query($link,$validation_query)){
          while($row=mysqli_fetch_assoc($res)){
            $reservation_counter++;
          }
        }

        if($reservation_counter == 0){
          $result = mysqli_query($link,$query);
          if($result){
            echo "Parking space No. $number has been successfully booked from $start to $end";
          }
          else{
            echo "Error: Something went wrong, you reservation is not saved, please try again!";
          }
        }
        else{
          echo "Unfortunetly there are already $reservation_counter reservations for space No. $number in chosen time. Please select other parking space or different time";
        }
      ?>
      <br><br><br>
      <a href="index.html"><button class="btn btn-warning">Go Back</button></a>
    </div>
</body>
</html>

