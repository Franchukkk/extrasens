<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <?php
        session_start();
        if(!$_POST){
            $_SESSION['blocked_numbers'] = array();
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
                            echo "<h2>Ви справді екстрасенс</h2>";
                        }else{
                            echo "<h2>Ви майже відгадали</h2>";
                        }
                        echo "Правильний діапазон: ";
                        $diapazonStart = $_SESSION["diapazon"];
                        $diapazonEnd1 = $_SESSION["diapazon"]+=9;
                        echo $diapazon-=20;
                        echo "-";
                        echo $diapazon+=9;
                        echo "<br><h3>Тепер виберіть число яке загадав комп'ютер із діапазону</h3>";
                        echo "<select name='diapazon1'>";
                        for($i = $diapazonStart; $i <= $diapazonEnd1;$i++){
                            echo "<option value='$i'>$i</option>";
                        }
                        echo "</select>";
                        echo "<input type='hidden' name='diapazonStart' value='$diapazonStart'>";
                        echo "<input type='submit'>";
                    }else{
                        echo "Left: $attemps rounds";
                    }
                }
                ?>
            <input type="hidden" name="number" value="<?= $number ?>">
            <input type="hidden" name="attemps" value="<?= $attemps ?>">
            </form>
                <?php
                    if(isset($_POST["diapazon1"])){
                        $diapazon1 = $_POST["diapazon1"];
                        if($diapazon1 === $number){
                            echo "Ви справжній екстрасенс, число було $number";
                        }else{
                            if(isset($_POST["diapazonStart"])){
                                $diapazonStart = $_POST["diapazonStart"];
                            }
                            $diapazonSelect = $_SESSION["diapazon"];
                            echo "<b> $diapazonSelect </b>";
                            if($number <= $diapazonStart+=5){
                                echo "<form action='index.php' method='post'>";
                                echo "<select name='diapazonEndSec'>"; //селект номер
                                $ggg1 = $diapazonSelect-=9;
                                $diapazonEndSelect1 = $ggg1+=4;
                                for($i = $diapazonSelect; $i <= $diapazonEndSelect1; $i++){
                                    echo "<option value='$i'>$i</option>";
                                }
                                echo "</select>";
                                echo "середня точка - $diapazonStart";
                                echo "<input type='hidden' name='number' value='$number'>";
                                echo "<input type='submit'>";
                                echo "</form>";
                            }else{
                                echo "<form action='index.php' method='post'>";
                                echo "<select name='diapazonEnd'>";//селект номер 1
                                $ggg = $diapazonSelect;
                                $diapazonEndSelect = $ggg;
                                for($i = $diapazonSelect-=5; $i <= $diapazonEndSelect; $i++){
                                    echo "<option value='$i'>$i h</option>";
                                }
                                echo "</select>";
                                echo "середня точка - $diapazonStart";
                                echo "<input type='hidden' name='number' value='$number'>";
                                echo "<input type='submit'>";
                                echo "</form>";
                                if(isset($_POST["diapazonEnd"])){
                                    echo "<h2>saklas</h2>";
                                    $attemps = $_POST["attemps"];
                                    $diapazonEnd = $_POST["diapazonEnd"];
                                    $numberCheck = $_POST["numberCheck"];
                                    if($diapazonEnd == $numberCheck){
                                        echo "<h2>Вітаємо, ви відгадали!</h2>";
                                    }
                                }else{
                                    echo "babavala";
                                }
                            }
                        }
                    }
                ?>
    </div>
</body>
</html>