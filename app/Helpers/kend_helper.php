<?php


function get_bbm_all($no_kend, $tglaw, $tglak)
{
    $db = \Config\Database::connect();
    $result = $db->query('SELECT ifnull(SUM(rp),0) as jumlah FROM `tbbbm` where tglisi>="' . $tglaw . '" AND tglisi<="' . $tglak . '" and no_kend="' . $no_kend . '" and isnull(deleteby)')->getRow()->jumlah;
    if ($result) {
        return $result;
    } else {
        return 0;
    }
}
function get_bbm_detail($no_kend, $tglaw, $tglak, $bln)
{
    $db = \Config\Database::connect();
    $thn = substr($tglaw, 0, 4);
    $tglaw2 = get_tglaw_bln($bln, $thn);
    $tglak2 = get_tglak_bln($bln, $thn);
    if (substr($tglaw, 5, 2) == $bln) {
        $tglaw2 = $tglaw;
    }
    if (substr($tglak, 5, 2) == $bln) {
        $tglak2 = $tglak;
    }
    if (in_array($bln, getbulan($tglaw, $tglak))) {
        $result = $db->query('SELECT ifnull(SUM(rp),0) as jumlah FROM `tbbbm` where tglisi>="' . $tglaw2 . '" and tglisi<="' . $tglak2 . '" and no_kend="' . $no_kend . '" and YEAR(tglisi)=' . $thn . ' and isnull(deleteby)')->getRow()->jumlah;
        return $result;
    } else {
        return 0;
    }
}
function get_parkir_all($no_kend, $tglaw, $tglak)
{
    $db = \Config\Database::connect();
    $result = $db->query('SELECT ifnull(SUM(parkir),0) as jumlah FROM `tbbiaya` where tgl>="' . $tglaw . '" and tgl<="' . $tglak . '" and no_kend="' . $no_kend . '" and isnull(deleteby)')->getRow()->jumlah;
    if ($result) {
        return $result;
    } else {
        return 0;
    }
}
function get_parkir_detail($no_kend, $tglaw, $tglak, $bln)
{
    $db = \Config\Database::connect();
    $thn = substr($tglaw, 0, 4);
    $tglaw2 = get_tglaw_bln($bln, $thn);
    $tglak2 = get_tglak_bln($bln, $thn);
    if (substr($tglaw, 5, 2) == $bln) {
        $tglaw2 = $tglaw;
    }
    if (substr($tglak, 5, 2) == $bln) {
        $tglak2 = $tglak;
    }
    if (in_array($bln, getbulan($tglaw, $tglak))) {
        $result = $db->query('SELECT ifnull(SUM(parkir),0) as jumlah FROM `tbbiaya` where tgl>="' . $tglaw2 . '" and tgl<="' . $tglak2 . '" and no_kend="' . $no_kend . '" and isnull(deleteby)')->getRow()->jumlah;
        return $result;
    } else {
        return 0;
    }
}
function get_kuli_all($no_kend, $tglaw, $tglak)
{
    $db = \Config\Database::connect();
    $result = $db->query('SELECT ifnull(SUM(kuli),0) as jumlah FROM `tbbiaya` where tgl>="' . $tglaw . '" and tgl<="' . $tglak . '" and no_kend="' . $no_kend . '" and isnull(deleteby)')->getRow()->jumlah;
    if ($result) {
        return $result;
    } else {
        return 0;
    }
}
function get_kuli_detail($no_kend, $tglaw, $tglak, $bln)
{
    $db = \Config\Database::connect();
    $thn = substr($tglaw, 0, 4);
    $tglaw2 = get_tglaw_bln($bln, $thn);
    $tglak2 = get_tglak_bln($bln, $thn);
    if (substr($tglaw, 5, 2) == $bln) {
        $tglaw2 = $tglaw;
    }
    if (substr($tglak, 5, 2) == $bln) {
        $tglak2 = $tglak;
    }
    if (in_array($bln, getbulan($tglaw, $tglak))) {
        $result = $db->query('SELECT ifnull(SUM(kuli),0) as jumlah FROM `tbbiaya` where  tgl>="' . $tglaw2 . '" and tgl<="' . $tglak2 . '" and no_kend="' . $no_kend . '" and isnull(deleteby)')->getRow()->jumlah;
        return $result;
    } else {
        return 0;
    }
}
function get_tol_all($no_kend, $tglaw, $tglak)
{
    $db = \Config\Database::connect();
    $result = $db->query('SELECT ifnull(SUM(tol),0) as jumlah FROM `tbbiaya` where tgl>="' . $tglaw . '" and tgl<="' . $tglak . '" and no_kend="' . $no_kend . '" and isnull(deleteby)')->getRow()->jumlah;
    if ($result) {
        return $result;
    } else {
        return 0;
    }
}
function get_tol_detail($no_kend, $tglaw, $tglak, $bln)
{
    $db = \Config\Database::connect();
    $thn = substr($tglaw, 0, 4);
    $tglaw2 = get_tglaw_bln($bln, $thn);
    $tglak2 = get_tglak_bln($bln, $thn);
    if (substr($tglaw, 5, 2) == $bln) {
        $tglaw2 = $tglaw;
    }
    if (substr($tglak, 5, 2) == $bln) {
        $tglak2 = $tglak;
    }
    if (in_array($bln, getbulan($tglaw, $tglak))) {
        $result = $db->query('SELECT ifnull(SUM(tol),0) as jumlah FROM `tbbiaya` where  tgl>="' . $tglaw2 . '" and tgl<="' . $tglak2 . '" and no_kend="' . $no_kend . '" and isnull(deleteby)')->getRow()->jumlah;
        return $result;
    } else {
        return 0;
    }
}
function get_lain_all($no_kend, $tglaw, $tglak)
{
    $db = \Config\Database::connect();
    $result = $db->query('SELECT ifnull(SUM(lain),0) as jumlah FROM `tbbiaya` where tgl>="' . $tglaw . '" and tgl<="' . $tglak . '" and no_kend="' . $no_kend . '" and isnull(deleteby)')->getRow()->jumlah;
    if ($result) {
        return $result;
    } else {
        return 0;
    }
}
function get_lain_detail($no_kend, $tglaw, $tglak, $bln)
{
    $db = \Config\Database::connect();
    $thn = substr($tglaw, 0, 4);
    $tglaw2 = get_tglaw_bln($bln, $thn);
    $tglak2 = get_tglak_bln($bln, $thn);
    if (substr($tglaw, 5, 2) == $bln) {
        $tglaw2 = $tglaw;
    }
    if (substr($tglak, 5, 2) == $bln) {
        $tglak2 = $tglak;
    }
    if (in_array($bln, getbulan($tglaw, $tglak))) {
        $result = $db->query('SELECT ifnull(SUM(lain),0) as jumlah FROM `tbbiaya` where  tgl>="' . $tglaw2 . '" and tgl<="' . $tglak2 . '" and no_kend="' . $no_kend . '" and isnull(deleteby)')->getRow()->jumlah;
        return $result;
    } else {
        return 0;
    }
}
function get_service_all($no_kend, $tglaw, $tglak)
{
    $db = \Config\Database::connect();
    $result = $db->query('SELECT ifnull(SUM(nilai_real),0) as jumlah FROM `tbservice` where  tglsrv>="' . $tglaw . '" and tglsrv<="' . $tglak . '" and no_kend="' . $no_kend . '" and isnull(deleteby)')->getRow()->jumlah;
    if ($result) {
        return $result;
    } else {
        return 0;
    }
}
function get_service_alls($no_kend, $tglaw, $tglak, $kdjns)
{
    $db = \Config\Database::connect();
    $result = $db->query('SELECT ifnull(SUM(nilai2),0) as jumlah FROM `tbservice` right join tbservice_d on tbservice_d.nosrv=tbservice.nosrv where tglsrv>="' . $tglaw . '" and tglsrv<="' . $tglak . '" and no_kend="' . $no_kend . '" and isnull(deleteby) and kdjns="' . $kdjns . '"')->getRow()->jumlah;
    if ($result) {
        return $result;
    } else {
        return 0;
    }
}
function get_service_details($no_kend, $tglaw, $tglak, $bln, $kdjns)
{
    $db = \Config\Database::connect();
    $thn = substr($tglaw, 0, 4);
    $tglaw2 = get_tglaw_bln($bln, $thn);
    $tglak2 = get_tglak_bln($bln, $thn);
    if (substr($tglaw, 5, 2) == $bln) {
        $tglaw2 = $tglaw;
    }
    if (substr($tglak, 5, 2) == $bln) {
        $tglak2 = $tglak;
    }
    if (in_array($bln, getbulan($tglaw, $tglak))) {
        $result = $db->query('SELECT ifnull(SUM(nilai2),0) as jumlah FROM `tbservice` right join tbservice_d on tbservice_d.nosrv=tbservice.nosrv where tglsrv>="' . $tglaw2 . '" and tglsrv<="' . $tglak2 . '" and no_kend="' . $no_kend . '" and isnull(deleteby) and kdjns="' . $kdjns . '"')->getRow()->jumlah;
        return $result;
    } else {
        return 0;
    }
}
