<?php
define('HOME', 'http://localhost/cursos/ws_php/modulos/08-classes-auxiliares');

/* CONFIGURAÇÕES DO SITE ####################
 * Abaixo configuração do Banco de Dados
 */
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBSA', 'wsphp');

/* AUTO LOAD DE CLASSES #####################
 * 
 */
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

/* TRATAMENTO DE ERROS ######################
 * CSS constantes :: Mensagens de Erro
 * Necessário implementação de BOOTSTRAP 4 no projeto para funcionar
*/
define('NEO_ACCEPT', 'alert-success');
define('NEO_INFOR', 'alert-warning');
define('NEO_ALERT', 'alert-primary');
define('NEO_ERROR', 'alert-danger');

/** NEOErro :: Exibe erros lançados :: Front **/
function NEOErro($ErrMsg, $ErrNo, $ErrDie = NULL) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? NEO_INFOR : ($ErrNo == E_USER_WARNING ? NEO_ALERT : ($ErrNo == E_USER_ERROR ? NEO_ERROR : $ErrNo)));

    echo "<div class=\"alert {$CssClass}\" role=\"alert\">
            <p>{$ErrMsg}</p>
          </div>";

    if ($ErrDie):
        die;
    endif;
}

set_error_handler('NEOErro');

/** PHPErro :: personaliza o gatilho do PHP **/
function PHPErro($ErnnMsg, $ErrNo, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? NEO_INFOR : ($ErrNo == E_USER_WARNING ? NEO_ALERT : ($ErrNo == E_USER_ERROR ? NEO_ERROR : $ErrNo)));
    echo "<p class=\"alert {$CssClass}\" role=\"alert\">";
    echo "<b>Erro na Linha: {$ErrLine} :: </b> {$ErnnMsg}<br>";
    echo "<small>{$ErrFile}</small>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('PHPErro');
