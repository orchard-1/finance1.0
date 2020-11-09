<?php

#creating a class for BAJAJ_FINANCE
class BajajFinance{
    public const COMPANY="BAJAJ FINANCE";
    protected  $address="Pune, Maharashtra, India";
    protected  $about ="this is bajaj";
    protected static $admins=array("1@gmail.com"=>array("name"=>"chinmaya","password"=>"1234"));
    protected static $customers=array();
    protected static $loans=array();
        
        
    # varaiable to hold the object/instance
    private static $instance;

    # function to create object (singleton) of BAJAJ_FINANCE 
    public static function createObject()
    {
        # check wether object is created earlier
        if(!isset(self::$instance))
        {
            self::$instance = new BajajFinance();
        }
        return self::$instance;
    }

    # function for root login
    public function rootLogin()
    {
        $rootPassword=readline("Enter root password : ");

        # checking root  password with default root password
        if($rootPassword==1234)
        {
            echo "login successful , root.\n ";
            return true;
        }
        else
        {
            echo "Invalid root password\n";
        }
    }

    # function to add admin 
    public function addAdmin()
    {
        $email=getEmail();
        $name=readline("Enter admin name :");
        $pass=readline("Enter Admin password :");
        self::$admins[$email]["name"]=$name;
        self::$admins[$email]["password"]=$pass;
        echo "sucessfully added the admin  $name\n";
    }

    # function to update the address of the company
    public function updateAddress()
    {
        $this->address=readline("Enter new Address : ");
        echo "The updated address is : ".$this->address."\n";
    }

    # function to update the informatiom about the company
    public function updateAbout()
    {
        $this->about=readline("Enter new about : ");
        echo "The updated about is : ".$this->about."\n";
    }
        

}


?>