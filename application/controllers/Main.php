<?php



class Main extends CI_Controller
{
    // Initialization
    function __construct(){
        parent::__construct();  
    }
    // ---------------------------------------------------------

    // Templating
    function index(){
        $this->load->view('dashboard');
    }

}
