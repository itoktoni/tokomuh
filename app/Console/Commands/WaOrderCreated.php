<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Finance\Dao\Facades\BankFacades;
use Modules\Sales\Dao\Facades\OrderGroupFacades;
use Plugin\Helper;
use Plugin\Whatsapp;

class WaOrderCreated extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wa:order_created';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Commands To Sending Wa to customer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $order_group = $message = null;
        $order_group = OrderGroupFacades::where('sales_group_status', 1)->whereNull('sales_group_date_wa_created_wa')->limit(1)->get();
        if ($order_group) {
            foreach ($order_group as $group_item) {

                $message = "*NOTIFIKASI CUSTOMER* \n \n";
                $message = $message . "*No. Order : " . $group_item->sales_group_id . "* \n";
                $message = $message . "Customer : $group_item->sales_group_customer_name \n";
                $message = $message . "Alamat : $group_item->sales_group_customer_address \n";

                $data_order = $group_item->order;
                if ($data_order->count() > 0) {

                    $branch = null;
                    foreach ($data_order as $order_item) {
                        $message = $message . "Branch : $order_item->sales_order_from_name \n";

                        foreach ($order_item->detail as $detail) {
                            $message = $message . "Produk : \n";
                            $number = 1;

                            $message = $message . ' ' . $detail->sales_order_detail_item_product_description . ' (' .$detail->sales_order_detail_qty . ') x ' . Helper::createRupiah($detail->sales_order_detail_price) . '' . ' = ' . Helper::createRupiah($detail->sales_order_detail_total) . '\n';
                            $number++;
                        }
                    }

                    $message = $message . '\nSub Total : ' . Helper::createRupiah($order_item->sales_order_sum_product) . '\n';
                    $message = $message . '\nOngkir : ' . Helper::createRupiah($order_item->sales_order_sum_ongkir) . '\n';
                    $message = $message . '\nTotal: ' . Helper::createRupiah($order_item->sales_order_sum_total) . '\n';
                    $branch = $message;
                    
                }

                $message = $message . '\nTOTAL VALUE : ' . Helper::createRupiah($group_item->sales_group_sum_total) . '\n';
                if ($group_item->sales_group_discount_value > 0) {

                    $message = $message . 'PROMO : ' . $group_item->sales_group_discount_name . ' ( ' . Helper::createRupiah($group_item->sales_group_discount_value) . ') \n';
                }
                $message = $message . 'TOTAL ONGKIR : ' . Helper::createRupiah($group_item->sales_group_sum_ongkir) . '\n';
                $message = $message . 'TOTAL ORDER: *' . Helper::createRupiah($group_item->sales_group_sum_total) . '*\n';

                $message = $message.'\nPembayaran ke Rekening : \n';
                foreach (BankFacades::where('finance_bank_active', 1) as $account) {
                    $message = $message.$account->finance_bank_name.' a.n '.$account->finance_bank_account_name.' : '.$account->finance_bank_account_number.'\n';
                }

                $group_item->sales_group_date_wa_created_wa = date('Y-m-d H:i:s');
                $group_item->save();
                
                Whatsapp::send($group_item->sales_group_customer_phone, $message);
            }

        }

        // $order_data = $data = $message = null;
        // $order_data = $order->dataRepository()->where('sales_order_status', 2)->whereNull('sales_order_estimate_wa')->limit(1)->get();
        // if ($order_data) {
        //     foreach ($order_data as $order_item) {
        //         $data = $order->showRepository($order_item->sales_order_id, ['customer', 'detail', 'detail.product', 'detail.brand']);

        //         $message = "*NOTIFIKASI PESANAN* \n \n";
        //         $message = $message. "*No. Order : ".$data->sales_order_id."* \n";
        //         $message = $message. "Customer : $data->sales_order_rajaongkir_name \n";
        //         $message = $message. "Alamat : $data->sales_order_rajaongkir_address \n \n";
        //         $message = $message. "Produk : \n";
        //         $number = 1;
        //         $total = 0;
        //         foreach ($data->detail as $detail) {
        //             $sub = $detail->sales_order_detail_qty_order * $detail->sales_order_detail_price_order;
        //             $total = $total + $sub;

        //             $message = $message.$detail->sales_order_detail_qty_order.' '.$detail->product->item_product_name.' x ('.Helper::createRupiah($detail->sales_order_detail_price_order).')'.' = '.Helper::createRupiah($detail->sales_order_detail_total_order). '\n' ;
        //             $number++;
        //         }
        //         $message = $message.'\nSub Total : '.Helper::createRupiah($total).'\n';
        //         $message = $message.'PROMO : '.($data->sales_order_marketing_promo_value ? $data->sales_order_marketing_promo_name.' : -'.Helper::createRupiah($data->sales_order_marketing_promo_value) : '-0').' \n';
        //         $message = $message.'ONGKIR : '.Helper::createRupiah($data->sales_order_rajaongkir_ongkir).'\n';
        //         $message = $message.'TOTAL : '.Helper::createRupiah($data->sales_order_total + $data->sales_order_rajaongkir_ongkir).'\n';

        //         $message = $message.'\nPembayaran ke Rekening : \n';
        //         $bank = new BankRepository();
        //         foreach ($bank->dataRepository()->get() as $account) {
        //             $message = $message.$account->finance_bank_name.' a.n '.$account->finance_bank_account_name.' : '.$account->finance_bank_account_number.'\n';
        //         }

        //         $message = $message.'\nPromo : '.config('website.promo').'\n';
        //         $this->sendWa($data->sales_order_rajaongkir_phone, $message);

        //         $data->sales_order_estimate_wa = date('Y-m-d H:i:s');
        //         $data->save();
        //     }
        // }

        // $order_data = $data = $message = null;
        // $order_data = $order->dataRepository()->where('sales_order_status', 6)->whereNull('sales_order_delivery_wa')->limit(1)->get();
        // if ($order_data) {
        //     foreach ($order_data as $order_item) {
        //         $data = $order->showRepository($order_item->sales_order_id, ['customer', 'detail', 'detail.product', 'detail.brand']);
        //         $brands = $order->brand()->where($order->getKeyName(), $order_item->sales_order_id)->groupBy('item_brand_id')->get();
        //         $message = "*NOTIFIKASI PENGIRIMAN* \n \n";
        //         $message = $message."Terimakasih untuk Pembayaran atas Pesanan berikut : \n \n";
        //         $message = $message. "No. Order : $data->sales_order_id \n";
        //         $message = $message. "Customer : $data->sales_order_rajaongkir_name \n";
        //         $message = $message. "Alamat : $data->sales_order_rajaongkir_address";

        //         $total = 0;
        //         foreach ($brands as $brand) {
        //             $message = $message. "\n \nBranch : $brand->item_brand_name - $brand->item_brand_description \n";
        //             $message = $message. "Ongkir : ".Helper::createRupiah($brand->sales_order_detail_ongkir,0,',','.')." \n";
        //             $message = $message. "No. Resi : $brand->sales_order_detail_waybill \n";

        //             foreach ($data->detail as $detail) {
        //                 if ($detail->product->item_product_item_brand_id == $brand->item_brand_id) {
        //                     $message = $message. "Produk : \n";
        //                     $number = 1;

        //                     $sub = $detail->sales_order_detail_qty_order * $detail->sales_order_detail_price_order;
        //                     $total = $total + $sub;

        //                     $message = $message.$detail->sales_order_detail_qty_order.' '.$detail->product->item_product_name.' x ('.Helper::createRupiah($detail->sales_order_detail_price_order).')'.' = '.Helper::createRupiah($detail->sales_order_detail_total_order). '\n' ;
        //                     $number++;
        //                 }
        //             }
        //         }

        //         $message = $message.'\nSub Total : '.Helper::createRupiah($total).'\n';
        //         $message = $message.'PROMO : '.($data->sales_order_marketing_promo_value ? $data->sales_order_marketing_promo_name.' : -'.Helper::createRupiah($data->sales_order_marketing_promo_value) : '-0').' \n';
        //         $message = $message.'ONGKIR : '.Helper::createRupiah($data->sales_order_rajaongkir_ongkir).'\n';
        //         $message = $message.'TOTAL : '.Helper::createRupiah($data->sales_order_total + $data->sales_order_rajaongkir_ongkir).'\n \n';
        //         $message = $message."Pesanan dalam proses pengiriman. Mohon di tunggu. Terimakasih";

        //         $this->sendWa($data->sales_order_rajaongkir_phone, $message);

        //         $data->sales_order_delivery_wa = date('Y-m-d H:i:s');
        //         $data->save();
        //     }
        // }

        // $payment_data = $data = $message = null;
        // $payment_data = $payment->dataRepository()->whereNull('finance_payment_reference')->whereNull('finance_payment_wa_date')->limit(1)->get();
        // if ($payment_data) {
        //     foreach ($payment_data as $payment_item) {
        //         $data = $payment->showRepository($payment_item->finance_payment_id);
        //         $message = "*NOTIFIKASI KONFIRMASI PEMBAYARAN* \n \n";
        //         $message = $message. "No. Order : $data->finance_payment_sales_order_id \n";
        //         $message = $message. "Nama : $data->finance_payment_person \n";
        //         $message = $message. "Tanggal Pembayaran : ".$data->finance_payment_date->format('d M Y'). "\n";
        //         $message = $message. "Jumlah : ". Helper::createRupiah($data->finance_payment_amount)." \n";
        //         $message = $message. "Catatan : $data->finance_payment_note \n";
        //         $this->sendWa($data->finance_payment_phone, $message);

        //         // Mail::to([$payment_item->finance_payment_email, config('website.email')])->send(new ConfirmationPaymentEmail($data));
        //         $data->finance_payment_wa_date = date('Y-m-d H:i:s');
        //         $data->save();
        //     }
        // }

        // $payment_data = $data_order = $data = $message = null;
        // $payment_data = $payment->dataRepository()->whereNull('finance_payment_wa_approve_date')->whereNotNull('finance_payment_approved_at')->limit(1)->get();
        // if ($payment_data) {
        //     foreach ($payment_data as $payment_item) {
        //         $data = $payment->showRepository($payment_item->finance_payment_id);
        //         $message = "*NOTIFIKASI TERIMA PEMBAYARAN* \n \n";
        //         $message = $message. "No. Order : $data->finance_payment_sales_order_id \n";
        //         $message = $message. "Nama : $data->finance_payment_person \n";
        //         $message = $message. "Tgl Terima Pembayaran : ".$data->finance_payment_approved_at->format('d M Y')." \n";
        //         $message = $message. "Jumlah Terima: ". Helper::createRupiah($data->finance_payment_approve_amount)." \n";
        //         $message = $message. "Catatan admin : $data->finance_payment_description \n";
        //         $this->sendWa($data->finance_payment_phone, $message);

        //         // Mail::to([$data->finance_payment_email, config('website.email')])->send(new ApprovePaymentEmail($data));

        //         $data->finance_payment_wa_approve_date = date('Y-m-d H:i:s');
        //         $data->save();

        //         // proses notifikasi branch

        //         $data_order = $order->showRepository($data->finance_payment_sales_order_id, ['customer', 'detail', 'detail.product', 'detail.brand']);
        //         $brands = $order->brand()->where($order->getKeyName(), $data->finance_payment_sales_order_id)->groupBy('item_brand_id')->get();
        //         $messagep = "*NOTIFIKASI ORDER* \n \n";
        //         $messagep = $messagep. "No. Order : $data_order->sales_order_id \n";
        //         $messagep = $messagep. "Customer : $data_order->sales_order_rajaongkir_name \n";
        //         $messagep = $messagep. "Alamat : $data_order->sales_order_rajaongkir_address";

        //         $pesan = [];
        //         $number = 0;
        //         foreach ($brands as $brand) {
        //             $pesan[$number] = $messagep. "\n \nPesanan $brand->item_brand_name - $brand->item_brand_description : \n";
        //             foreach ($data_order->detail as $detail) {
        //                 if ($detail->product->item_product_item_brand_id == $brand->item_brand_id) {
        //                     $pesan[$number] = $pesan[$number].$detail->sales_order_detail_qty_order.' '.$detail->product->item_product_name. '\n' ;
        //                     $pesan[$number] = $pesan[$number]. "Catatan : $detail->sales_order_detail_notes \n \n";
        //                 }
        //             }
        //             $this->sendWa($brand->item_brand_phone, $pesan[$number]);
        //             $number++;
        //         }

        //         //end notifikasi branch
        //     }
        // }

        $this->info('The system has been sent successfully!');
    }
}
