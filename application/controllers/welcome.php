<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        var_export($_SERVER);
        if (!empty($_SERVER['PATH_INFO'])) {
            echo $_SERVER['PATH_INFO'];
        }
        $this->load->view('welcome_message');
    }

    public function check_info_temp()
    {
        phpinfo();
    }

    public function check_crmls($value = 2)
    {
        $this->load->library('rets');
        $rets = new Rets();
        $response = $rets->check_crmls($value);

        foreach ($response as $key => $value) {
            echo 'ListAgentMlsId :' . $value['ListAgentMlsId'] . '<br>';
            echo 'Address :' . $value['StreetNumberNumeric'] . ', ' . $value['StreetName'] . ', ' . $value['SubdivisionName'] . ', ' . $value['SubdivisionNameOther'] . '<br>';
            echo 'City :' . $value['City'] . '<br>';
            echo 'ListPrice :' . $value['ListPrice'] . '<br>';

            echo "<br>=====================<br>";

        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
