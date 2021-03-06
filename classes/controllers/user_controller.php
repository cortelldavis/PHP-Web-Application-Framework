<?php
/*
user controller should call the user model's methods to get the data ready to be passed to the view. The controller shouldn't perform any changes to the data, but it should test it to get the necessary action done properly.
*/
include('classes/models/user_model.php');
include('classes/models/address_model.php');


class User_Controller{

    private $user_model;
    private $address_model;
    private $user_data;

    public function __construct(){

        $this->user_model = new User_Model();
        $this->address_model = new Address_Model();
        $this->user_data = array();


    }

    function login($username,$password){

        if($this->user_model->verifyCredentials($username,$password)){
            echo "<br>Username and Password Match!";

            $this->user_data =  $result = $this->user_model->getUser($username);

            $this->user_data['login_status'] = true;         
            $this->user_data['last_login'] =  date('Y-m-d H:i:s');       

        }
    }

    function logout(){
//set log out status to 0, and clear user array
    }

    function isLoggedIn()
{        //return login status
    return $this->user_data['login_status'];
}

function isValid($field,$type){
    if($type=="username"){
//checks whether the username is exists        
        return $this->user_model->checkUsernameExists($field);
    }
    if($type=="email"){       
//checks whether the email is exists    
        return $this->user_model->checkEmailExists($field);
    }
}

function register($user_array){

    $this->user_model->insertUser($user_array['username'],$user_array['first_name'],$user_array['last_name'],$user_array['email'], $user_array['password']);

}

function update(){
//saves changes to database
//copies $user_data elements into $user_model database rows
}

function getActiveUser(){
    return $this->user_data;
}
function setActiveUser($user){
    $this->user_data = $user;
}


}