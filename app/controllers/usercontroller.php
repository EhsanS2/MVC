<?php

namespace App\Controllers;
use App\Controller;
use App\User;

/*all class should extended from main class (Controller) same name as file with Uppercase in first letter
all method should have 'action' following of its name
for reducing complexity, 'controller' added at the end of classnames*/

class UserController extends Controller {
    public function showAction() {
        $user = new User();
        $r = $user->db()->query("INSERT INTO table1 (name, family, age) VALUES ('ehsan', 'hatefi', 26)");
        $this->render('user.show', ['name' => 'Ehsan']);
    }

    public function updateAction($name) {
        $this->render('user.update', compact('name')); //$name = "something";
    }                                                                    //$result = compact("name");
                                                                         //$result --> ['name' => 'something']
    public function showallAction() {
        $users = [
            ["name" => "Ehsan", "family" => "Hatefi", "age" => "34"],
            ["name" => "Mahsa", "family" => "Amiri", "age" => "32"],
            ["name" => "Diana", "family" => "Hatefi", "age" => "5"],
            ["name" => "Helena", "family" => "Hatefi", "age" => "1"]
        ];
        $this->render('user.showall', compact('users'));
    }
}