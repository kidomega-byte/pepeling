<?php 
/**
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
	}

	public function index(){
        $data['view'] = 'data';
		$this->load->view('v-login',$data);
	}

    function aksi_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $where = array(
            'username' => $username,
            'password' => md5($password)
            );
        $cek = $this->m_login->cek_login("user",$where)->num_rows();
        if($cek > 0){
 
            $data_session = array(
                'nama' => $username,
                'status' => "login"
                );
 
            $this->session->set_userdata($data_session);
 
            redirect('admin');
 
        }else{
            echo "Username dan password salah !";
        }
    }

    function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
}
 ?>