@component('mail::message')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .invoice-container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-footer {
            text-align: center;
            border-top: 2px solid #333;
            padding-top: 10px;
            margin-top: 20px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .invoice-table th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h2>Order Invoice</h2>
        </div>
        <div class="invoice-details">
            @php
                $getSetting = App\Models\SystemSettingModel::getSingle();
            @endphp
            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
            <p><strong>Date of Purchase:</strong> {{ date('d-m-Y', strtotime($order->created_at)) }}</p>
            <p><strong>Dear:</strong> {{ $order->first_name }}</p>
            <p>Thank you for your purchase with <strong>{{ $getSetting->website_name }}</strong>. We are pleased to confirm your order!</p>
        </div>
        <table class="invoice-table">
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
            <tfoot>
                <tr>
                    <td colspan="2" style="text-align: right;"><strong>Shipping Name:</strong></td>
                    <td>{{ $order->getShipping->name }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;"><strong>Shipping Amount::</strong></td>
                    <td>${{ number_format($order->shipping_amount) }}</td>
                </tr>
                @if(!empty($order->discount_code))
                    <tr>
                        <td colspan="2" style="text-align: right;"><strong>Discount Code:</strong></td>
                        <td>${{ $order->discount_code }}</td>
                    </tr>
                @endif
                <tr>
                    <td colspan="2" style="text-align: right;"><strong>Discount Amount:</strong></td>
                    <td>${{ number_format($order->discount_amount) }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;"><strong>Total Amount:</strong></td>
                    <td>${{ number_format($order->total_amount) }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;"><strong>Payment Method:</strong></td>
                    <td>{{ $order->payment_method }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>

@endcomponent
