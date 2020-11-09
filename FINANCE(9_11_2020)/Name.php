<?php
    #validating Customer name
    function getName(){
    $name=0;
    $count=0;
    do
    {
        if($count==0)
        {
            $name=readline("Enter Customer name :");
            $count++;
        }
        else
        {
            $name=readline("Enter A Valid Customer name :"); 
        }
    }while(!preg_match('/[a-zA-Z]$/i', $name));
    return $name;
}

?>