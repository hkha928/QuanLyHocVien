<?php
$controllers = array(
    'pages' => ['home', 'error'],
    'hocvien' => ['index', 'showHocVien', 'addHocVien', 'showAddHocVien', 'updateHocVien', 'showUpdateHocVien', 'removeHocVien', 'checkMaHocVien'],
    'khoahoc' => ['index', 'showKhoaHoc', 'addKhoaHoc', 'showAddKhoaHoc', 'updateKhoaHoc', 'showUpdateKhoaHoc', 'removeKhoaHoc', 'checkMaKhoaHoc'],
    'lophoc' => ['index', 'showLopHoc', 'addLopHoc', 'showAddLopHoc', 'updateLopHoc', 'showUpdateLopHoc', 'removeLopHoc', 'checkMaLopHoc'],
);

if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'pages';
    $action = 'error';
}

include_once('controllers/' . $controller . '_controller.php');
$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
$controller = new $klass;
$controller->$action();
