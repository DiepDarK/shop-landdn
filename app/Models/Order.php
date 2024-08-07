<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_ORDER = [
        'cho_xac_nhan' => 'Chờ xác nhận',
        'da_xac_nhan' => 'Đã xác nhận',
        'dang_chuan_bi' => 'Đang chuẩn bị hàng',
        'dang_van_chuyen' => 'Đang vận chuyển',
        'da_giao_hang' => 'Giao hàng thành công',
        'da_huy' => 'Đơn hàng đã hủy',
    ];
    const STATUS_PAY = [
        'chua_thanh_toan' => 'Chưa thanh toán',
        'da_thanh_toan' => 'Đã thanh toán',
    ];
    const CHO_XAC_NHAN = 'cho_xac_nhan';
    const DA_XAC_NHAN = 'da_xac_nhan';
    const DANG_CHUAN_BI = 'dang_chuan_bi';
    const DANG_VAN_CHUYEN = 'dang_van_chuyen';
    const DA_GIAO_HANG = 'da_giao_hang';
    const DA_HUY = 'da_huy';
    const CHUA_THANH_TOAN = 'chua_thanh_toan';
    const DA_THANH_TOAN = 'da_thanh_toan';

    protected $fillable = [
        'order_code',
        'user_id',
        'name_P',
        'email_P',
        'phone_P',
        'address_P',
        'note',
        'status_order',
        'status_pay',
        'payment',
        'ship',
        'total_payment',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function orderDetail() {
        return $this->hasMany(OrderDetail::class);
    }
}
