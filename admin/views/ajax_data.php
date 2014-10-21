<?php
/**
 * Get Ajax Data
 *
 * Movie Discovery
 *
 * @package   Movie_Discovery
 * @author    Michael Schoenrock <hello@michaelschoenrock.com>
 * @license   GPL-2.0+
 * @link      https://github.com/flymke/movie-discovery-plugin
 * @copyright 2014 Michael Schoenrock
 */
?>

<?php

if(ISSET($_GET['k'])) {
    $k = trim(strip_tags($_GET['k'])); // keyword
    $p = trim(strip_tags($_GET['p'])); // provider
    $result = file_get_contents('http://www.movie-discovery.com/api/wp-get-movie-json.php?k=' . $k . '&p=' . $p);
}

if(ISSET($_GET['m'])) {
    $m = trim(strip_tags($_GET['m'])); // movie
    $p = trim(strip_tags($_GET['p'])); // provider
    $result = file_get_contents('http://www.movie-discovery.com/api/wp-get-movie-json.php?m=' . $m . '&p=' . $p);
}

echo $result;

?>