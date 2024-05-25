<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        select,
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        #bank_details,
        #e_payment_details {
            display: none;
        }
    </style>
</head>

<body>
    <h2>Payment Form</h2>
    <form action="../functions/process_payment.php" method="POST">
        <label for="payment_method">Select Payment Method:</label>
        <select name="payment_method" id="payment_method">
            <option value="bank">Bank Transfer</option>
            <option value="e_payment">E-Payment</option>
            <option value="cash_on_delivery">Cash on Delivery</option>
        </select><br><br>
        <label for="amount">Amount:</label>
        <input type="text" name="amount" id="amount" required><br><br>
        <div id="bank_details">
            <label for="bank_account">Bank Account:</label>
            <input type="text" name="bank_account" id="bank_account"><br><br>
        </div>
        <div id="e_payment_details">
            <label for="card_number">Card Number:</label>
            <input type="text" name="card_number" id="card_number"><br><br>
            <label for="expiry_date">Expiry Date:</label>
            <input type="text" name="expiry_date" id="expiry_date"><br><br>
        </div>
        <input type="submit" value="Submit Payment">
    </form>

    <script>
        document.getElementById('payment_method').addEventListener('change', function() {
            var bankDetails = document.getElementById('bank_details');
            var ePaymentDetails = document.getElementById('e_payment_details');

            if (this.value === 'bank') {
                bankDetails.style.display = 'block';
                ePaymentDetails.style.display = 'none';
            } else if (this.value === 'e_payment') {
                ePaymentDetails.style.display = 'block';
                bankDetails.style.display = 'none';
            } else {
                bankDetails.style.display = 'none';
                ePaymentDetails.style.display = 'none';
            }
        });
    </script>
</body>

</html>
