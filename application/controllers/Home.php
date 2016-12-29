<?php

/**
 * Created by PhpStorm.
 * User: Uditha Jay
 * Date: 8/17/2016
 * Time: 3:20 PM
 */
class Home extends CI_Controller
{
    public function index()
    {
        $this->home_view();
    }

    public function home_view(){
        $this->load->view('home');
    }
}