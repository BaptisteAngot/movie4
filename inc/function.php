<?php

function pre($array){
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}
function imageMovie($movie){
  ?><img src="posters/<?php echo $movie['id'] ?>.jpg" alt="<?php echo $movie['title']; ?>">
<?php }

function convertToHoursMins($time, $format = '%02d:%02d') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}
