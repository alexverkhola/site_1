<!DOCTYPE html>
<?php
include_once 'data.php';
include_once 'Month.php';

if (isset($_GET['month'])) {

    $current_month = $_GET['month'];
} else {

    $current_month = 'january';
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <title><?php echo ucfirst($current_month) ?></title>

        <style>
            html {
                position: relative;
                min-height: 100%;
            }
            body{
                margin-bottom: 10vh;
                background: url(<?php
                echo $arr[$current_month];
                ?>) no-repeat;
                -moz-background-size: 100%; /* Firefox 3.6+ */
                -webkit-background-size: 100%; /* Safari 3.1+ и Chrome 4.0+ */
                -o-background-size: 100%; /* Opera 9.6+ */
                background-size: 100%; /* Современные браузеры */
            }

            footer {
                position: absolute;
                bottom: 15vh;
                width: 100%;
                height: 10vh; /*высота футера будет зависеть от высоты экрана*/
            }

            img{
                border-radius: 15px;
            }
            table {
                color: white;
                font-size: 1.4em;
            }
            
            caption {
                caption-side: top;
                color: white;
                text-align: center;
                font-size: 2em;
            }

        </style>
    </head>
    <body>
        <main role="main" class="container">
            <!-- Paсчёт и отрисовка календаря --> 
            <?php
            $month = date('m', strtotime($current_month));

            $year = date('Y');

            $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            
            $day_of_week = date('N', mktime(0,0,0, $month, 1, $year));
            
            $bool = true; // Используется один раз для отсчёта пробелов в календаре
//            echo "<p>",$month;
//            echo "<p>",$year;
//            echo "<p>",$days;
//            echo "<p>",$day_of_week;
//            echo "<p>";
            
            ?>
            <table>
                <caption><?php echo ucfirst($current_month) ?></caption>
                <tr>
                    <th>&nbsp;Пн</th>
                    <th>&nbsp;Вт</th>
                    <th>&nbsp;Ср</th>
                    <th>&nbsp;Чт</th>
                    <th>&nbsp;Пт</th>
                    <th>&nbsp;Сб</th>
                    <th>&nbsp;Вс</th>
                </tr>
                <?php 
                    for($i = 1, $x = 1; $i <= $days; $i++){
                        
                        //Отсчитаем пробелы
                        if($bool){
                            for($k = $day_of_week - 1; $k != 0; $k--){
                                echo '<td>', '';
                                $x++;

                            }
                        $bool = FALSE;
                        }
                        
                        //Делаю здвиг на два пробела для чисел из одной цифры
                        if(strlen((string)$i) == 1){
                        echo '<td>&nbsp;&nbsp;'.$i.'</td>';
                        } else {
                            echo '<td>&nbsp;'.$i.'</td>';
                        }
                 
                        //Перенос каждые 7 дней на новую строку.
                        if($x == 7){
                            echo '<tr>';
                            $x = 1;
                                            continue;
                        }
                             $x++;
                    } 
                ?>
            
            </table>
        </main>
        <?php
        
        $month = new Month();

        $previous = $month->previous($current_month);
        $next = $month->next($current_month);
        ?>
        <footer class="footer">
            <div class="container">

                <div class="row">
                    <div class="col-6 text-left">
                        <a href="?month=<?php echo $previous ?>">
                            <img class="center-block" src="<?php echo $arr[$previous] ?>" width="150" height="100">
                        </a>
                    </div>

                    <div class="col-6 text-right">    
                        <a  href="?month=<?php echo $next ?>">
                            <img class="center-block" src="<?php echo $arr[$next] ?>" width="150" height="100">
                        </a>
                    </div>
                </div>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    </body>
</html>
