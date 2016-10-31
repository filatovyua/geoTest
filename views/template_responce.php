<?php
if (!isset($data))
    throw new Exception("Data is not defined");
die(json_encode($data));