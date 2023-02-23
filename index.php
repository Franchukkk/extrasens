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
        // if($number >= $diapazon && $number <= $diapazon+=10){
        //     echo "You win";
        // }
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
                    echo $diapazon-=21;
                    echo "-";
                    echo $diapazon+=10;
                    echo "<br><h3>Тепер виберіть число від 1 до 10</h3>";
                    echo "<select name='diapazon1'>";
                    for($i = 1; $i <= 10;$i++){
                        echo "<option value='$i'>$i</option>";
                    }
                    echo "</select>";
                    echo "<input type='submit'>";
                }else{
                    echo "Left: $attemps rounds";
                }
            }
            if(isset($_POST["diapazon1"])){
                for($l = $diapazon;$l <= $number;$l++){
                    if($l == $number){
                        echo "<h2>$l</h2>";
                    }
                }
            }
            ?>
        <input type="hidden" name="number" value="<?= $number ?>">
        <input type="hidden" name="attemps" value="<?= $attemps ?>">
        <input type="hidden" name="diapazon" value="<?= $diapazon ?>">
        </form>
</body>
</html>