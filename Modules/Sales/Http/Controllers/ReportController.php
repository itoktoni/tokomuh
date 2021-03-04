<?php

namespace Modules\Sales\Http\Controllers;

use App\Dao\Repositories\BranchRepository;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Excel;
use Modules\Finance\Dao\Models\Payment;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Marketing\Dao\Repositories\PromoRepository;
use Modules\Rajaongkir\Dao\Repositories\CourierRepository;
use Modules\Sales\Dao\Repositories\OrderRepository;
use Modules\Sales\Dao\Repositories\report\ReportDeliveryRepository;
use Modules\Sales\Dao\Repositories\report\ReportDetailOrderRepository;
use Modules\Sales\Dao\Repositories\report\ReportPaymentRepository;
use Modules\Sales\Dao\Repositories\report\ReportProductionRepository;
use Modules\Sales\Dao\Repositories\report\ReportSummaryOrderRepository;
use Plugin\Helper;

class ReportController extends Controller
{
    public $template;
    public $folder;
    public $excel;
    public static $model;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
        $this->template = Helper::getTemplate(__CLASS__);
    }

    public function index()
    {
        return redirect()->route($this->getModule() . '_data');
    }

    private function share($data = [])
    {
        $purchase = Helper::shareOption(new OrderRepository());
        $promo = Helper::shareOption(new PromoRepository())->prepend('Select All Promo', '');
        $status = Helper::shareStatus((new OrderRepository())->status)->prepend('All Status', '');

        $view = [
            'promo' => $promo,
            'status' => $status,
            'purchase' => $purchase,
            'template' => $this->template,
        ];

        return array_merge($view, $data);
    }

    public function order_summary()
    {
        if (request()->isMethod('POST')) {
            $name = 'report_sales_order_' . date('Y_m_d') . '.xlsx';
            return $this->excel->download(new ReportSummaryOrderRepository(), $name);
        }
        
        $branch = Helper::shareOption(new BranchRepository(), false, true)->pluck('branch_name', 'branch_id')->prepend('Select Branch', '');
        $courier = Helper::shareOption(new CourierRepository(), false, true)->pluck('rajaongkir_courier_name', 'rajaongkir_courier_code')->prepend('Select Courier', '');
        $order = Helper::shareOption(new OrderRepository());

        return view(Helper::setViewForm($this->template, __FUNCTION__, config('folder')))->with($this->share([
            'data_branch' => $branch,
            'data_courier' => $courier,
            'data_order' => $order,
        ]));
    }

    public function order_detail()
    {
        if (request()->isMethod('POST')) {
            $name = 'report_sales_order_detail_' . date('Y_m_d') . '.xlsx';
            return $this->excel->download(new ReportDetailOrderRepository(), $name);
        }

        $product = Helper::shareOption(new ProductRepository());
        $order = Helper::shareOption(new OrderRepository());
        $branch = Helper::shareOption(new BranchRepository(), false, true)->pluck('branch_name', 'branch_id')->prepend('Select Branch', '');

        return view(Helper::setViewForm($this->template, __FUNCTION__, config('folder')))->with($this->share([
            'data_product' => $product,
            'data_branch' => $branch,
            'data_order' => $order,
        ]));
    }

    public function payment()
    {
        if (request()->isMethod('POST')) {
            $name = 'report_payment_' . date('Y_m_d') . '.xlsx';
            return $this->excel->download(new ReportPaymentRepository(), $name);
        }
        
        $branch = Helper::shareOption(new BranchRepository(), false, true)->pluck('branch_name', 'branch_id')->prepend('Select Branch', '');
        $payment = new Payment();
        return view(Helper::setViewForm($this->template, __FUNCTION__, config('folder')))->with($this->share([
            'status' => Helper::shareStatus($payment->status),
            'data_branch' => $branch,
        ]));

    }

    public function delivery()
    {
        if (request()->isMethod('POST')) {
            $name = 'report_delivery_' . date('Y_m_d') . '.xlsx';
            return $this->excel->download(new ReportDeliveryRepository(), $name);
        }
        return view(Helper::setViewForm($this->template, __FUNCTION__, config('folder')))->with($this->share());
    }

}
