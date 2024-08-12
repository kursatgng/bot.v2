<?php
require_once '../../src/config/database.php';
require_once '../../src/services/OrderService.php';

$input = json_decode(file_get_contents('php://input'), true);

$user_id = 1; // Örnek olarak; oturum açmış kullanıci
$amount = $input['amount'];
$price = $input['price'];

$orderService = new OrderService($db);
$response = $orderService->buyOrder($user_id, $amount, $price);

echo json_encode(['message' => $response]);
?>
