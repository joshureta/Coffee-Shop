<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Brew Haven Coffee Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background: #5d4037 !important;
        }
        .confirmation-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 30px;
            margin: 30px auto;
            max-width: 800px;
        }
        .btn-coffee {
            background: #5d4037;
            color: white;
            border: none;
        }
        .btn-coffee:hover {
            background: #4e342e;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Check if order data exists -->
        <?php if (isset($order) && $order): ?>
            <div class="confirmation-container text-center">
                <!-- Success confirmation section -->
                <div class="mb-4">
                    <!-- Success icon -->
                    <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                    <h1 class="text-success">Order Confirmed!</h1>
                    <p class="lead">Thank you for your order. We're preparing your coffee with love.</p>
                </div>
                
                <!-- Order details card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Order Details</h4>
                        <div class="row text-start">
                            <!-- Left column: Order information -->
                            <div class="col-md-6">
                                <!-- Order number -->
                                <p><strong>Order Number:</strong><br><?= $order['order_number'] ?? 'ORD-' . $order['id'] ?></p>
                                <!-- Order date formatted -->
                                <p><strong>Order Date:</strong><br><?= date('F j, Y g:i A', strtotime($order['created_at'])) ?></p>
                                <!-- Order status with badge -->
                                <p><strong>Status:</strong><br>
                                    <span class="badge bg-success"><?= ucfirst($order['status']) ?></span>
                                </p>
                            </div>
                            <!-- Right column: Payment and shipping -->
                            <div class="col-md-6">
                                <!-- Total amount -->
                                <p><strong>Total Amount:</strong><br>$<?= number_format($order['total_amount'], 2) ?></p>
                                <!-- Payment method -->
                                <p><strong>Payment Method:</strong><br><?= ucwords($order['payment_method']) ?></p>
                                <!-- Shipping address -->
                                <p><strong>Shipping To:</strong><br><?= $order['shipping_address'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order items section -->
                <?php if (isset($orderItems) && !empty($orderItems)): ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Order Items</h5>
                            <!-- Loop through each order item -->
                            <?php foreach ($orderItems as $item): ?>
                                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                    <!-- Item details -->
                                    <div class="text-start">
                                        <!-- Product name -->
                                        <strong><?= $item['name'] ?></strong>
                                        <br>
                                        <!-- Customization options -->
                                        <small class="text-muted">
                                            Size: <?= $item['size'] ?> | 
                                            Milk: <?= $item['milk_type'] ?> | 
                                            Sweetness: <?= $item['sweetness'] ?>
                                        </small>
                                    </div>
                                    <!-- Price and quantity -->
                                    <div class="text-end">
                                        <!-- Quantity and unit price -->
                                        <span><?= $item['quantity'] ?> x $<?= number_format($item['price'], 2) ?></span>
                                        <br>
                                        <!-- Item total -->
                                        <strong>$<?= number_format($item['quantity'] * $item['price'], 2) ?></strong>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Action buttons -->
                <div class="d-flex gap-3 justify-content-center">
                    <!-- Back to home button -->
                    <a href="/dashboard" class="btn btn-coffee">
                        <i class="fas fa-home me-2"></i>Back to Home
                    </a>
                    <!-- View orders button -->
                    <a href="/orders" class="btn btn-outline-secondary">
                        <i class="fas fa-history me-2"></i>View Orders
                    </a>
                </div>
            </div>
        <?php else: ?>
            <!-- Order not found state -->
            <div class="confirmation-container text-center">
                <!-- Error icon -->
                <i class="fas fa-exclamation-circle fa-4x text-danger mb-3"></i>
                <h1 class="text-danger">Order Not Found</h1>
                <p class="lead">We couldn't find the order you're looking for.</p>
                <!-- Back to home button -->
                <a href="/dashboard" class="btn btn-coffee">Back to Home</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>