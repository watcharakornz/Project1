<?php
header('Content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: http://localhost');
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With, Authorization, Token");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");

$ts = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: $ts");
header("Last-Modified: $ts");
header("Pragma: no-cache");
header("Cache-Control: no-cache, must-revalidate");

include "./database.php";
include "./employee.php";

$array_request = json_decode(file_get_contents('php://input'), TRUE);
$database = new Database();

if (
    !empty($array_request['employee_id']) &&
    !empty(getallheaders()['Token'])
) {

    $db = $database->getConnection();
    $employee = new Employee($db);

    $stmt = $employee->deleteUser($array_request);
    $db->conn = null;

    if ($stmt['status']) {
        http_response_code($database->code['success']);
        $ret_dat['status'] = "success";
        $ret_dat['status_code'] = $database->code["success"];
        $ret_dat['description'] = "ลบข้อมูลสำเร็จ";
    } else {
        http_response_code($database->code['failed']);
        $ret_dat['status'] = "failed";
        $ret_dat['status_code'] = $database->code["failed"];
        $ret_dat['description'] = "ลบข้อมูลไม่สำเร็จ เนื่องจาก: " . $stmt['execute']->errorInfo()[2];
    }

} else {
    http_response_code($database->code['bad_request']);
    $ret_dat = array(
        "status" => "failed",
        "status_code" => $database->code["bad_request"],
        "description" => "bad request",
    );
}
echo stripslashes(json_encode($ret_dat, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));


