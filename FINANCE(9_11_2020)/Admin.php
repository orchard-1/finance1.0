<?php

# class for Admin
class Admin extends BajajFinance implements LoginSystem
{
    # function for Admin login
    public function login()
    {
        $mail = getEmail();
        if(array_key_exists($mail,parent::$admins))
        {
            $pass = readline("Enter admin password :");
            if(parent::$admins[$mail]["password"]==$pass)
            {
                echo "login successful,".parent::$admins[$mail]["name"]."\n";
                return true;
            }
            else
            {
                echo "Incorrect Password";
            }

        }
        else
        {
            echo "Admin does not exists";
        }
        
        return false;
    }
                # function to add a new loan 
    public function addLoan()
    {
        $loanName = readline("Enter loan name :");
        $amount = integer("Enter amount :");
        $duration = integer("Enter duration of the loan in months : ");
        $intrest = integer("Enter Intrest : ");
        $minSal = integer("Monthly income to eligible for loan : ");
        parent::$loans[$loanName]["amount"] = $amount;
        parent::$loans[$loanName]["duration"] = $duration;
        parent::$loans[$loanName]["intrest"] = $intrest;
        parent::$loans[$loanName]["minSal"] = $minSal;
        $emi = $this->emiCalculator($amount, $intrest, $duration);
        parent::$loans[$loanName]["emi"] = $emi;

    }

    # function to display details of the customer
    public function getCustDetails()
    {
        # reading mobile number from console and validating
        $custMob =getMobile();

        if(array_key_exists($custMob,parent::$customers))
        {
               
            $customer=parent::$customers[$custMob];
            echo "============ CUSTOMER DETAILS ============\n";
            echo "Name : ".$customer->getName()."\n";
            echo "Age : ".$customer->getAge()."\n";
            echo "Mobile :".$customer->getMobile()."\n";
            echo "Address :".$customer->getAddress()."\n"; 
            echo "password :".$customer->getPassword()."\n"; 
                    
            # printing loans of customer
            echo "=========== LOANS ================\n";
            foreach($customer->custLoans as $key=>$value)
            {
                foreach($value as $subkey=>$subvalue)
                {
                    echo $subkey." : ".$subvalue."\n";
                }
                echo "\n=================================\n";
            }
        }
        else
        {
            echo "customer does not exists\n";
        }

    }
    
    # function to dispaly all the available loans
    public function checkLoans()
    {
        echo "============ Loans available ==================\n";
        foreach (parent::$loans as $loanName => $value)
        {
            echo "Loan name:" . $loanName . "\n";
            echo "Loan Amount :" . $value["amount"] . "\n";
            echo "INTREST RATE :" . $value["intrest"] . "%\n";
            echo "DURATION :" . $value["duration"] . " months\n";
            echo "MINIMUM SALARY : " . $value["minSal"] . "\n";
            echo "EMI :" . $value["emi"] . "\n";
            echo "\n=================================\n";
        }
    }

    # function to add customer to customer array
    public function addCustomer()
    {
        $mobile = getMobile();
        $name = getName();
        $age=integer("Enter Age :");
        $password = readline("password : ");
        $address = readline("Address : ");
        $salary = integer("salary : ");
        $custObj = new Customer();
        $custObj->setSal($salary);
        $custObj->setAddress($address);
        $custObj->setAge($age);
        $custObj->setMobile($mobile);
        $custObj->setName($name);
        $custObj->setPassword($password);
        echo $custObj->getPassword($password);
        parent::$customers[$mobile] = $custObj;
        var_dump( parent::$customers[$mobile]);
    }

    function emiCalculator($amount, $intrest, $months)
    {
        # intrest per month
        $intrest = $intrest / (12 * 100);
    
        /* Mathematical formula to calculate EMI
            EMI = [P x R x (1+R)^N]/[(1+R)^ (N-1)],
                
            In this formula the variables stand for:

            EMI – the equated monthly installment
            P – the principal or the amount that is borrowed as a loan
            R – the rate of interest that is levied on the loan amount (the interest rate should be a monthly rate)
            N – the tenure of repayment of the loan or the number of monthly installments that you will pay (tenure should be in months)
        */

        # logic for calculating emi
        $emi = ($amount * $intrest * pow(1 + $intrest, $months)) / (pow(1 + $intrest, $months) - 1);
            
        # rounding the EMI value
        return ceil($emi);
    }

}

?>
