<?php
require_once 'validate.php';

date_default_timezone_set('Europe/Moscow');

session_start();

$startScriptTime = microtime(true);
$currentTime = date("H:i:s");


$x = round((double)$_POST["x"], 2);
$y = round((double)$_POST["y"], 2);
$r = (double)$_POST["r"];

if (!isValid($x, $y, $r)) {
    http_response_code(400);
    echo "Bad data";
    return;
}

$hitResult = isHit($x, $y, $r) ?
    "<span style='color: green'>True</span>" :
    "<span style='color: red'>False</span>";


$scriptExecutionTime = number_format(microtime(true) - $startScriptTime, 8, ".", "") * 1000000;

$receivedData = array(
    $x,
    $y,
    $r,
    $hitResult,
    $currentTime,
    $scriptExecutionTime,
    );

if (!isset($_SESSION['dataHistory'])) {
    $_SESSION['dataHistory'] = array();
}

array_push($_SESSION['dataHistory'], $receivedData);

echo "<div class=\"table-result\">
                <thead>
                    </tr>
                        <span>X</span>
                        <span>Y</span>
                        <span>R</span>
                        <span>Hit result</span>
                        <span>Execution time</span>
                        <span>Current time</span>
                    </tr>

                ";

foreach ($_SESSION['dataHistory'] as $value) {
                 echo "<span>$value[0]</span>";
                    echo "<span>$value[1]</span>";
                    echo "<span>$value[2]</span>";
                    echo "<span>$value[3]</span>";
                    echo "<span>$value[4]</span>";
                    echo "<span>$value[5]</span>";

}

echo "</div>
        </div>";

