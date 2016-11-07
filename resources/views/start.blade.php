<!DOCTYPE html>
<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>geoTest</title>
        <link href="css/style.css" rel="stylesheet">
        <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
    </head>
    <body>
        <h4>После добавления добавления на карту метка будет добавлена в базу данных, при обновлении страницы на карту будут выведены все метки, которые есть в базе</h4>
        <h6>Координаты доступны по url /coords тип GET, внесение координат в БД по url /coords тип PUT</h6>
        <div id="map" style="width: 600px; height: 400px"></div>
    </body>
</html>

