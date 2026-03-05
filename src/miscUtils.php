<?php

function add_prefix_to_num($n) { # καντο ετσι ωστε η ημερα να αρχιζει απο 0 εάν ειναι μονοψήφια 
    if ($n > 9) {
        return "$n";
    } else {
        return "0$n";
    }
}

?>