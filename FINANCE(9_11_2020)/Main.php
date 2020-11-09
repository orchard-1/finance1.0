<?php

include "LoginSystem.php";
include "Email.php";
include "Mobile.php";
include "Numeric.php";
include "BajajFinance.php";
include "Admin.php";
include "Customer.php";
include "Name.php";
include "EmiCalculator.php";

# function to display admin menu 
function adminMenu()
{
    echo "=============== ADMIN MENU ================\n";
    echo "1.ADD LOAN\n2.ADD CUSTOMER\n3.check loans\n4.get customer details\n";
}

#function to display customer menu
function customerMenu()
{
    echo "\n================ CUSTOMER MENU ==================\n";
    echo "1.check loans\n2.apply loan\n3.pay loan\n4.get details\n5.EMI calculator\n6.pay installment";
}

# function to display main menu
function mainMenu()
{
    echo "\n========= MAIN MENU ============\n";
    echo "1.root\n2.Admin\n3.customer\n";
}

#function to display root menu
function rootMenu()
{
    echo "\n========= ROOT MENU ============\n";
    echo "1.ADD ADMIN\n2.UPDATE COMPANY ADDRESS\n3.UPADTE ABOUT\n";
}

# function for admin operations
function adminOperations()
{
    do
    {
        #displaying admin menu
        adminMenu();
        $option = readline("Enter admin option : ");

        # executing operation based on option entered
        switch ($option)
        {
            case 1:
                $GLOBALS['adminObj']->addLoan();
                break;
            case 2:
                $GLOBALS['adminObj']->addCustomer();
            break;
            case 3:
                $GLOBALS['adminObj']->checkLoans();
                break;
            case 4: $GLOBALS['adminObj']->getCustDetails();
            break;  
            case "exit":
                    echo "you are exited from the Admin Menu";
            break;
            default:
                    echo "Enter a valid option from admin\n";
            break;

        }
    }while ($option != "exit");

}

# function to perfrom customer operations
function customerOperations($obj)
{
    do
    {
        # displaying customer menu 
        customerMenu();
            
        $option = readline("\nEnter customer option : ");

        # performing operations based on option entered
        switch ($option)
        {
            # for checking available loans 
            case 1:
                $obj->checkLoans();
            break;

            # for applying loan
            case 2:
                $obj->applyLoan();
            break;

            # for clearing the loan
            case 3:
                $obj->payLoan();
            break;

            # get the details of customer
            case 4:
                $obj->getDetails();
            break;

            # EMI calculator
            case 5: 
                $amount = readline("Enter principal amount : ");
                $intrest = readline("Intrest per annum : ");
                $months = readline("Number of months : ");
                echo "The EMI is :" . emiCalculator($amount, $intrest, $months);
            break;

            # to pay monthly installment
            case 6:$obj->payInstallment();
            break;    
            case "exit":
                echo "you are exited from Customer";
            break;
        }

    }while ($option != "exit");
}
    
# function for performing root operations
function rootOperations()
{
        
    do
    {
        # displaying root menu
        rootMenu();
        $choice = readline("\nEnter your root option :");

        # performing operations based on the choice entered
        switch ($choice)
        {
            case 1:
                # creating a admin 
                $GLOBALS['obj']->addAdmin();
            break;
            case 2:
                # updating address of the company
                $GLOBALS['obj']->updateAddress();
            break;
            case 3:
                # updating about section of the company
                $GLOBALS['obj']->updateAbout();
            break;
            case "exit":
                echo "Successfully logged out from root";
            break;
            default:
                echo "Enter a valid option from ROOT MENU\n";
            break;

        }
    }while ($choice != "exit");

}

# driver block

#creating object of BAJAJFINANCE
$obj = BajajFinance::createObject();
    
do
{
    # displaying main menu
    mainMenu();
    $option = readline("Enter the option:");

    # performing login based on option entered
    switch ($option)
    {
        # root login
        case 1:
            if ($obj->rootLogin())
            {
                rootOperations();
            }
        break;

        # admin login
        case 2:
            $adminObj = new Admin();
            if ($adminObj->login())
            {
                adminOperations();

            }

        break;

        # customer login
        case 3: 
            $custObj = new Customer();
            $custObj = $custObj->login();
            if ($custObj)
            {
                echo $custObj->getName() . " logegd in";
                customerOperations($custObj);
            }
        break;

        # to exit from the program
        case "exit":
            echo "you are exited from the program\n";
        break;

        default:
            echo "Choose a valid option";
        break;

    }

}while ($option != "exit");
    

?>
