<?php

require_once 'app/base/bootstrap.php';

try {
    handleRequest();
}
catch (Exception $e) {
    sendResponse(['message' => $e->getMessage(), 'error' => true]);
}