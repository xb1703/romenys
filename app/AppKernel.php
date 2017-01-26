<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 29/11/16
 * Time: 14:05
 */

namespace Romenys\app;

use Romenys\Framework\Components\HandleRequest;

class AppKernel
{
    public function __construct()
    {
        if (!session_start()) throw new \RuntimeException("We were unable to start a session", 403);

        if (!isset($_POST[0]) && empty($_POST[0])) {
            // Hack for Angular POST as PHP does not desirialize json natively
            if (empty($_POST)) {
                if (!empty(file_get_contents('php://input'))) {
                    $_POST = json_decode(file_get_contents('php://input'), true);
                }
            }
        } else {
            // Hack for PHP7
            foreach ($_POST as $data => $empty) {
                $_POST = json_decode($data, true);
            }
        }

        $request = new HandleRequest($_GET, $_POST, $_COOKIE, $_FILES, $_ENV, $_SESSION, $_SERVER);
        $request->handleRequest();
    }
}
