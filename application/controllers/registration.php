<?php


Class Registration extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model('Registration_model');
	}

	function index()
	{
		$this->load->view('registration/registration');
	}

	function createUser()
	{
		extract($this->input->post());

		$data = array();

		$data['first_name'] 			= isset($firstName) && !empty($firstName) ? $firstName : '';
		$data['last_name'] 			= isset($lastName) && !empty($lastName) ? $lastName : '';
		$data['email'] 				= isset($email) && !empty($email) ? $email : '';
		$data['password'] 			= isset($password) && !empty($password) ? sha1($password) : '';
		$data['confirm_password'] 	= isset($confirmPass) && !empty($confirmPass) ? sha1($confirmPass) : '';

		$result = $this->Registration_model->insertUser($data);

		$response = array();

		if($result > 0)
		{
			$response = array("success" => true, "message" => "User created successfully.");
		}
		else
		{
			$response = array("success" => false, "message" => "Error while creating user.");
		}

		echo json_encode($response);
		exit;
	}

	function login()
	{
		$this->load->view('registration/login');
	}

	function checkLogin()
	{
		extract($this->input->post());

		$email 		= isset($email) && !empty($email) ? $email : '';
		$password 	= isset($password) && !empty($password) ? $password : '';

		$result = $this->Registration_model->getUserData($email, $password);

		$response = array();

		if(!empty($result) && $result > 0)
		{
			$response = array("success" => true, "message" => "Login successfully.", "userId" => $result[0]['id']);
		}
		else
		{
			$response = array("success" => false, "message" => "Invalid login credentials");
		}

		echo json_encode($response);
		exit;
	}
}