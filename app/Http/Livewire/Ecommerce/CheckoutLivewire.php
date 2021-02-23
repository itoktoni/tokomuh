<?php

namespace App\Http\Livewire\Ecommerce;

use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Ixudra\Curl\Facades\Curl;
use Livewire\Component;
use Modules\Finance\Dao\Models\Bank;
use Plugin\Helper;

class CheckoutLivewire extends Component
{
    public $notes;
    public $area;
    public $name;
    public $address;
    public $phone;

    public $price = [];
    public $checkout = [];
    
    public $total;
    public $ongkir;
    
    public $validation;

    public $data_courier;
    public $data_bank;

    protected $listeners = [
        'updateCart',
        'setOngkir'
    ];
    
    public function updateCart(){

    }

    public function setOngkir($data){
        $id = $data['branch'].'_area_'.session('area').'_weight_'.$data['weight'];
        $this->price[$id] = $data; 
        session()->put('price_'.$id, $data);
    }

    public function render()
    {
        if (isset($this->notes)) {
            session()->put('notes', $this->notes);
        }

        $this->notes = session()->has('notes') ? session('notes') : null;
        $this->area = session()->has('area') ? session('area') : null;
        $this->name = session()->has('name') ? session('name') : null;
        $this->address = session()->has('address') ? session('address') : null;
        $this->phone = session()->has('phone') ? session('phone') : null;

        Cache::add('data_courier', DB::table('rajaongkir_courier')->where('rajaongkir_courier_active', 1)->get());
        $this->data_courier = Cache::get('data_courier');
        
        $this->data_bank = Bank::all();

        $grouped = CartFacade::getContent()->mapToGroups(function ($item) {
            $attributes = $item->attributes;
            $weight = $item->quantity * $attributes->product_weight;
            $data = [
                'id' => $item->id,
                'qty' => $item->quantity,
                'price' => $item->price,
                'weight' => $weight > 700 ? $weight : 700,
                'total' => $item->getPriceSum(),
            ];

            $merge = array_merge($data, $attributes->toArray());

            return [
                $attributes['branch_id'] => $merge,
            ];
        })->map(function($map){

            $total_weight = $map->sum('weight');
            $total_value = $map->sum('total');

            foreach($map as $branch){
                $data['branch_id'] = $branch['branch_id'];
                $data['branch_name'] = $branch['branch_name'];
                $data['branch_province'] = $branch['branch_province'];
                $data['branch_city'] = $branch['branch_city'];
                $data['branch_area'] = $branch['branch_area'];
                $data['branch_weight'] = $total_weight;
                $data['branch_item'][$branch['id']] = (Object) $branch;
                
                $key_ongkir = 'price_'.$data['branch_id'].'_area_'.session('area').'_weight_'.$total_weight;
                $grand_total = $total_value;
                
                if(Session::has($key_ongkir)){

                    $value_ongkir = Session::get($key_ongkir);
                    $price_ongkir = $value_ongkir['price'];

                    $data['branch_courier'] = $value_ongkir;
                    $data['branch_ongkir'] = $price_ongkir;
                    $grand_total = $total_value + $price_ongkir;
                }

                $data['branch_subtotal'] = $total_value;
                $data['branch_total'] = $grand_total;
            }
            
            return (Object) $data;
        });

        $this->ongkir = $grouped->sum('branch_ongkir');
        $this->total = CartFacade::getTotal() + $this->ongkir;
        Session::put('checkout', $grouped->sortKeys());
        $this->checkout = Session::get('checkout');
        // dd($this->checkout);

        return View(Helper::setViewLivewire(__CLASS__));
    }

    public function getPrice($from, $to, $courier, $weight)
    {
        $response = Curl::to("http://pro.rajaongkir.com/api/cost")->withData([
            'origin' => $from,
            'originType' => 'subdistrict',
            'destination' => $to,
            'destinationType' => 'subdistrict',
            'weight' => $weight,
            'courier' => $courier,
        ])->withHeaders([
            'key' => env('RAJAONGKIR_APIKEY'),
        ])->post();

        $parse = json_decode($response, true);
        $items = false;
        if (isset($parse)) {
            $data = $parse['rajaongkir'];
            if ($data['status']['code'] == '200') {
                $items = array();
                foreach ($data['results'][0]['costs'] as $value) {
                    $items[] = [
                        'courier_code' => $courier,
                        'courier_name' => $data['results'][0]['name'],
                        'courier_service' => $value['service'],
                        'courier_desc' => $value['description'],
                        'courier_etd' => $value['cost'][0]['etd'],
                        'courier_price' => $value['cost'][0]['value'],
                        'courier_mask' => Helper::createRupiah($value['cost'][0]['value']),
                    ];
                }
            }
        }

        return $items;
    }

    public function createOrder(){
        
        $rules = [

            'ongkir' => 'required|numeric|min:1',
            'total' => 'required|numeric|min:1',
            'name' => 'required',
            'address' => 'required',
            'area' => 'required',
            'phone' => 'required',
            'checkout.*.branch_ongkir' => 'required',
        ];

        $this->validate($rules, [
            'checkout.*.branch_ongkir.required' => 'Please Select Courier in Red line',
            'phone.required' => 'Please input phone number in Cart',
            'name.required' => 'Please input name in Cart',
            'address.required' => 'Please input address in Cart',
            'area.required' => 'Please input Shipping area in Cart',
            'ongkir.min:1' => 'Please Input Shipping area'
        ], [
            'checkout.*.branch_ongkir' => 'Please Select Courier'
        ]);
    }

}
