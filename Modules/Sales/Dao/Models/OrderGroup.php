<?php

namespace Modules\Sales\Dao\Models;

use Illuminate\Support\Str;
use Modules\group\Dao\Models\Area;
use Modules\group\Dao\Models\City;
use Modules\Finance\Dao\Models\Tax;
use Modules\Finance\Dao\Models\Top;
use Illuminate\Support\Facades\Auth;
use Modules\Crm\Dao\Models\Customer;
use Modules\group\Dao\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Modules\Finance\Dao\Models\Payment;
use Modules\Forwarder\Dao\Models\Vendor;
use Modules\group\Dao\Models\OrderDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Sales\Dao\Models\Order;
use Plugin\Helper;

class OrderGroup extends Model
{
    use SoftDeletes;
    protected $table = 'sales_group';
    protected $primaryKey = 'sales_group_id';
    protected $fillable = [
        'sales_group_id',
        'sales_group_created_at',
        'sales_group_created_by',
        'sales_group_updated_at',
        'sales_group_updated_by',
        'sales_group_deleted_at',
        'sales_group_deleted_by',
        'sales_group_date_order',
        'sales_group_date_invoice',
        'sales_group_date_order_wa',
        'sales_group_from_name',
        'sales_group_from_phone',
        'sales_group_from_email',
        'sales_group_from_address',
        'sales_group_from_area',
        'sales_group_status',
        'sales_group_notes_user',
        'sales_group_notes_admin',
        'sales_group_discount_code',
        'sales_group_discount_name',
        'sales_group_discount_value',
        'sales_group_sum_product',
        'sales_group_sum_discount',
        'sales_group_sum_ongkir',
        'sales_group_sum_total',
        'sales_group_payment_date',
        'sales_group_payment_bank_from',
        'sales_group_payment_person',
        'sales_group_payment_bank_to_id',
        'sales_group_payment_phone',
        'sales_group_payment_email',
        'sales_group_payment_attached',
        'sales_group_payment_value',
        'sales_group_payment_notes',
        'sales_group_core_user_id',
    ];

    public $timestamps = true;
    public $incrementing = false;
    public $rules = [
        'sales_group_phone' => 'required',
    ];

    const CREATED_AT = 'sales_group_created_at';
    const UPDATED_AT = 'sales_group_updated_at';
    const DELETED_AT = 'sales_group_deleted_at';

    public $searching = 'sales_group_id';
    public $datatable = [
        'sales_group_id' => [true => 'Code'],
        'sales_group_created_at' => [false => 'Delivery Date'],
        'sales_group_date_order' => [true => 'Delivery Date'],
        'crm_customer_name' => [false => 'Customer'],
        'sales_group_from_name' => [true => 'Pickup'],
        'sales_group_to_name' => [true => 'Contact'],
        'sales_group_to_phone' => [true => 'Phone'],
        'sales_group_status' => [true => 'Status'],
    ];

    protected $dates = [
        'sales_group_created_at',
        'sales_group_updated_at',
    ];

    protected $casts = [
        'sales_group_date_order' => 'datetime:Y-m-d',
        'sales_group_payment_date' => 'datetime:Y-m-d',
    ];

    public $status = [
        '1' => ['CREATE', 'warning'],
        '2' => ['PAID', 'primary'],
        '3' => ['PREPARE', 'success'],
        '4' => ['DELIVERED', 'dark'],
        '0' => ['CANCEL', 'danger'],
    ];

    public function order(){

        return $this->hasMany(Order::class, 'sales_order_group_id', 'sales_group_id');
    }

    public function detail()
    {
        return $this->hasMany(OrderDetail::class, 'sales_group_detail_order_id', 'sales_group_id');
    }

    public function payment()
    {
        return $this->hasMany(Payment::class, 'finance_payment_sales_group_id', 'sales_group_id');
    }

    public function tax()
    {
        return $this->hasOne(Tax::class, 'finance_tax_id', 'sales_group_tax_id');
    }

    public function Province()
    {
        return $this->hasOne(Province::class, 'rajaongkir_province_id', 'sales_group_rajaongkir_province_id');
    }

    public function City()
    {
        return $this->hasOne(City::class, 'rajaongkir_city_id', 'sales_group_rajaongkir_city_id');
    }

    public function from()
    {
        return $this->hasOne(Area::class, 'rajaongkir_area_id', 'sales_group_from_id');
    }

    public function to()
    {
        return $this->hasOne(Area::class, 'rajaongkir_area_id', 'sales_group_to_id');
    }

    public function Area()
    {
        return $this->hasOne(Area::class, 'rajaongkir_area_id', 'sales_group_rajaongkir_area_id');
    }

    public static function boot()
    {
        parent::boot();
       
        parent::creating(function($model){
            $model->sales_group_id = Helper::autoNumber($model->getTable(), $model->getKeyName(), 'GO' . date('Ym'), config('website.autonumber'));
        });
        parent::saving(function ($model) {
            // if(request()->has('sales_group_date_order')){
            //     $model->sales_group_date_order = $model->sales_group_date_order->format('Y-m-d H:i:s');
            // }
        });
    }
}
