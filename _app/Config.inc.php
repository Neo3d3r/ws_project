<?php
define('HOME', 'http://localhost/cursos/ws_php/modulos/08-classes-auxiliares');

// CONFIGURAÇÕES DO SITE ####################
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBSA', 'wsphp');

// AUTO LOAD DE CLASSES #####################
function __autoload($Class) {

    $cDir = ['Conn', 'Helpers', 'Models'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . "\\{$dirName}\\{$Class}.class.php") && !is_dir(__DIR__ . "\\{$dirName}\\{$Class}.class.php")):
            include_once (__DIR__ . "\\{$dirName}\\{$Class}.class.php");
            $iDir = TRUE;
        endif;
    endforeach;

    if (!$iDir):
        trigger_error("Não foi possível incluir {$Class}.class.php", E_USER_ERROR);
        die;
    endif;
}

// TRATAMENTO DE ERROS ######################
//CSS constantes :: Mensagens de Erro
define('NEO_ACCEPT', 'accept');
define('NEO_INFOR', 'infor');
define('NEO_ALERT', 'alert');
define('NEO_ERROR', 'error');

//NEOErro :: Exibe erros lançados :: Front
function NEOErro($ErrMsg, $ErrNo, $ErrDie = NULL) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? NEO_INFOR : ($ErrNo == E_USER_WARNING ? NEO_ALERT : ($ErrNo == E_USER_ERROR ? NEO_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";

    if ($ErrDie):
        die;
    endif;
}

set_error_handler('NEOErro');

//PHPErro :: personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErnnMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? NEO_INFOR : ($ErrNo == E_USER_WARNING ? NEO_ALERT : ($ErrNo == E_USER_ERROR ? NEO_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\>";
    echo "<b>Erro na Linha: {$ErrLine} :: </b> {$ErnnMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\"></span></p>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('PHPErro');
