<?php

Class User_Blog extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('');
	}

	function index($id)
	{
		$this->load->view('blog/manage_blog');
	}

	function createBlog()
	{
		$this->load->view('blog/create_blog');
	}

	function createNewBlog()
	{
		extract($this->input->post());
	}
}