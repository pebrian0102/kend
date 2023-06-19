<?php

use CodeIgniter\I18n\Time;

function gettime()
{
    $time = Time::now('Asia/Jakarta', 'en_US');
    return $time;
}
function role($id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('auth_groups_users');
    $builder->select('*');
    $builder->join('auth_groups_permissions', 'auth_groups_permissions.group_id = auth_groups_users.group_id');
    $builder->join('auth_permissions', 'auth_permissions.id = auth_groups_permissions.permission_id');
    $builder->where('user_id', $id);
    $result = $builder->get()->getRow();
    return $result;
}
function getinfo()
{
    $db      = \Config\Database::connect();
    $result = $db->table('tbinfo')->get()->getRow()->info;
    return $result;
}
function sp($no)
{
    switch ($no) {
        case 10:
            return "JAKARTA";
            break;
        case 14:
            return "SUKABUMI";
            break;
        case 20:
            return "BANDUNG";
            break;
        case 21:
            return "CIREBON";
            break;
        case 22:
            return "TASIKMALAYA";
            break;
        case 23:
            return "GARUT";
            break;
        case 24:
            return "INDRAMAYU";
            break;
        case 25:
            return "KUNINGAN";
            break;
        case 26:
            return "SUBANG";
            break;
        case 27:
            return "BANJAR";
            break;
        case 00:
            return "PUSAT";
            break;
        default:
            return null;
    }
}
function sp2($no)
{
    switch ($no) {
        case 10:
            return "JKT";
            break;
        case 14:
            return "SBM";
            break;
        case 20:
            return "BDG";
            break;
        case 21:
            return "CRB";
            break;
        case 22:
            return "TSK";
            break;
        case 23:
            return "GRT";
            break;
        case 24:
            return "IDR";
            break;
        case 25:
            return "KNG";
            break;
        case 26:
            return "SBG";
            break;
        case 27:
            return "BJR";
            break;
        default:
            return null;
    }
}
function sp_no()
{
    $db      = \Config\Database::connect();
    $id =  user_id();
    $builder = $db->table('auth_groups_users');
    $builder->select('*');
    $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
    $builder->where('user_id', $id);
    $result = $builder->get()->getRow();
    $name = $result->name;
    if ($name == 'sp-jkt' || $name == 'spv-jkt' || $name == 'cc-jkt' || $name == 'ksr-jkt') {
        $no = 10;
    } elseif ($name == 'sp-sbm' || $name == 'spv-sbm' || $name == 'cc-sbm' || $name == 'ksr-sbm') {
        $no = 14;
    } elseif ($name == 'sp-bdg' || $name == 'spv-bdg' || $name == 'cc-bdg' || $name == 'ksr-bdg') {
        $no = 20;
    } elseif ($name == 'sp-crb' || $name == 'spv-crb' || $name == 'cc-crb' || $name == 'ksr-crb') {
        $no = 21;
    } elseif ($name == 'sp-tsk' || $name == 'spv-tsk' || $name == 'cc-tsk' || $name == 'ksr-tsk') {
        $no = 22;
    } elseif ($name == 'sp-grt' || $name == 'spv-grt' || $name == 'cc-grt' || $name == 'ksr-grt') {
        $no = 23;
    } elseif ($name == 'sp-idr' || $name == 'spv-idr' || $name == 'cc-idr' || $name == 'ksr-idr') {
        $no = 24;
    } elseif ($name == 'sp-kng' || $name == 'spv-kng' || $name == 'cc-kng' || $name == 'ksr-kng') {
        $no = 25;
    } elseif ($name == 'sp-sbg' || $name == 'spv-sbg' || $name == 'cc-sbg' || $name == 'ksr-sbg') {
        $no = 26;
    } elseif ($name == 'sp-bjr' || $name == 'spv-bjr' || $name == 'cc-bjr' || $name == 'ksr-bjr') {
        $no = 27;
    } elseif ($name == 'acc') {
        $no = 'acc';
    } elseif ($name == 'adm-jbr') {
        $no = 'adminjbr';
    } else {
        $no = null;
    }
    return $no;
}
function getfoto($no_kend)
{
    $db = \Config\Database::connect();
    $result = $db->table('tbkend')->where('no_kend', $no_kend)->get()->getRow();
    return $result;
}
function getbulan($tglaw, $tglak)
{
    if ($tglaw && $tglak) {
        $blnaw = substr($tglaw, 5, 2);
        $blnak = substr($tglak, 5, 2);
        return range($blnaw, $blnak);
    } else {
        return null;
    }
}
function getbulan_str($tglaw, $tglak)
{
    if ($tglaw && $tglak) {
        $blnaw = substr($tglaw, 5, 2);
        $blnak = substr($tglak, 5, 2);
        $bln = '';
        foreach (range($blnaw, $blnak) as $b) {
            $bln .= $b . ',';
        }
        return $bln;
    } else {
        return null;
    }
}
function getdatasp($kdsp, $tglaw, $tglak)
{
    $db = \Config\Database::connect();
    $data_all = [];
    if (getbulan($tglaw, $tglak)) {
        foreach (getbulan($tglaw, $tglak) as $b) {
            if ($kdsp == "all") {
                $data = $db->query('SELECT ifnull(SUM(nilai_real),0) as jml FROM `tbservice` where MONTH(tglsrv) = ' . $b . ' and isnull(deleteby) AND tglsrv>="' . $tglaw . '" AND tglsrv<="' . $tglak . '"')->getRow()->jml;
            } else {
                $data = $db->query('SELECT ifnull(SUM(nilai_real),0) as jml FROM `tbservice` where MONTH(tglsrv) = ' . $b . ' and kdsp="' . $kdsp . '" and isnull(deleteby) AND tglsrv>="' . $tglaw . '" AND tglsrv<="' . $tglak . '"')->getRow()->jml;
            }
            $data_all[] = $data;
        }
        $data_all_str = '';
        foreach ($data_all as $d) {
            $data_all_str .=  $d . ',';
        }
        return $data_all_str;
    } else {
        return null;
    }
}
function getdatakend($no_kend, $tglaw, $tglak)
{
    $db = \Config\Database::connect();
    $data_all = [];
    if (getbulan($tglaw, $tglak)) {
        foreach (getbulan($tglaw, $tglak) as $b) {
            if ($no_kend == "all") {
                $data = $db->query('SELECT ifnull(SUM(nilai_real),0) as jml FROM `tbservice` where MONTH(tglsrv) = ' . $b . ' and isnull(deleteby) AND tglsrv>="' . $tglaw . '" AND tglsrv<="' . $tglak . '"')->getRow()->jml;
            } else {
                $data = $db->query('SELECT ifnull(SUM(nilai_real),0) as jml FROM `tbservice` where MONTH(tglsrv) = ' . $b . ' and no_kend="' . $no_kend . '" and isnull(deleteby) AND tglsrv>="' . $tglaw . '" AND tglsrv<="' . $tglak . '"')->getRow()->jml;
            }
            $data_all[] = $data;
        }
        $data_all_str = '';
        foreach ($data_all as $d) {
            $data_all_str .=  $d . ',';
        }
        return $data_all_str;
    } else {
        return null;
    }
}
function srv_d($nosrv)
{
    $db = \Config\Database::connect();
    $result = $db->table('tbservice_d')
        ->join('tbmservice', 'tbmservice.no=tbservice_d.kdjns')
        ->where('nosrv', $nosrv)
        ->orderBy('urut', 'ASC')
        ->get()->getResult();
    return $result;
}
function get_tgl_ak($no_kend)
{
    $db = \Config\Database::connect();
    $result = $db->table('tbbbm')
        ->where('no_kend', $no_kend)
        ->where('deleteby', null)
        ->orderBy('tglisi', 'DESC')
        ->get()->getRow();
    if ($result) {
        return $result->tglisi;
    } else {
        return null;
    }
}
function get_tgl_ak_parkir($no_kend)
{
    $db = \Config\Database::connect();
    $result = $db->table('tbbiaya')
        ->where('no_kend', $no_kend)
        ->where('deleteby', null)
        ->orderBy('tgl', 'DESC')
        ->get()->getRow();
    if ($result) {
        return $result->tgl;
    } else {
        return null;
    }
}
function get_km_ak($no_kend)
{
    $db = \Config\Database::connect();
    $result = $db->table('tbbbm')
        ->where('no_kend', $no_kend)
        ->where('deleteby', null)
        ->orderBy('tglisi', 'DESC')
        ->get()->getRow();
    if ($result) {
        return $result->km;
    } else {
        return null;
    }
}
function get_no($no_kend)
{
    $bagian1 = substr($no_kend, 0, 2);
    if (filter_var($bagian1, FILTER_SANITIZE_NUMBER_INT)) {
        $bagian1 = substr($no_kend, 0, 1);
    }
    $bagian2 = filter_var($no_kend, FILTER_SANITIZE_NUMBER_INT);
    $bagian3 = substr($no_kend, -3);
    if (filter_var($bagian3, FILTER_SANITIZE_NUMBER_INT)) {
        $bagian3 = substr($bagian3, -2);

        if (filter_var($bagian3, FILTER_SANITIZE_NUMBER_INT)) {
            $bagian3 = substr($bagian3, -1);
        }
    }
    $nomor = $bagian1 . ' ' . $bagian2 . ' ' . $bagian3;
    return $nomor;
}
function get_nm_bln($no)
{
    switch ($no) {
        case '1':
            return "Januari";
            break;
        case '2':
            return "Februari";
            break;
        case '3':
            return "Maret";
            break;
        case '4':
            return "April";
            break;
        case '5':
            return "Mei";
            break;
        case '6':
            return "Juni";
            break;
        case '7':
            return "Juli";
            break;
        case '8':
            return "Agustus";
            break;
        case '9':
            return "September";
            break;
        case '10':
            return "Oktober";
            break;
        case '11':
            return "November";
            break;
        case '12':
            return "Desember";
            break;

        default:
            return "Tidak ada";
            break;
    }
}
function get_tglaw_bln($no, $thn)
{
    if (strlen($no) == 1) {
        $no = "0" . $no;
    }
    return date($thn . '-' . $no . '-01');
}
function get_tglak_bln($no, $thn)
{
    if (strlen($no) == 1) {
        $no = "0" . $no;
    }
    return date($thn . '-' . $no . '-t');
}
function jns_service($kdjns)
{
    $db = \Config\Database::connect();
    $result = $db->table('tbmservice')->where('no', $kdjns)->get()->getRow()->service;
    if ($result) {
        return $result;
    } else {
        return 0;
    }
}
function km_tahun($no_kend, $thn)
{
    $db = \Config\Database::connect();
    $km_awal = $db->query('select km from tbbbm where no_kend="' . $no_kend . '" and YEAR(tglisi)=' . $thn . ' order by tglisi ASC')->getRow()->km;
    $km_akhir = $db->query('select km from tbbbm where no_kend="' . $no_kend . '" and YEAR(tglisi)=' . $thn . ' order by tglisi DESC')->getRow()->km;
    $liter = $db->query('select sum(liter) as liter from tbbbm where no_kend="' . $no_kend . '" and YEAR(tglisi)=' . $thn)->getRow()->liter;
    $avg = ($km_akhir - $km_awal) / $liter;

    return round($avg, 2);
}
function get_bengkel()
{
    $db = \Config\Database::connect();
    $result = $db->table('tbbengkel')->get()->getResult();
    $bengkel = '';
    if ($result) {
        foreach ($result as $b) {
            $bengkel .= '"' . $b->nama . '",';
        }
        return $bengkel;
    }
    return null;
}
