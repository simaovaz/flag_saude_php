<?php

require_once 'html/header.phtml';
require_once 'repositorios/mysql/EspecialidadesRepository.php';
require_once 'models/Especialidades.php';


$repository= new EspecialidadesRepository;
$especialidades= $repository->findAll();

if($_SERVER['REQUEST_METHOD']=== "POST" ){
    $especialidade = new Especialidades($_POST);
    $repository-> save($especialidade);

}

if($_SERVER['REQUEST_METHOD']==="GET" && isset($_GET['view_especialidade'])){

    $id= $_GET['view_especialidade'];
    $especialidade = $repository ->findByID($id);   
    require_once 'html/especialidades/view.phtml';

}else if ($_SERVER['REQUEST_METHOD']==="GET" && isset($_GET['edit_especialidade'])){

    $id= $_GET['edit_especialidade'];
    $especialidade = $repository ->findByID($id);   
    require_once 'html/especialidades/edit.phtml';

}else if( $_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['delete_especialidade'])){
    
    $id = $_GET['delete_especialidade'];
    if ($repository->delete($id)) {
        echo '<div class="alert alert-success" role="alert"> Foi apagado o user com o id <strong> ' . $id . '</strong>';
    };
    $especialidades= $repository->findAll();
    require_once 'html/especialidades/list.phtml';
    
}
else{
    $especialidades= $repository->findAll();
    require_once 'html/especialidades/list.phtml';
}



require_once 'html/footer.phtml';

?>