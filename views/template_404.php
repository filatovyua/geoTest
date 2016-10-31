<?php
print_r($_SERVER);
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    die(json_encode(["error"=>404,"message"=>"page not found"]));
}else{
  ?>
    <!DOCTYPE html>
<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>geoTest</title>
    </head>
    <body>
        <h1>Страница не найдена!</h1>
    </body>
</html>
    <?php  
}
?>
