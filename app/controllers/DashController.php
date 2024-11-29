<?php

namespace App\Controllers;

use Core\Controller;
use Core\Database;

class DashController extends Controller
{
    public function dash(){
          $this->view("dash/index");
    }

    public function save(){
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $placa = $_POST["placa"];
            $modelo = $_POST["modelo"];

            $db = Database::connect();

            $stm = $db->prepare("INSERT INTO veiculos (modelo, placa) VALUES (:modelo, :placa)");
              $stm->bindParam(":modelo", $modelo);
              $stm->bindParam(":placa", $placa);
              $stm->execute();
              $this->redirect("/dash");
        }
        $this->view("/dash");
    }

    public function registro(){
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $entrada = $_POST["entrada"];
            $saida = $_POST["saida"];

            $db = Database::connect();

            $stm = $db->prepare("INSERT INTO registros (entrada, saida) VALUES (:entrada, :saida)");
              $stm->bindParam(":saida", $saida);
              $stm->bindParam(":entrada", $entrada);
              $stm->execute();
              $this->redirect("/dash");
        }
        $this->view("/dash");
    }
    
}
