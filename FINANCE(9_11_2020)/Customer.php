<?php

class Customer extends BajajFinance implements LoginSystem
{
    private $custName;
    private $custAge;
    private $custMob;
    private $custAddr;
    private $custSal;
    private $custPass;
    public  $custLoans=array();
   

    public function getName()
    {
        return $this->custName;
    }


    public function setName($custName)
    {
        $this->custName = $custName;

        return $this;
    }

 
    public function getAge()
    {
        return $this->custAge;
    }


    public function setAge($custAge)
    {
        $this->custAge = $custAge;

        return $this;
    }


    public function getMobile()
    {
        return $this->custMob;
    }

 
    public function setMobile($custMob)
    {
        $this->custMob = $custMob;

    }

 
    public function getAddress()
    {
        return $this->custAddr;
    }


    public function setAddress($custAddr)
    {
        $this->custAddr=$custAddr;

    }
 
    public function getPassword()
    {
        return $this->custPass;
    }


    public function setPassword($custPass)
    {
        $this->custPass = $custPass;

        return $this;
    }
 

    public function getSal()
    {
        return $this->custSal;
    }

 
    public function setSal($custSal)
    {
        $this->custSal = $custSal;

        return $this;
    }

    public function checkLoans()
    {
        echo "============ Loans available ==================\n";
        foreach(parent::$loans as $loanName=>$value)
        {
            echo "Loan name:".$loanName."\n";
            echo "Loan Amount :".$value["amount"]."\n"; 
            echo "INTREST RATE :".$value["intrest"]."%\n";
            echo "DURATION :".$value["duration"]."months\n";
            echo "minSal".$value["minSal"]."\n";
            echo "EMI :".$value["emi"]."\n";
            echo "\n=================================\n";
        }
    }

    public function getDetails()
    {
        echo "========== Details ============\n";
        echo "Name : ".$this->getName()."\n";
        echo "Age : ".$this->getAge()."\n";
        echo "Mobile :".$this->getMobile()."\n";
        echo "Address :".$this->getAddress()."\n";
        echo "============ LOANS ==============\n";
        foreach($this->custLoans as $loanName=>$value)
        {
            echo "Loan name:".$loanName."\n";
            echo "Loan Amount :".$value["amount"]."\n"; 
            echo "INTREST RATE :".$value["intrest"]."%\n";
            echo "PENDING INSTALLMENTS :".$value["duration"]."months\n";
             echo "MINIMUM SALARY : ".$value["minSal"]."\n";
            echo "EMI :".$value["emi"]."\n";
            echo "DUE :" .$value["due"]."\n";
            echo "\n=================================\n";
        }

    }
    public function payLoan()
    {
           
        echo "============ Loans to Pay ==================\n";
        foreach($this->custLoans as $key=>$value)
        {
            echo "Loan name:".$key."\n";
            echo "Loan Amount :".$value["amount"]."\n"; 
            echo "INTREST RATE :".$value["intrest"]."%\n";
            echo "DURATION :".$value["duration"]."months\n";
            echo "minSal".$value["minSal"];
            echo "EMI :".$value["emi"]."\n";
            echo "DUE :" .$value["due"]."\n";
            echo "\n=================================\n";
        }
        $loanName=readline("Enter the loan name you want to repay :");
        if(array_key_exists($loanName,$this->custLoans))
        {
            $this->custLoans[$loanName]["due"]=0;
            $this->custLoans[$loanName]["duration"]=0;
            echo "succesfully cleared the loan :". $loanName."\n";
               
        }
        else
        {
            echo "No loan exists with that name $loanName\n";
        }
    }


    public function applyLoan()
    {
        $loan=readline("\nEnter loan name : ");
        $loanApplied=$loan;
        if(array_key_exists($loan,parent::$loans))
        {
    
            if(parent::$loans[$loan]["minSal"]<=$this->getSal())
            {
                
                $this->custLoans[$loan]["name"]=$loanApplied;
                $this->custLoans[$loan]["amount"]=parent::$loans[$loan]["amount"];
                $this->custLoans[$loan]["intrest"]=parent::$loans[$loan]["intrest"];
                $this->custLoans[$loan]["due"]=parent::$loans[$loan]["amount"];
                $this->custLoans[$loan]["minSal"]=parent::$loans[$loan]["minSal"];
                $this->custLoans[$loan]["emi"]=parent::$loans[$loan]["emi"];
                $this->custLoans[$loan]["duration"]=parent::$loans[$loan]["duration"];
                echo "Sucessfully Sanctioned the loan\n";  
            }
            else
            {
                echo "\n You are not elgible for this loan.";
            }
        }
        else
        {
            echo "loan does not exists";
        }
    }


    public function login()
    {
        $mobile=readline("Enter mobile number : ");
        
       // echo $this->getMobile();
        if(array_key_exists($mobile,parent::$customers))
        {
            $password=readline("Enter password : ");
            echo parent::$customers[$mobile]->getPassword();
            if(parent::$customers[$mobile]->getPassword()==$password)
            {
                return parent::$customers[$mobile];
            }
            else
            {
                echo "Incorrect password";
                return false;
            }
        }
        else
        {
            echo "Customer Doesn't Exists ";
            return false;
        }
    }
    
            
    function payInstallment()
    {
        echo "============ Loans to Pay ==================\n";
        foreach($this->custLoans as $key=>$value)
        {
            echo "Loan name:".$key."\n";
            echo "Loan Amount :".$value["amount"]."\n"; 
            echo "INTREST RATE :".$value["intrest"]."%\n";
            echo "pending Installments :".$value["duration"]."months\n";
            echo "minSal".$value["minSal"];
            echo "EMI :".$value["emi"]."\n";
            echo "DUE :" .$value["due"]."\n";
            echo "\n=================================\n";
        }
        $loanName=readline("Enter the loan name you want to repay :");

        if(array_key_exists($loanName,$this->custLoans))
        {
            $amountPaying=$this->custLoans[$loanName]["emi"];
            echo "paying installement amount $amountPaying\n";
            $due=$this->custLoans[$loanName]["due"];
            if($due>0)
            {
                if($due>=$amountPaying)
                {
                    
                    $this->custLoans[$loanName]["due"]-=$amountPaying;
                    $this->custLoans[$loanName]["duration"]-=1;
                    echo "The due is :". $this->custLoans[$loanName]["due"];
                }
                else
                {
                    echo "you are paying more.. transaction cancelled\n";
                }
                    
            }
            else
            {
                echo "There is no due for the loan $loanName\n";
            }
                
        }
        else
        {
            echo "No loan exists with that name $loanName\n";
        }
    }

     
}





?>