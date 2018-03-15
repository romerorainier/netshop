<?php

class Users extends Controller
{

    public function register($username = '',$password = '',$email ='')
    {
        $data =  User::create([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'email' => $email,
                'balance' => 100
            ])->count();

        if ($data>0)
        {
          echo 'Successfully Registered, ';
          $this->login($username,$password);
        }
    }

    public function login($username = '',$password = '')
    {
        $data = User::Where('username',$username)->first();

        if (!is_null($data)) {
          if (password_verify ( $password ,$data->password))
          {
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["uid"] = $data->Id;
            echo 'login successfully';
          }
          else
          {
            echo 'login failed, check password';
          }
        }
        else {
            echo 'login failed, check username';
        }

    }

    public function logout()
    {
        session_start();
        if (isset($_SESSION["username"]))
        {
          session_unset();
          session_destroy();
          return true;
        }
    }

}

?>
