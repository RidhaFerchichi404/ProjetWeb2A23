<?php
class User
{
    private $id  = null;
    private $name = null;
    private $phone = null;
    private $email = null;
    private $password = null;
    private $address = null;
    private $role = null;
    private $photo = null;
    
    public function __construct($id  , $name, $phone,$email,$password,$address,$role,$photo='')
    {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
        $this->role = $role;
        $this->photo = $photo;

    }
    public function setid($id)
    {
        $this->id = $id;
    }
    public function getid()
    {
        return $this->id;
    }
    public function getname()
    {
        return $this->name;
    }
    public function setname($name)
    {
        $this->name = $name;
    }
    public function getphone()
    {
        return $this->phone;
    }
    public function setphone($phone)
    {
        $this->phone = $phone;
    }
    public function getemail()
    {
        return $this->email;
    }
    public function setemail($email)
    {
        $this->email = $email;
    }
    public function getpassword()
    {
        return $this->password;
    }
    public function setpassword($password)
    {
        $this->password = $password;
    }


	public function getAddress() {
		return $this->address;
	}
	

	public function setAddress($address) {
		$this->address = $address;
		return $this;
	}


	public function getRole() {
		return $this->role;
	}
	

	public function setRole($role){
		$this->role = $role;
		return $this;
	}
    // getters and setters for all attributes including photo

  public function getPhoto() {
    return $this->photo;
  }

  public function setPhoto($photo) {
    $this->photo = $photo;
  }
}
?>