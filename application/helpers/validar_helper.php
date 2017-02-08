<?php
function decimal_positive($value){
    if($value < 0){
        return false;
    }
    return true;
}
