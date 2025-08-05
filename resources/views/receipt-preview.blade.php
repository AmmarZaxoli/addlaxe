<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>فاتورة البيع</title>
    <style>
        body { font-family: Arial, sans-serif;
                font-size: 12px; margin: 20px; 
                size: A6;
            }
        table { width: 100%; border-collapse: collapse; margin-top: 20px;}
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #f5f5f5; }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h3>فاتورة البيع</h3>
        <p>رقم الفاتورة: {{ $data['invoice_id'] ?? '' }}</p>
        <p>التاريخ: {{ $data['date'] ?? '' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>اسم المنتج</th>
                <th>الكود</th>
                <th>الكمية</th>
                <th>السعر</th>
                <th>الإجمالي</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['products'] ?? [] as $product)
                <tr>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['code'] ?? '-' }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>{{ number_format($product['price'], 0, '.', ',') }} IQD</td>
                    <td>{{ number_format($product['total_price'], 0, '.', ',') }} IQD</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="text-align: right;">المجموع الكلي</th>
                <th>{{ number_format($data['total'] ?? 0, 0, '.', ',') }} IQD</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
