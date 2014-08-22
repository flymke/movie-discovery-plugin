<?php

if(ISSET($_GET['k'])) {
    $k = trim(strip_tags($_GET['k']));
    $result = file_get_contents('http://www.movie-discovery.com/api/wp-get-movie.php?k=' . $k);
}

if(ISSET($_GET['m'])) {
    $m = trim(strip_tags($_GET['m']));
    $result = file_get_contents('http://www.movie-discovery.com/api/wp-get-movie.php?m=' . $m);
}

echo $result;

?>