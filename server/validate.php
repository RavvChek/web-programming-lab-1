<?php
const R_MIN = 1;
const R_MAX = 5;
const Y_MAX = 5;
const Y_MIN = -3;
function isValid($x, $y, $r){
    if (!is_double($r) || !is_double($y) || !is_double($x)) {
        return false;
    }
    if ($r < R_MIN || $r > R_MAX || Y_MAX < $y || Y_MIN > $y) {
        return false;
    }
    return true;
}
function isHit($x, $y, $r){
    return isCircleZone($x, $y, $r) || isTriangleZone($x, $y, $r) || isRectangleZone($x, $y, $r);
}

function isTriangleZone($x, $y, $r){
    return $x >= 0 && $y <= 0 && $y >= ($x - $r) / 2;
}
function isCircleZone($x, $y, $r){
    return $y <= 0 && $x <= 0 && $y <= sqrt($r ** 2 - $x ** 2);
}
function isRectangleZone($x, $y, $r){
    return $x >= 0 && $y >= 0 && $y <= $r && $x <= $r / 2;
}