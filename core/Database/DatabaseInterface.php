<?php

namespace Core\Database;


interface DatabaseInterface
{


    public function query($statement, $class_name = null, bool $one = false);

    public function prepare($statement, $params = [], $class_name, $one = false);
}
