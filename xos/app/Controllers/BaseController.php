<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\M_Base;

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
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $base_data;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {

        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $agent = $this->request->getUserAgent();
        if (preg_match("/webzip|httrack|wget|FlickBot|downloader|production
        bot|superbot|PersonaPilot|NPBot|WebCopier|vayala|imagefetch|
        Microsoft URL Control|mac finder|
        emailreaper|emailsiphon|emailwolf|emailmagnet|emailsweeper|
        Indy Library|FrontPage|cherry picker|WebCopier|netzip|
        Share Program|TurnitinBot|full web bot|zeus/i", $agent->getAgentString())) {
            die('- Sttt...');
        }

        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();

        $this->M_Base = new M_Base;

        $this->ip = $this->request->getIPAddress();
        $this->browser = $agent->getBrowser();
        $this->user_agent = $agent->getAgentString();

        if ($this->session->get('whatsapp')) {
            $data_users = $this->M_Base->data_where_array('users', [
                'whatsapp' => $this->session->get('whatsapp'),
                'status' => 'On',
            ]);

            if (count($data_users) === 1) {
                $users = $data_users[0];
            } else {
                $users = false;
            }
        } else {
            $users = false;
        }

        $this->base_data = [
            'users' => $users,
            'web' => [
                'title' => $this->M_Base->u_get('web-title'),
                'icon' => $this->M_Base->u_get('web-icon'),
                'logo' => $this->M_Base->u_get('web-logo'),
                'author' => $this->M_Base->u_get('web-author'),
                'keywords' => $this->M_Base->u_get('web-keywords'),
                'description' => $this->M_Base->u_get('web-description'),
                'profit' => $this->M_Base->u_get('profit'),
            ],
        ];
    }
}
