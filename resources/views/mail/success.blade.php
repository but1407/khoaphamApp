<div style="font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px;">

    <table style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <tr>
            <td style="text-align: center;">
                <img src="" alt="Your Logo" style="max-width: 150px;">
            </td>
        </tr>
        <tr>
            <td style="padding: 20px 0;">
                <h2 style="color: #333;">Đặt Hàng Thành Công!</h2>
                <p style="color: #666;">Cảm ơn bạn đã đặt hàng tại cửa hàng chúng tôi. Đơn hàng của bạn đã được xác nhận và đang được xử lý.</p>
            </td>
        </tr>
        <tr>
            <td>
                <h3 style="color: #333;">Chi Tiết Đơn Hàng</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    
                    <tr>
                        <th style="border-bottom: 1px solid #ddd; text-align: left; padding: 10px;">Sản Phẩm</th>
                        <th style="border-bottom: 1px solid #ddd; text-align: left; padding: 10px;">Số Lượng</th>
                        <th style="border-bottom: 1px solid #ddd; text-align: right; padding: 10px;">Thành Tiền</th>
                    </tr>
                    @php
                        $total = 0;
                    @endphp
                    @foreach($orders as $item)
                    @php
                        $total += $item['price'] * $item['qty']
                    @endphp
                        <tr>
                            <td style="padding: 10px;">{{ $item['name'] }}</td>
                            <td style="padding: 10px;">{{ $item['qty'] }}</td> 
                            <td style="padding: 10px; text-align: right;">${{ $item['qty'] * $item['price'] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" style="text-align: right; padding: 10px;"><strong>Tổng Tiền:</strong></td>
                        <td style="text-align: right; padding: 10px;"><strong>${{ $total }} VND</strong></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px 0;">
                <p style="color: #666;">Chúng tôi sẽ thông báo cho bạn khi đơn hàng của bạn đã được giao cho dịch vụ vận chuyển. Xin vui lòng kiểm tra email và tin nhắn điện thoại của bạn thường xuyên.</p>
            </td>
        </tr>
        <tr> 
            <td style="text-align: center;">
                <a href="{{ url('/') }}" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Quay Về Trang Chủ</a>
            </td>
        </tr> 
    </table>

    <p style="text-align: center; margin-top: 20px; color: #999;">Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi.</p>

</div>