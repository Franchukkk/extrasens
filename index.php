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
        <h1>Перевірьмо твої екстрасенсорні здібності!</h1>
        <h2>Вгадай діапазон із якого я загадав число</h2>
        <?php
        session_start();
        if(!$_POST){
            $number = rand(1,100);
            $true = floor($number/10)*10;
        }else{
            $number = $_POST["number"];
        }
        echo $number;
        if(isset($_POST["diapazon"])){
            $diapazon = $_POST["diapazon"];
            $_SESSION["diapazon"] = $diapazon;
        }
        ?>
        <?php if(!isset($_POST["diapazon1"]) && !isset($_POST["diapazonEnd"])){?>
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
            <input type="hidden" name="true" value="<?= $true ?>">
            <input type="hidden" name="number" value="<?= $number ?>">
            <input type="submit">
        </form>
        <?php }?>
            <form action="index.php" method="post">
                <?php
                    if(isset($_POST["diapazon"])){
                            echo "<h2>Йдемо далі !</h2>";
                            $diapazon = $_POST["diapazon"];
                            $number = $_POST["number"];
                            $true = $_POST["true"];
                            $diapazonStart = $_POST["true"]+=1;
                            $diapazonEnd1 = $_POST["true"]+=9;
                            echo "Правильний діапазон: $diapazonStart - $diapazonEnd1";
                            echo "<br><h3>Тепер виберіть число яке загадав комп'ютер із діапазону</h3>";
                            echo "<select name='diapazon1'>";
                            for($i = $diapazonStart; $i <= $diapazonEnd1; $i++){
                                echo "<option value='$i'>$i</option>";
                            }
                            echo "</select>";
                            echo "<input type='hidden' name='diapazonStart' value='$diapazonStart'>";
                            echo "<input type='hidden' name='true' value='$true'>";
                            echo "<input type='hidden' name='diapazon2' value='$diapazon'>";
                            echo "<input type='submit'>";
                    }
                ?>
            <input type="hidden" name="number" value="<?= $number ?>">
            </form>
                <?php
                    if(isset($_POST["diapazon1"])){
                        $diapazon1 = $_POST["diapazon1"];
                        $diapazon = $_POST["diapazon2"];
                        if($diapazon1 === $number){
                            if($number >= $_POST["diapazon2"] && $number <= $_POST["diapazon2"]+=9){
                                echo "<h2>Ви СУПЕР-ПУПЕР екстрасенс</h2>";
                            }else{
                                echo "<h2>Ви екстрасенс 1 рівня, число справді було $number</h2>";
                                echo "<p><a href='index.php'>На головну</a></p>";
                            }
                        }else{
                            echo "Майже відгадали, у вас буде ще шанс";
                            if(isset($_POST["diapazonStart"])){
                                $diapazonStart = $_POST["diapazonStart"];
                            }
                            $diapazonSelect = $_POST["true"];
                            if($number < $diapazonStart+=5){
                                echo "<form action='index.php' method='post'>";
                                echo "<select name='diapazonEnd'>"; //селект номер
                                $ggg1 = $diapazonSelect+=1;
                                $diapazonEndSelect1 = $ggg1+=4;
                                for($i = $diapazonSelect; $i <= $diapazonEndSelect1; $i++){
                                    echo "<option value='$i'>$i</option>";
                                }
                                echo "</select>";
                                echo "<input type='hidden' name='number' value='$number'>";
                                echo "<input type='hidden' name='diapazonSelect' value='$diapazonSelect'>";
                                echo "<input type='hidden' name='diapazonStart' value='$diapazonStart'>";
                                echo "<input type='submit'>";
                                echo "</form>";
                            }else{
                                echo "<form action='index.php' method='post'>";
                                echo "<select name='diapazonEnd'>";//селект номер 1
                                $ggg = $diapazonSelect+=11;
                                $diapazonEndSelect = $ggg;
                                $diapazonEndSelectEn = $diapazonEndSelect+=4;
                                for($i = $diapazonSelect-=5; $i <= $diapazonEndSelect-=1; $i++){
                                    echo "<option value='$i'>$i</option>";
                                }
                                echo "</select>";
                                echo "<input type='hidden' name='number' value='$number'>";
                                echo "<input type='hidden' name='diapazonSelect' value='$diapazonSelect'>";
                                echo "<input type='hidden' name='diapazonStart' value='$diapazonStart'>";
                                echo "<input type='submit'>";
                                echo "</form>";
                                if(isset($_POST["diapazonEnd"])){
                                    $diapazonEnd = $_POST["diapazonEnd"];
                                    $numberCheck = $_POST["numberCheck"];
                                    if($diapazonEnd == $numberCheck){
                                        echo "<h2>Вітаємо, ви екстрасенс 2 рівня!</h2>";
                                        echo "<a href='index.php'>На головну</a>";
                                    }
                                }
                            }
                        }
                    }
                ?>
    <?php 
        if(isset($_POST["diapazonEnd"])){
            $diapazonSelect = $_POST["diapazonSelect"];
            $diapazonEnd = $_POST["diapazonEnd"];
            $diapazonStart = $_POST["diapazonStart"];
            $number = $_POST["number"];
            if($diapazonEnd == $number){
                echo "Ви справді екстрасенс!";
            }else if($diapazonEnd < $number){
                echo "Загадане число більше, спробуйте ще раз";
            }else if($diapazonEnd > $number){
                echo "Загадане число менше, спробуйте ще раз";
            }
            if($number < $diapazonStart){
                echo "<form action='index.php' method='post'>";
                echo "<select name='diapazonEnd'>"; //селект номер
                $ggg1 = $diapazonSelect;
                $diapazonEndSelect1 = $ggg1+=4;
                for($i = $diapazonSelect; $i <= $diapazonEndSelect1; $i++){
                    echo "<option value='$i'>$i</option>";
                }
                echo "</select>";
                echo "<input type='hidden' name='number' value='$number'>";
                echo "<input type='hidden' name='diapazonSelect' value='$diapazonSelect'>";
                echo "<input type='hidden' name='diapazonStart' value='$diapazonStart'>";
                echo "<input type='hidden' name='checker'>";
                echo "<input type='submit'>";
                echo "</form>";
                if(isset($_POST["diapazonEnd"])){
                    $diapazonEnd = $_POST["diapazonEnd"];
                    if($diapazonEnd == $number){
                        echo "<h2>Вітаємо, ви екстрасенс 2 рівня!</h2>";
                        echo "<a href='index.php'>На головну</a>";
                    }else if($diapazonEnd !== $number && isset($_POST["checker"])){
                        echo "<h2>На жаль, ви не екстрасенс</h2>";
                    }
                }
            }else{
                echo "<form action='index.php' method='post'>";
                echo "<select name='diapazonEnd'>";//селект номер 1
                $ggg = $diapazonSelect;
                $diapazonEndSelect = $ggg+=5;
                for($i = $diapazonSelect+=1; $i <= $diapazonEndSelect; $i++){
                    echo "<option value='$i'>$i</option>";
                }
                echo "</select>";
                echo "<input type='hidden' name='number' value='$number'>";
                echo "<input type='hidden' name='diapazonSelect' value='$diapazonSelect'>";
                echo "<input type='hidden' name='diapazonStart' value='$diapazonStart'>";
                echo "<input type='hidden' name='checker'>";
                echo "<input type='submit'>";
                echo "</form>";
                if(isset($_POST["diapazonEnd"])){
                    $diapazonEnd = $_POST["diapazonEnd"];
                    if($diapazonEnd == $number){
                        echo "<h2>Вітаємо, ви екстрасенс 2 рівня!</h2>";
                        echo "<a href='index.php'>На головну</a>";
                    }else if($diapazonEnd !== $number && isset($_POST["checker"])){
                        echo "<h2>На жаль, ви не екстрасенс</h2>";
                    }
                }
            }
        }
    ?>
    </div>
</body>
</html>