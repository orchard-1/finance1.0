<?php
function integer($msg="Enter a number : ")
{
    $cnt=0;
    do
    {
        if($cnt==0){
            $a= readline($msg);
            $cnt++;
        }
        else
        {
            $a= readline("Enter a numeric value :");
        }
   
    }while(!is_numeric($a));
    return (int)$a;
}

?>