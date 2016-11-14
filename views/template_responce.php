<?php
if (!isset($data))
    throw new Exception("Data is not defined");
if (!$data)
    $data = [];
die(json_encode($data));