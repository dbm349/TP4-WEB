<?php

$fecha_actual = new DateTime('America/Argentina/Buenos_Aires');
$fecha_nacimiento_enviada = new DateTime($_POST['nacimiento']);
$fecha_turno_enviada = new DateTime($_POST['fechaturno']);

$horario_enviado = new DateTime($_POST['horaturno']);
$horario_inicio = new DateTime('08:00');
$horario_fin = new DateTime('17:00');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  
    if(empty($_POST['nombre'])){
        $Error['nombre'] = 'Nombre vacio';
    } elseif (!preg_match('/^[A-Za-zÀ-ž\s]+$/',$_POST['nombre'])) {
        $Error['nombre']=' El nombre solo debe contener letras. ';
    }

    if(empty($_POST['email'])){
        $Error['email'] = 'Email vacio';
    } elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $Error['email']='no respeta el formato de un email (@ | .com)';
    }

    if(empty($_POST['tel'])){
        $Error['tel'] = 'Telefono vacio';
    }elseif(!is_numeric($_POST['tel'])){
        $Error['tel'] = 'Debe contener solo numeros';
    }

    if(!empty($_POST['edad'])){
        $errorEdad = '';
        if (!preg_match('/[0-9]{0,}/', $_POST['edad'])) {
            $errorEdad .= 'Solo debe contener numeros. ';
        }
        if ($_POST['edad']>105){
            $errorEdad .= 'Debe ser menor o igual de 105 años. ';
        }
        if ($_POST['edad']<1){
            $errorEdad .= 'Debe ser a partir de 1 año. ';
        }
        if ($errorEdad!=''){
            $Error['edad']=$errorEdad;
        }
    }

    if(!empty($_POST['talla'])) {
        if (!is_numeric($_POST['talla'])){
            $Error['talla'] = 'Debe contener solo numeros. ';
        }
        if (($_POST['talla']<20) || ($_POST['talla']>45)){
            $Error['talla'] = 'Debe ser entre 20 y 45 ';
        }
    }

    if(!empty($_POST['altura'])){
        $ErrorAltura = '';
        if (!preg_match('/[0-9]{0,}[,.]{0,1}[0-9]{0,}/', $_POST['altura'])) {
            $ErrorAltura .= 'Debe contener solo numero ';
        }
        if ($_POST['altura']>3){
            $ErrorAltura .= 'Debe ser menor a 3 m.';
        }
        if ($_POST['altura']<0.4){
            $ErrorAltura .= 'Debe ser mayor a 0.4 m.';
        }
        if ($ErrorAltura!=''){
            $Error['altura'] = $ErrorAltura;}
    }

    if(empty($fecha_nacimiento_enviada)){
        $Error['nacimiento'] = 'Fecha de Nacimiento vacio';
    } elseif($fecha_nacimiento_enviada > $fecha_actual){
        $Error['nacimiento'] = 'Debe ser menor a la fecha actual';
    }

    if(!empty($_POST['cpelo'])){
        if (!preg_match('/Castaño|Rubio|Pelirrojo|Negro|\s/', $_POST['cpelo'])){
            $Error['cpelo'] = 'Debe estar entre las opciones propuestas. ';
        }
    }

    if(empty($fecha_turno_enviada)){
        $Error['fechaturno'] =  'Fecha de turno vacia';
    }elseif ($fecha_turno_enviada < $fecha_actual){
        $Error['fechaturno'] =  'Debe ser mayor a la fecha actual ';
    }

    if(empty($horario_enviado)){
        $Error['horaturno'] = 'Hora de turno vacio';
    }else{
        $ErrorHorarioTurno='';
        if (!preg_match('/.:00|.:15|.:30|.:45/',$_POST['horaturno'])){
            $ErrorHorarioTurno .= 'Debe terminar con .00/.15/.30/.45. ';
        }
        if ($horario_inicio > $horario_enviado){
            $ErrorHorarioTurno .= 'Debe ser despues de las 8:00hs. ';
        }
        if ($horario_fin < $horario_enviado) {
            $ErrorHorarioTurno .= 'Debe ser antes de las 17:00. ';
        }
        if ($ErrorHorarioTurno!=''){
            $Error['horaturno'] = $ErrorHorarioTurno;
        }
    }
    if (!empty($_POST['diagnostico'])){
        $extensionArchivo = pathinfo($_FILES["diagnostico"]["name"], PATHINFO_EXTENSION);
        if($extensionArchivo != "jpg" && $extensionArchivo != "png" ) {
            $Error['diagnostico'] = 'La imagen tiene que ser formato jpg o png';
        }
        if( $_FILES['diagnostico']['size'] > 10000*1024){
            $Error['diagnostico'] = 'La imagen tiene que tener un tamaño menor a 10MB';
        }
    }
}
