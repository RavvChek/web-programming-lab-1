<?php

session_start();

if (!isset($_SESSION['dataHistory'])) {
    $_SESSION['dataHistory'] = array();
}

require_once 'server/validate.php';

$startScriptTime = microtime(true);
$currentTime = dateефиду("H:i:s");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $x = round((double)$_POST["x"], 2);
    $y = (double)$_POST["y"];
    $r = (double)$_POST["r"];
    if (!isValid($x, $y, $r)) {
        http_response_code(400);
        echo "Bad data";
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


    $_SESSION['dataHistory'][] = $receivedData;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="logo.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="src/styles/style.css">
    <title>ravvcheck project</title>
</head>
<body>
<table id="page">
    <tbody>
    <tr>
        <th id="head" colspan="2">
            <!--                    <img alt="Logo picture" src="logo.ico">-->
            Bayanov Ravil * P3234
            <br>
            Variant 1514
        </th>
    </tr>
    <tr>
        <td id="graph">
            <div class="top">
                <h2>Graph</h2>
            </div>
            <div id="image">
                <svg width="300" height="300" xmlns="http://www.w3.org/2000/svg">
                    <line stroke="white" x1="0" x2="300" y1="150" y2="150"></line>
                    <line stroke="white" x1="150" x2="150" y1="0" y2="300"></line>
                    <polygon fill="white" points="150,0 144,15 156,15" stroke="white"></polygon>
                    <polygon fill="white" points="300,150 285,156 285,144" stroke="white"></polygon>

                    <line stroke="white" x1="200" x2="200" y1="155" y2="145"></line>
                    <line stroke="white" x1="250" x2="250" y1="155" y2="145"/>

                    <line stroke="white" x1="50" x2="50" y1="155" y2="145"/>
                    <line stroke="white" x1="100" x2="100" y1="155" y2="145"/>

                    <line stroke="white" x1="145" x2="155" y1="100" y2="100"/>
                    <line stroke="white" x1="145" x2="155" y1="50" y2="50"/>

                    <line stroke="white" x1="145" x2="155" y1="200" y2="200"/>
                    <line stroke="white" x1="145" x2="155" y1="250" y2="250"/>


                    <text fill="white" x="195" y="140">R/2</text>
                    <text fill="white" x="248" y="140">R</text>

                    <text fill="white" x="40" y="140">-R</text>
                    <text fill="white" x="90" y="140">-R/2</text>

                    <text fill="white" x="160" y="105">R/2</text>
                    <text fill="white" x="160" y="55">R</text>

                    <text fill="white" x="160" y="205">-R/2</text>
                    <text fill="white" x="160" y="255">-R</text>

                    <text fill="white" x="160" y="10">Y</text>
                    <text fill="white" x="290" y="140">X</text>

                    <polygon fill="#e8a87c"
                             fill-opacity="0.5"
                             points="200 150, 200 50, 150 50, 150 150"
                             stroke="white"></polygon>


                    <polygon fill="#e8a87c"
                             fill-opacity="0.5"
                             points="250 150, 150 150, 150 200"
                             stroke="white"></polygon>


                    <path d="M 50 150 A 100 100, 90, 0, 0, 150 250 L 150 150 Z"
                          fill="#e8a87c"
                          fill-opacity="0.5"
                          stroke="white"></path>


                    <circle cx="150" cy="150" id="target-dot" r="0" stroke="white" fill="white"></circle>
                </svg>
            </div>
        </td>
        <td id="table" rowspan="2">
            <div class="top">
                <h2>Table</h2>
            </div>
            <div class="table-result">
                <table>
                    <thead>
                    <tr>
                        <th class="column-type1">X</th>
                        <th class="column-type1">Y</th>
                        <th class="column-type1">R</th>
                        <th class="column-type2">Hit Result</th>
                        <th class="column-type3">Current Time</th>
                        <th class="column-type3">Execution Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($_SESSION['dataHistory'] as $value) {
                        echo "<tr>";
                        echo "<td>$value[0]</td>";
                        echo "<td>$value[1]</td>";
                        echo "<td>$value[2]</td>";
                        echo "<td>$value[3]</td>";
                        echo "<td>$value[4]</td>";
                        echo "<td>$value[5]</td>";
                        echo "<tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </td>
    </tr>
    <tr>
        <td id="coordinates">
            <div class="top">
                <h2>Coordinates</h2>
            </div>
            <div class="form">
                <div id="input">
                    <form method="post">
                        <table id="input-table">
                            <tbody>
                            <tr>
                                <td class="label">
                                    <label for="x">Value X:</label>
                                </td>
                                <td>
                                    <select name="x" id="x">
                                        <option value="-4" class="option">-4</option>
                                        <option value="-3" class="option">-3</option>
                                        <option value="-2" class="option">-2</option>
                                        <option value="-1" class="option">-1</option>
                                        <option value="0" class="option">0</option>
                                        <option value="1" class="option">1</option>
                                        <option value="2" class="option">2</option>
                                        <option value="3" class="option">3</option>
                                        <option value="4" class="option">4</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">
                                    <label class="y" for="y">Value Y:</label>
                                </td>
                                <td>
                                    <input id="y" type="text" autocomplete="off" placeholder="from -3 to 5" name="y" maxlength="5">
                                </td>
                            </tr>
                            <tr>
                                <td class="label">
                                    <label>Value R:</label>
                                </td>
                                <td>
                                    <div class="value">
                                        <label for="rbox-label">
                                            <input id="rbox-label" type="checkbox" name="r" value="1">
                                            1
                                        </label>
                                        <label for="rbox-label">
                                            <input class="r" type="checkbox" name="r" value="2">
                                            2
                                        </label>
                                        <label for="rbox-label">
                                            <input class="r" type="checkbox" name="r" value="3">
                                            3
                                        </label>
                                        <label for="rbox-label">
                                            <input class="r" type="checkbox" name="r" value="4">
                                            4
                                        </label>
                                        <label for="rbox-label">
                                            <input class="r" type="checkbox" name="r" value="5">
                                            5
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div id="buttons">
                                        <input type="submit" value="Submit">
                                        <input type="reset" value="Reset">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <!--                                    <input id="clean-table-button" type="submit" value="Clean Table">-->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </td>
    <tr>
        <td class="end" colspan="2">
            ITMO, 2023 ravvcheck
        </td>
    </tr>
    </tbody>
</table>
<script src="src/js/app.js"></script>
<script lang="javascript">
    const form = document.querySelector('form');
    const yInput = document.getElementById('y');
    const submitButton = document.querySelector('input[type="submit"]');
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const yRegex = /^-?\d+(\.\d+)?$/;

    for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('click', function() {
            for (let j = 0; j < checkboxes.length; j++) {
                if (checkboxes[j] !== this) {
                    checkboxes[j].checked = false;
                }
            }
        });
    }

    yInput.addEventListener('input', function () {
        const yValue = yInput.value;
        submitButton.disabled = !(!isNaN(yValue) && yValue >= -3 && yValue <= 5 && yRegex.test(yValue));
        console.log(parseFloat(yInput.value));
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        //const xValue = document.getElementById('x').value;
        //const yValue = parseFloat(yInput.value);
        const rValues = Array.from(document.querySelectorAll('input[name="r"]:checked')).map(input => input.value);
        if (rValues.length === 0) {
            submitButton.disabled === false;
            return;
        } else {
            submitButton.disabled === true;
        }
        form.submit();

    });
</script>
<script src="src/js/app.js"></script>
</body>
</html>