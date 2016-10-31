<?php
interface connectorInterface{
    public function connect();
    public function query($sql);
    public function fetch($resource);
}