<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    if(isset($_POST["diapazonEnd"])){
        $diapazonEnd = $_POST["diapazonEnd"];
        $number = $_POST["number"];
        echo "$diapazonEnd";
        echo "$number";
        if($diapazonEnd == $number){
            echo "Ви справді екстрасенс!";
        }else if($diapazonEnd < $number){
            echo "Загадане число більше, спробуйте ще раз";
        }else if($diapazonEnd > $number){
            echo "Загадане число менше, спробуйте ще раз";
        }
    }
    ?>
</body>
</html>