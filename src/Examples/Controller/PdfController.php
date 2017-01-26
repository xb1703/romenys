<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 08/12/16
 * Time: 13:50
 */

namespace Examples\Controller;

use Examples\Entity\User;
use Romenys\Framework\Components\DB\DB;
use Romenys\Framework\Controller\Controller;
use Romenys\Http\Request\Request;
use Romenys\Http\Response\JsonResponse;

class PdfController extends Controller
{
    public function newAction(Request $request)
    {
        $db = new DB();
        $db = $db->connect();

        $userId = $request->getGet()["id"];

        $userData = $db->query("SELECT * FROM `user` WHERE `id` = " . $userId)->fetch($db::FETCH_ASSOC);

        $user = new User($userData);

        // We are also able to render templates directly with twig. In this case call the app.php directly with an echo of the render method
        // echo $this->render(__DIR__ . '/../Resources/views/pdf/', 'pdf.twig', ["user" => $user]);

        return new JsonResponse(["user" => $user->getName()]);
    }
}
