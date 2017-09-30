<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class error extends CI_Controller {

	public function __construct() {
    parent::__construct();

	}
	
	public function index() {
		$message = array();

		switch(isset($_SERVER["REDIRECT_STATUS"]) ? $_SERVER["REDIRECT_STATUS"] : 500){
			case 400:
				$message['title'] = "400 Bad Request";
				$message['msg'] = "The request can not be processed due to bad syntax";
			break;
		
			case 401:
				$message['title'] = "401 Unauthorized";
				$message['msg'] = "The request has failed authentication";
			break;
		
			case 403:
				$message['title'] = "403 Forbidden";
				$message['msg'] = "The server refuses to response to the request";
			break;
		
			case 404:
				$message['title'] = "404 Not Found";
				$message['msg'] = "The resource requested can not be found.";
			break;
		
			default:
			case 500:
				$message['title'] = "500 Internal Server Error";
				$message['msg'] = "There was an error which doesn't fit any other error message";
			break;
		
			case 502:
				$message['title'] = "502 Bad Gateway";
				$message['msg'] = "The server was acting as a proxy and received a bad request.";
			break;
		
			case 504:
				$message['title'] = "504 Gateway Timeout";
				$message['msg'] = "The server was acting as a proxy and the request timed out.";
			break;
		}

		$data['title'] = $message['title'];
		$data['content'] = $this->load->view('error', $message, TRUE);
		$this->load->view('page', $data);
	}
}
