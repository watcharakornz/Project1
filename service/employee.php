<?php

class Employee
{
    private $conn;
    private $table_name = "Employee";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function listUser($param = null)
    {
        $where = null;
        if (!empty($param['employee_id'])) {
            $where = " WHERE e.employee_id = :employee_id ";
        }

        $query = "SELECT
	e.employee_id,
	e.name,
	e.surename,
CASE
	WHEN e.sex = 'M' THEN
	'ชาย' 
	WHEN e.sex = 'F' THEN
	'หญิง' ELSE e.sex 
	END as sex,
	DATE_FORMAT( DATE_ADD( e.birth_dtm, INTERVAL 543 YEAR ), '%d/%m/%Y' ) AS birth_dtm,
	e.email,
	e.address,
	e.telephone,
	e.created_by,
	DATE_FORMAT( DATE_ADD( e.lastupd_dtm, INTERVAL 543 YEAR ), '%d/%m/%Y' ) AS lastupd_dtm,
	e.sex as sex_code,
	DATE_FORMAT( e.birth_dtm, '%Y-%m-%d' ) AS birth_dtm2
FROM
" . $this->table_name . " e" . $where;

        $stmt = $this->conn->prepare($query);

        if (!empty($param['employee_id'])) {
            $stmt->bindParam(':employee_id', $param['employee_id']);
        }

        $res = $stmt->execute();

        return array("execute" => $stmt, "status" => $res);
    }

    function insertUser($param)
    {
        $query = "INSERT INTO " . $this->table_name . " ( 
name,
surename, 
sex, 
birth_dtm, 
email, 
address, 
telephone, 
created_dtm, 
created_by
)
VALUES
	( 
	  :name,
	  :surename,
	  :sex,  
	  DATE_FORMAT( :birthdtm, '%Y-%m-%d' ),
	  :email, 
	  :address, 
	  :telephone, 
	  NOW( ), 
	  :created_by 
	  )";

        $stmt = $this->conn->prepare($query);

        $res = $stmt->execute(
            array(
                ':name' => htmlspecialchars(strip_tags($param['name'])),
                ':surename' => htmlspecialchars(strip_tags($param['surename'])),
                ':sex' => htmlspecialchars(strip_tags($param['sex'])),
                ':birthdtm' => htmlspecialchars(strip_tags($param['birthdtm'])),
                ':email' => htmlspecialchars(strip_tags($param['email'])),
                ':address' => htmlspecialchars(strip_tags($param['address'])),
                ':telephone' => htmlspecialchars(strip_tags($param['telephone'])),
                ':created_by' => ((empty($param['created_by'])) ? "admin" : htmlspecialchars(strip_tags($param['created_by']))),
            )
        );

        return array("execute" => $stmt, "status" => $res);
    }

    function deleteUser($param)
    {
        $query = "DELETE 
FROM
	" . $this->table_name . " 
WHERE
	employee_id = :employee_id";

        $stmt = $this->conn->prepare($query);

        $res = $stmt->execute(
            array(
                ':employee_id' => htmlspecialchars(strip_tags($param['employee_id'])),
            )
        );

        return array("execute" => $stmt, "status" => $res);
    }

    function updateUser($param)
    {
        $query = "UPDATE Project1.Employee e 
SET e.name = :name,
e.surename = :surename,
e.sex = :sex,
e.birth_dtm = DATE_FORMAT( :birthdtm, '%Y-%m-%d' ),
e.email = :email,
e.address = :address,
e.telephone = :telephone,
e.lastupd_dtm = NOW( ),
e.lastupd_by = :lastupd_by 
WHERE
	e.employee_id = :employee_id";

        $stmt = $this->conn->prepare($query);

        $res = $stmt->execute(
            array(
                ':employee_id' => htmlspecialchars(strip_tags($param['employee_id'])),
                ':name' => htmlspecialchars(strip_tags($param['name'])),
                ':surename' => htmlspecialchars(strip_tags($param['surename'])),
                ':sex' => htmlspecialchars(strip_tags($param['sex'])),
                ':birthdtm' => htmlspecialchars(strip_tags($param['birthdtm'])),
                ':email' => htmlspecialchars(strip_tags($param['email'])),
                ':address' => htmlspecialchars(strip_tags($param['address'])),
                ':telephone' => htmlspecialchars(strip_tags($param['telephone'])),
                ':lastupd_by' => ((empty($param['lastupd_by'])) ? "admin" : htmlspecialchars(strip_tags($param['lastupd_by']))),
            )
        );

        return array("execute" => $stmt, "status" => $res);
    }
}//class