 <?php
 #validate mobile
function getMobile(){
    $count=0;
    $mobile=0;
    do
    {
        if($count==0){
            $mobile=readline("\nEnter Mobile number : ");
            $count++;
        }else
        {
            $mobile=readline("\nEnter A valid Mobile number : ");
        }
    }while(!preg_match('/[6-9][0-9]{9}/', $mobile));
    return $mobile;
}

?>