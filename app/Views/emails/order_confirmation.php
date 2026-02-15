<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { 
            font-family: Arial, sans-serif; 
            line-height: 1.6; 
            color: #333; 
            margin: 0; 
            padding: 0; 
            background: #f8f9fa;
        }
        .container { 
            max-width: 600px; 
            margin: 0 auto; 
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header { 
            background: #5d4037; 
            color: white; 
            padding: 30px; 
            text-align: center; 
        }
        .content { 
            padding: 30px; 
            background: #ffffff;
        }
        .order-details { 
            background: white; 
            padding: 20px; 
            margin: 20px 0; 
            border-radius: 8px; 
            border: 1px solid #e0e0e0;
        }
        .footer { 
            text-align: center; 
            padding: 20px; 
            font-size: 12px; 
            color: #666; 
            background: #f5f5f5; 
        }
        .item { 
            border-bottom: 1px solid #eee; 
            padding: 15px 0; 
        }
        .item:last-child { 
            border-bottom: none; 
        }
        .total { 
            font-size: 18px; 
            font-weight: bold; 
            color: #5d4037; 
            text-align: right; 
            margin-top: 20px; 
        }
        .button { 
            display: inline-block; 
            padding: 12px 24px; 
            background: #5d4037; 
            color: white; 
            text-decoration: none; 
            border-radius: 5px; 
            margin: 10px 0; 
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>☕ Brew Haven Coffee Shop</h1>
            <h2>Order Confirmed!</h2>
        </div>
        
        <div class="content">
            <!-- Personalized greeting with customer name -->
            <p>Hello <strong><?= $userName ?></strong>,</p>
            <p>Thank you for your order! We're preparing your coffee with love and it will be ready soon.</p>
            
            <!-- Order summary section -->
            <div class="order-details">
                <h3 style="color: #5d4037; margin-top: 0;">Order Details</h3>
                <!-- Order number display -->
                <p><strong>Order Number:</strong> <?= $order['order_number'] ?? 'ORD-' . $order['id'] ?></p>
                <!-- Formatted order date -->
                <p><strong>Order Date:</strong> <?= date('F j, Y g:i A', strtotime($order['created_at'])) ?></p>
                <!-- Total amount with proper formatting -->
                <p><strong>Total Amount:</strong> $<?= number_format($order['total_amount'], 2) ?></p>
                <!-- Order status with color coding -->
                <p><strong>Status:</strong> <span style="color: #4caf50;"><?= ucfirst($order['status']) ?></span></p>
                <!-- Shipping address -->
                <p><strong>Shipping Address:</strong> <?= $order['shipping_address'] ?></p>
                <!-- Payment method with formatting -->
                <p><strong>Payment Method:</strong> <?= ucwords(str_replace('_', ' ', $order['payment_method'])) ?></p>
            </div>

            <!-- Order items section -->
            <h3 style="color: #5d4037;">Your Order Items</h3>
            <?php foreach ($orderItems as $item): ?>
                <div class="item">
                    <!-- Product name -->
                    <strong style="color: #5d4037;"><?= $item['name'] ?></strong><br>
                    <!-- Item customization details -->
                    <small>
                        Quantity: <?= $item['quantity'] ?> | 
                        Size: <?= ucfirst($item['size']) ?> | 
                        Milk: <?= ucfirst(str_replace('_', ' ', $item['milk_type'])) ?> | 
                        Sweetness: <?= ucfirst($item['sweetness']) ?>
                    </small><br>
                    <!-- Item total price -->
                    <strong>Price: $<?= number_format($item['price'] * $item['quantity'], 2) ?></strong>
                    <!-- Special instructions if provided -->
                    <?php if (!empty($item['special_instructions'])): ?>
                        <br><em style="color: #666;">Notes: <?= $item['special_instructions'] ?></em>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            
            <!-- Grand total display -->
            <div class="total">
                Total: $<?= number_format($order['total_amount'], 2) ?>
            </div>
            
            <!-- Order tracking information -->
            <p>We'll notify you when your order is ready. You can also track your order status in your account.</p>
            
            <!-- Call-to-action button to view orders -->
            <div style="text-align: center; margin: 25px 0;">
                <a href="<?= base_url('/orders') ?>" class="button">View Your Orders</a>
            </div>
            
            <!-- Closing message -->
            <p>Thank you for choosing Brew Haven Coffee Shop!</p>
        </div>
        
        <!-- Footer with contact information -->
        <div class="footer">
            <p><strong>Brew Haven Coffee Shop</strong><br>
            Contact: info@brewhaven.com | Phone: (555) 123-COFFEE</p>
            <p>© <?= date('Y') ?> Brew Haven Coffee Shop. All rights reserved.</p>
        </div>
    </div>
</body>
</html>