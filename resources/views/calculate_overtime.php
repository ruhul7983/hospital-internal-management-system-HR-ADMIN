<?php
include 'db.php';

$employee_id = 1; // Example: employee with ID 1

$sql = "SELECT e.name AS employee_name, d.name AS department_name, s.name AS shift_name, 
                ew.hours_worked, ew.overtime_hours, ew.overtime_rate
        FROM employee_working_hours ew
        JOIN employees e ON ew.employee_id = e.id
        JOIN departments d ON ew.department_id = d.id
        JOIN shifts s ON ew.shift_id = s.id
        WHERE ew.employee_id = :employee_id";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':employee_id', $employee_id);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $overtime_pay = $result['overtime_hours'] * $result['overtime_rate'];
    echo "Employee: " . $result['employee_name'] . "<br>";
    echo "Department: " . $result['department_name'] . "<br>";
    echo "Shift: " . $result['shift_name'] . "<br>";
    echo "Hours Worked: " . $result['hours_worked'] . "<br>";
    echo "Overtime Hours: " . $result['overtime_hours'] . "<br>";
    echo "Overtime Pay: $" . number_format($overtime_pay, 2) . "<br>";
} else {
    echo "No records found for employee ID $employee_id.";
}
?>
