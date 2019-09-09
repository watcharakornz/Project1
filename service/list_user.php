<?php
header('Content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: http://localhost');
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With, Authorization, Token");
header("Access-Control-Allow-Methods: GET, POST");

include "./database.php";
include "./employee.php";

$array_request = json_decode(file_get_contents('php://input'), TRUE);
$database = new Database();

if (!empty(getallheaders()['Token'])) {

$db = $database->getConnection();
$employee = new Employee($db);

$stmt = $employee->listUser($array_request);
$db->conn = null;
$num = $stmt['execute']->rowCount();

if ($num > 0) {

    $result = $stmt['execute']->fetchAll(PDO::FETCH_ASSOC);

    if ($stmt['status']) {
        http_response_code($database->code['success']);
        $ret_dat['status'] = "success";
        $ret_dat['status_code'] = $database->code["success"];
        $ret_dat['description'] = null;
        $ret_dat['data'] = $result;
    } else {
        http_response_code($database->code['failed']);
        $ret_dat['status'] = "failed";
        $ret_dat['status_code'] = $database->code["failed"];
        $ret_dat['description'] = "พบปัญหา เนื่องจาก: " . $stmt['execute']->errorInfo()[2];
        $ret_dat['data'] = null;
    }

} else {
    http_response_code($database->code['not_found']);

    $ret_dat['status'] = "success";
    $ret_dat['status_code'] = $database->code["not_found"];
    $ret_dat['description'] = "ไม่พบข้อมูล";
    $ret_dat['data'] = null;

}
} else {
    http_response_code($database->code["bad_request"]);
    $ret_dat = array(
        "status" => "failed",
        "status_code" => $database->code["bad_request"],
        "description" => "bad request",
    );
}
echo stripslashes(json_encode($ret_dat, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));


