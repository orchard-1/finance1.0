<?php

namespace namespace_1;
class A
{
    function __construct()
    {
        echo "object created from class in file 2\n";
    }
}

$obj=new A();
$obj=new \A();