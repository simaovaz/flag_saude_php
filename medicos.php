<?php

require_once 'html/header.phtml';

require_once 'models/Medico.php';

$medico_teste1= new Medico("Jose Antonio", 4,3, 2, "Rua da Alegria", "912863752");
$medico_teste2= new Medico("Rui Duarte", 2,4, 1, "Rua da Chuva", "912668796");
$medicos=[$medico_teste1, $medico_teste2];

//$medico_teste1->setNome("abc");

require_once 'html/medicos/list.phtml';

require_once 'html/footer.phtml';

?>


