<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 06/12/16
 * Time: 01:17
 */

namespace Examples\Controller;

use Examples\Entity\Car;
use Examples\Entity\House;
use Examples\Entity\User;
use Romenys\Framework\Components\DB\DB;
use Romenys\Framework\Controller\Controller;
use Romenys\Http\Request\Request;
use Romenys\Http\Response\JsonResponse;

class HouseController extends Controller
{
    public function newAction(Request $request)
    {
        $request->uploadFiles();

        $house = new House($request->getPost()["house"]);

        $user = new User($request->getPost()["house"]["examples_entity_user"]);
        $user->setAvatar($request->getUploadedFiles()["examples_entity_user"]["avatar"]["uploaded_file"]);
        $user->setProfile($request->getUploadedFiles()["examples_entity_user"]["profile"]["uploaded_file"]);

        $db = new DB();
        $db = $db->connect();

        $userInsertQuery = $db->prepare("INSERT INTO `user` (`name`, `email`, `avatar`, `profile`) VALUES (:name, :email, :avatar, :profile)");
        $userInsertQuery->bindValue(":name", $user->getName());
        $userInsertQuery->bindValue(":email", $user->getEmail());
        $userInsertQuery->bindValue(":avatar", $user->getAvatar());
        $userInsertQuery->bindValue(":profile", $user->getProfile());
        $userInsertQuery->execute();

        $userId = $db->query("SELECT LAST_INSERT_ID()")->fetchColumn(`LAST_INSERT_ID()`);

        $user->setId($userId);
        $house->setUser($user);

        $car = new Car($request->getPost()["house"]["examples_entity_car"]);
        $car->setUser($user);

        $carInsertQuery = $db->prepare("INSERT INTO `car` (`brand`, `pictures`, `user`) VALUES (:brand, :pictures, :user)");
        $carInsertQuery->bindValue(":brand", $car->getBrand());
        $carInsertQuery->bindValue(":pictures", null);
        $carInsertQuery->bindValue(":user", $car->getUser()->getId());
        $carInsertQuery->execute();

        $houseInsertQuery = $db->prepare("INSERT INTO `house` (`color`, `user`) VALUES (:color, :user)");
        $houseInsertQuery->bindValue(":color", $house->getColor());
        $houseInsertQuery->bindValue(":user", $house->getUser()->getId());
        $houseInsertQuery->execute();

        return new JsonResponse([
            "user" => $user,
            "car" => $car,
            "house" => $house
        ]);
    }

    public function showAction(Request $request)
    {
        $id = $request->getGet()["id"];

        $db = new DB();
        $db = $db->connect();

        $house = $db->query("SELECT * FROM `house` WHERE id = " . $id)->fetch($db::FETCH_ASSOC);

        return new JsonResponse([
            "house" => $house
        ]);
    }
}