@component('mail::message')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .email-container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .email-header {
        text-align: center;
        padding: 20px 0;
        background-color: #007BFF;
        color: white;
        border-radius: 10px 10px 0 0;
    }
    .email-header h1 {
        margin: 0;
        font-size: 24px;
    }
    .email-body {
        padding: 20px;
    }
    .order-details table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .order-details table th, .order-details table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    .order-details table th {
        background-color: #f1f1f1;
    }
    .order-details .total {
        font-weight: bold;
        font-size: 16px;
    }
    .footer {
        text-align: center;
        font-size: 14px;
        color: #555;
        padding: 20px 0;
    }
    .footer a {
        color: #007BFF;
        text-decoration: none;
    }
</style>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Order Detail</h1>
            <ul>
                <li>Order Number: {{ $order->order_number }}</li>
                <li>Date of Purchase: {{ date('d-m-Y', strtotime($order->created_at)) }}</li>
            </ul>
        </div>
        <div class="email-body">
            <p>Dear {{ $order->first_name }},</p>
            <p>Thank you for your purchase!</p>

            <div class="order-details">
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->getItem as $item)
                            <tr>
                                <td>
                                    {{ $item->getProduct->title }}
                                    <br>
                                    Color: {{ $item->color_name }}
                                    @if(!empty($item->size_name))
                                        <br>
                                        Size: {{ $item->size_name }}
                                        <br>
                                        Size Amount: ${{ number_format($item->size_amount) }}
                                    @endif
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{number_format( $item->total_price) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <p>Shipping Name: ${{ $order->getShipping->name }}</p>
            <p>Shipping Amount: ${{ number_format($order->shipping_amount) }}</p>
            @if(!empty($order->discount_code))
                <p>Discount Code: ${{ $order->discount_code }}</p>
                <p>Discount Amount: ${{ number_format($order->discount_amount) }}</p>
            @endif
            <p>Total Amount: ${{ number_format($order->total_amount) }}</p>
            <p>Paymen Method: {{ $order->payment_method }}</p>

        </div>
        <div class="footer">
            <p>Thank you for choosing E-commerce.</p>
            <p><a href="E-commerce">Visit our website</a></p>
        </div>
    </div>
</body>

Thanks,<br>
{{ config('app.name') }}

@endcomponent
