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
    session_start();
    if(!$_POST){
        $number = rand(1,100);
        $attemps = 3;
    }else{
        $number = $_POST["number"];
        $attemps = $_POST["attemps"];
    }
    echo $number;
    if(isset($_POST["diapazon"])){
        $attemps--;
        $diapazon = $_POST["diapazon"];
        $_SESSION["diapazon"] = $diapazon;
    }
    ?>
    <form action="index.php" method="post">
        <select name="diapazon">
            <?php
            for ($j = 0; $j < 10; $j++) { // цикл для десяти діапазонів
                $start = $j * 10 + 1; // початок поточного діапазону
                $end = $start + 9; // кінець поточного діапазону
                echo "<option value='$start'>$start - $end</option>"; // опція з діапазоном
            }
            ?>
        </select>
        <input type="hidden" name="number" value="<?= $number ?>">
        <input type="hidden" name="attemps" value="<?= $attemps ?>">
        <input type="submit">
    </form>
        <form action="index.php" method="post">
            <?php
            if(isset($_POST["diapazon"])){
                if($attemps == 0 || $number >= $diapazon && $number <= $diapazon+=10){
                    if($diapazon && $number <= $diapazon+=10){
                        echo "<h2>Ви відгадали</h2>";
                    }else{
                        echo "<h2>Ви майже відгадали</h2>";
                    }
                    echo "Правильний діапазон:";
                    $diapazonStart = $_SESSION["diapazon"];
                    $diapazonEnd1 = $_SESSION["diapazon"]+=9;
                    echo $diapazon-=20;
                    echo "-";
                    echo $diapazon+=9;
                    echo "<br><h3>Тепер виберіть число яке загадав комп'ютер із діапазону</h3>";
                    echo "<select name='diapazon1'>";
                    for($i = $diapazonStart; $i <= $diapazonEnd1;$i++){
                        if($i == 0){
                            echo "<option value='$i'>10</option>";
                        }else{
                            echo "<option value='$i'>$i</option>";
                        }
                    }
                    echo "</select>";
                    echo "<input type='submit'>";
                }else{
                    echo "Left: $attemps rounds";
                }
            }
            if(isset($_POST["diapazon1"])){
                $diapazon1 = $_POST["diapazon1"];
                if($diapazon1 === $number){
                    echo "Ви вгадали, число було $number";
                }else{
                    echo $_SESSION['diapazon'];
                    echo "<h2>$diapazon1</h2>";
                    $diapazonSelect = $_SESSION["diapazon"];
                    echo "<select name='diapazonEnd'>";
                    for($i = $diapazon1; $i >= $diapazonSelect; $i++){
                        echo "<option value='$i'>$i</option>";
                    }
                    echo "</select>";  
                }
            }
            ?>
        <input type="hidden" name="number" value="<?= $number ?>">
        <input type="hidden" name="attemps" value="<?= $attemps ?>">
        </form>
</body>
</html>