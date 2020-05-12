<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Turnos;

class TurnoController extends Controller{

    public function __construct(){
        $this->model = new Turnos();
    }

    /**
     * Show all task
     */
    public function index(){
        $turnos = $this->model->get();
        return view('turnos', compact('turnos'));
    }

    public function create(){
        return view('turnos.create');
    }

    public function validateUpdate(){
        $Error =  array();
        require 'app/controllers/ValidateController.php';

        if (empty($Error)){
            if(!empty($_POST['edad'])){
                $edad = $_POST['edad'];
            }else{
                $edad = NULL;
            }
    
            if(!empty($_POST['talla'])){
                $talla = $_POST['talla'];
            }else{
                $talla = NULL;
            }
    
            if(!empty($_POST['altura'])){
                $altura = $_POST['altura'];
            }else{
                $altura = NULL;
            }
    
            if(!empty($_POST['cpelo'])){
                $cpelo = $_POST['cpelo'];
            }else{
                $cpelo = NULL;
            }
    
           if(!empty($_FILES["diagnostico"]["tmp_name"])){
                $diagnostico = file_get_contents($_FILES["diagnostico"]["tmp_name"]);
                $extension = pathinfo($_FILES["diagnostico"]["name"], PATHINFO_EXTENSION);
            }else{
                $diagnostico = NULL;
                $extension = NULL;
            }

            $turno = [
                'nombre' => $_POST['nombre'],
                'email' => $_POST['email'],
                'tel' => $_POST['tel'],
                'edad' => $edad,
                'talla' => $talla,
                'altura' => $altura,
                'nacimiento' => $_POST['nacimiento'],
                'cpelo' => $cpelo,
                'fechaturno' => $_POST['fechaturno'],
                'horaturno' => $_POST['horaturno'],
                'diagnostico' => $diagnostico,
                'extension' => $extension
                ];

            $this->model->update($_POST["id"],$turno);
            $diagnosticoImg = base64_encode($turno['diagnostico']);
            return view('turno.modificado', ['turnonuevo' => $turno, 'diagnosticoImg'=>$diagnosticoImg]);
        }else{
            return view('turnos.modificacion', [
                                        'errores'=> $Error,
                                        'nombre' => $_POST['nombre'],
                                        'email' => $_POST['email'],
                                        'tel' => $_POST['tel'],
                                        'edad' => $_POST['edad'],
                                        'talla' => $_POST['talla'],
                                        'altura' => $_POST['altura'],
                                        'nacimiento' => $_POST['nacimiento'],
                                        'cpelo' => $_POST['cpelo'],
                                        'fechaturno' => $_POST['fechaturno'],
                                        'horaturno' => $_POST['horaturno'],
                                        'diagnostico' => $_FILES["diagnostico"]["tmp_name"]
            ]);
        }
    }

    public function validate(){
        $Error =  array();
        require 'app/controllers/ValidateController.php';

        if (empty($Error)){
            $result = $this->save();
            $diagnosticoImg = base64_encode($result['diagnostico']);
            return view('turnoReservado', ['turnonuevo' => $result, 'diagnosticoImg'=>$diagnosticoImg]);
        }else{
            return view('turnos.create', [
                                        'errores'=> $Error,
                                        'nombre' => $_POST['nombre'],
                                        'email' => $_POST['email'],
                                        'tel' => $_POST['tel'],
                                        'edad' => $_POST['edad'],
                                        'talla' => $_POST['talla'],
                                        'altura' => $_POST['altura'],
                                        'nacimiento' => $_POST['nacimiento'],
                                        'cpelo' => $_POST['cpelo'],
                                        'fechaturno' => $_POST['fechaturno'],
                                        'horaturno' => $_POST['horaturno'],
                                        'diagnostico' => $_FILES["diagnostico"]["tmp_name"]
            ]);
        }
    }

    public function save(){
        if(!empty($_POST['edad'])){
            $edad = $_POST['edad'];
        }else{
            $edad = NULL;
        }

        if(!empty($_POST['talla'])){
            $talla = $_POST['talla'];
        }else{
            $talla = NULL;
        }

        if(!empty($_POST['altura'])){
            $altura = $_POST['altura'];
        }else{
            $altura = NULL;
        }

        if(!empty($_POST['cpelo'])){
            $cpelo = $_POST['cpelo'];
        }else{
            $cpelo = NULL;
        }

        if(!empty($_FILES["diagnostico"]["tmp_name"])){
            $diagnostico = file_get_contents($_FILES["diagnostico"]["tmp_name"]);
            $extension = pathinfo($_FILES["diagnostico"]["name"], PATHINFO_EXTENSION);
        }else{
            $diagnostico = NULL;
            $extension = NULL;
        }

        $turno = [
                'nombre' => $_POST['nombre'],
                'email' => $_POST['email'],
                'tel' => $_POST['tel'],
                'edad' => $edad,
                'talla' => $talla,
                'altura' => $altura,
                'nacimiento' => $_POST['nacimiento'],
                'cpelo' => $cpelo,
                'fechaturno' => $_POST['fechaturno'],
                'horaturno' => $_POST['horaturno'],
                'diagnostico' => $diagnostico,
                'extension' => $extension
                ];
        $this->model->insert($turno);
        return $turno;
    }

    public function turnoCompleto(){
        $turno = $this->model->getId($_GET["id"]);
        $diagnosticoImg = base64_encode($turno[0]->diagnostico);
        return view('turno.completo', ['turno' => $turno[0], 'diagnosticoImg'=>$diagnosticoImg]);
    }

    public function update(){
        $turno = $this->model->getId($_GET["id"]);
        $diagnosticoImg = base64_encode($turno[0]->diagnostico);
        return view('turno.modificacion', ['turno' => $turno[0],'diagnosticoImg'=>$diagnosticoImg]);
    }

    public function delete(){
        $this->model->delete($_GET["id"]);

        $turnos = $this->model->get();
        return view('turnos' ,['turnos'=> $turnos]);
    }
}