<?php
require_once '../../src/config/database.php';
require_once '../../src/services/OrderService.php';

$orderService = new OrderService($db);
$orderService->processOrderBook();

echo "Emir defteri başarıyla işlendi.";
?>
