
<?php 

// EMI Calculator program in PHP 
// Function to calculate EMI 
function emiCalculator($amount, $intrest, $months) 
{ 
    $emi; 
    while($amount <=0)
    {
        $amount = readline("principal amount should be > 0 : ");
    }
    
    while($intrest <=0)
    {
        $intrest = readline("Intresrt should be > 0 : ");
    }

    try
    {
        if($months<1)
        {
            throw new Exception("MONTHS SHOULD BE >=1 ");
        }
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        $months=readline("\nEnter months:");
    }
    $intrest = $intrest /  (12*100); 
    $emi = ($amount * $intrest * pow(1 + $intrest, $months)) /  (pow(1 + $intrest, $months) - 1); 
    return ceil($emi); 
}
  
?>