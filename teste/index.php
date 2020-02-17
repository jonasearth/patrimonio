<?php
require_once "libs/config.php";
function tirarAcentos($string)
{
    return preg_replace(
        array(
            "/(á|à|ã|â|ä)/",
            "/(Á|À|Ã|Â|Ä)/",
            "/(é|è|ê|ë)/",
            "/(É|È|Ê|Ë)/",
            "/(í|ì|î|ï)/",
            "/(Í|Ì|Î|Ï)/",
            "/(ó|ò|õ|ô|ö)/",
            "/(Ó|Ò|Õ|Ô|Ö)/",
            "/(ú|ù|û|ü)/",
            "/(Ú|Ù|Û|Ü)/",
            "/(ñ)/",
            "/(Ñ)/",
            "/(ç)/",
            "/(Ç)/"
        ),
        explode(" ", "a A e E i I o O u U n N c C"),
        $string
    );
}
$doc = simplexml_load_file('./test.xml');
$i = 0;

foreach ($doc->Worksheet->Table->Row as $key => $linha) {
    $a = "";
    foreach ($linha as $n_k => $n_v) {
        $data = tirarAcentos($n_v->Data);
        $a .= " '" . mysqli_real_escape_string($GLOBALS['conn'], $data) . "',";
    }
    $a .= " '1', '' ";

    $b = $GLOBALS['conn_class']->insert(
        "patrimonios",
        "`n_patr`,`modelo`,`descricao`,`localizacao`,`estado`,`obs`,`estado_equip`,`man_loc`",
        $a
    );
    var_dump($GLOBALS['conn_class']->error);
}
