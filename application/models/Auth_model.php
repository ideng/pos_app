<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Auth_model extends CI_Model
{
    public function form_rules()
    {
        $rules = [
            ['field' => 'username', 'label' => 'Username', 'rules' => 'required'],
            ['field' => 'password', 'label' => 'Password', 'rules' => 'required'],
        ];

        return $rules;
    }

    public function verify_login(array $data)
    {
        $this->load->model(['base_model', 'setting/privileges']);
        $user = $this->base_model->get_row('users', ['username' => $data['username']], []);
        if ($user) {
            $user_pass = $user->password;
            $chk_pass = verify_hash($data['password'], $user_pass);
            if ($chk_pass) {
                $str = get_report(TRUE, 'Welcome ' . $user->name, $data);
                foreach ($user as $key => $value) {
                    $_SESSION['auth'][$key] = $value;
                }
                $privilege = $this->privileges->get_user_privileges($user->id);
                $_SESSION['auth']['module'] = $privilege->module;
            } else {
                $str = get_report(FALSE, 'Password doesn\'t match username!');
            }
        } else {
            $str = get_report(FALSE, 'User doesn\'t exist!');
        }

        return $str;
    }
}
