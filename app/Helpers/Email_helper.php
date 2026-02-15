<?php

// Check if the function already exists before declaring it
if (!function_exists('sendOrderConfirmationEmail')) {

    /**
     * Sends an order confirmation email to the customer.
     * This function prepares the email service, loads the email view,
     * and sends a formatted receipt to the user's email address.
     */
    function sendOrderConfirmationEmail($order, $orderItems, $userEmail, $userName)
    {
        // Initialize CodeIgniter's email service
        $email = service('email');
        
        // Set recipient email address and email subject line
        $email->setTo($userEmail);
        $email->setSubject('Order Receipt - Brew Haven Coffee Shop - Order #' . ($order['order_number'] ?? 'ORD-' . $order['id']));
        
        // Load the HTML email template and pass order details to the view
        $message = view('emails/order_confirmation', [
            'order' => $order,
            'orderItems' => $orderItems,
            'userName' => $userName
        ]);
        
        // Attach the formatted message to the email
        $email->setMessage($message);
        
        /**
         * Attempt to send the email.
         * Logs successful deliveries or errors for debugging.
         */
        try {
            if ($email->send()) {
                log_message('info', 'Order confirmation email sent to: ' . $userEmail);
                return true;
            } else {
                log_message('error', 'Failed to send email: ' . $email->printDebugger(['headers']));
                return false;
            }
        } catch (\Exception $e) {
            // Log any exception during sending
            log_message('error', 'Email sending failed: ' . $e->getMessage());
            return false;
        }
    }
}
