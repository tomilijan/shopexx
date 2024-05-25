<?php
require '../config/dbconn.php';

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

function processBankPayment($amount, $bankAccount)
{
    return "Bank payment of $amount from account $bankAccount processed successfully.";
}

function processEPayment($amount, $cardNumber, $expiryDate)
{
    return "E-payment of $amount from card $cardNumber processed successfully.";
}

function processCashOnDelivery($amount)
{
    return "Cash on delivery payment of $amount confirmed.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paymentMethod = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);

    if ($paymentMethod === 'bank') {
        $bankAccount = mysqli_real_escape_string($conn, $_POST['bank_account']);
        $paymentResult = processBankPayment($amount, $bankAccount);
    } elseif ($paymentMethod === 'e_payment') {
        $cardNumber = mysqli_real_escape_string($conn, $_POST['card_number']);
        $expiryDate = mysqli_real_escape_string($conn, $_POST['expiry_date']);
        $paymentResult = processEPayment($amount, $cardNumber, $expiryDate);
    } elseif ($paymentMethod === 'cash_on_delivery') {
        $paymentResult = processCashOnDelivery($amount);
    } else {
        $paymentResult = 'Invalid payment method selected.';
    }

    $stmt = $conn->prepare("INSERT INTO payments (payment_method, amount, result) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $paymentMethod, $amount, $paymentResult);

    if ($stmt->execute()) {
        // Removed echo statement
        header("Location: ../display/checkout.php");
        exit();
    } else {
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
