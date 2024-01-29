<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Users_model');
        $this->load->model('Keys_model');
        $this->load->library('session');
        error_reporting(0);
    }

    public function index() {
        //$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->session->sess_destroy();
            $this->load->view('auth/my_welcomePage');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->db->get_where('users', ['email' => $email])->row_array();
            $key = $this->db->get_where('keys', ['user_id' => $user['id']])->row_array();

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $this->session->set_userdata('username', $user['username']);
                    $this->session->set_userdata('password', $key['key']);
                    redirect('auth/mainPage');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password false!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
                redirect('auth');
            }
        }
    }

    public function mainPage() {
        $this->load->view('auth/main_page');
    }

    public function registration() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/registration');
        } else {
            $data = array(
                'username' => htmlspecialchars($this->input->post('username', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );

            if ($this->Users_model && $this->Keys_model) {
                $affected_rows = $this->Users_model->createUsers($data);
                if ($affected_rows > 0) {  
                    $email = $this->input->post('email');
                    $user = $this->db->get_where('users', ['email' => $email])->row_array();

                    $data = array(
                        'user_id' => $user['id'],
                        'key' => $user['password'],
                        'date_created' => date('Y-m-d H:i:s')
                    );

                    $this->Keys_model->createKeys($data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Registration successful</div>');
                    redirect('auth');
                } else {
                    echo "Registration failed!";
                }
            } else {
                echo "Error loading Users_model.";
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth'); 
    }
}
