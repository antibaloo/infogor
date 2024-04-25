<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Slick slider</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="slider.css"/>
</head>
<body>
  
  <?php
  require_once('../bd.php');
  require_once('../functions.php');
  require_once('../auth.php');
  require_once('../auth_functions.php');
  $query="SELECT * FROM `m_slides` WHERE `status`='1' AND `target` = 'm' ORDER BY rand() LIMIT 21;";
  $str = mysqlq($query);
  $arsql=mysql_fetch_assoc($str);
  echo '<div class="slContainer"><div class="slResponsive">';
  do {
    $file=$arsql['file'];
  ?>
  <div class="coverSlide">
    <a href="<?php echo $arsql['link'.langpx()]; ?>">
      <img src="../upload/slides/<?php echo d($file);?>">
      <div class="htmlSl">
        <?php echo $arsql['html']?>
      </div>
      <span class="adSpan"><?php echo $arsql['info']?></span>
    </a>
    <?php echo $arsql['html_ru']?>
  </div>
  <?php
  } while ($arsql=mysql_fetch_assoc($str));
  echo '</div></div>';
  ?>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js" integrity="sha512-eP8DK17a+MOcKHXC5Yrqzd8WI5WKh6F1TIk5QZ/8Lbv+8ssblcz7oGC8ZmQ/ZSAPa7ZmsCU4e/hcovqR8jfJqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="slider.js"></script>
</body>
</html>