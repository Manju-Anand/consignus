<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\HomeModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    // protected $helpers = [];
    protected $helpers = ['form', 'url','myform'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */


    protected $hmodel; // Declare globally
    protected $session;
    protected $userdata;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = service('session');

        helper(['url', 'form','myform']);
        $this->session = \Config\Services::session();

        // $currentPath = service('uri')->getPath();
        // $excludePaths = ['login', 'logout', 'forgot-password', 'register'];
        
        // if (!$this->session->has('logged_user') && !in_array($currentPath, $excludePaths)) {
        //     return redirect()->to(base_url('login'))->with('error', 'Please log in first.')->send();
        //     exit();
        // }

        // Fetch user data if logged in
        $id = $this->session->get('logged_user');
        $userModel = new HomeModel(); // Replace with your actual model
        $this->userdata = $userModel->getLoggedInUserData($id);
    }




    // Function to pass user data globally
    protected function renderView($view, $data = [])
    {
        $data['userdata'] = $this->userdata; // Add userdata to view data
        return view($view, $data);
    }

    public function __construct()
    {
        helper('log'); // Load the helper (if needed)
    }

    protected function logData($level, $message, $data = [])
    {
   
        // Get the calling function name using debug_backtrace
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $method = isset($trace[1]['function']) ? $trace[1]['function'] : 'UnknownMethod';

        // Format the log message with timestamp, controller, and function name
        $formattedMessage = strtoupper($level) . " | " . date('Y-m-d H:i:s') .
            " | Controller: " . get_class($this) .
            " | Function: " . $method .
            " | " . $message .
            " | Data: " . json_encode($data, JSON_PRETTY_PRINT);
        log_message($level, "============ ********** ================");
        log_message($level, $formattedMessage);
        log_message($level, "============ ********** ================");
    }
}
