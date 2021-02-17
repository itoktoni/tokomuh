<?php

namespace App\Http\Livewire\Ecommerce;

use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Livewire\Component;
use Modules\Marketing\Dao\Facades\PromoFacades;
use Plugin\Helper;

class CartLivewire extends Component
{

    public $unic_id;
    public $qty;
    public $coupon;

    protected $listeners = ['updateCart'];
    public function updateCart()
    {
    }

    public function render()
    {
        if(Cart::getSubTotal() == '0.0'){
            $this->removeCoupon(); 
        }
        
        return view(Helper::setViewLivewire(__CLASS__));
    }

    public function updateQty($id, $sign, $qty = 1)
    {
        if (Cart::getContent()->contains('id', $id)) {
            $formula = $sign ? array('quantity' => +$qty) : array('quantity' => -$qty);
            Cart::update($id, $formula);
            $this->updateTotal();
            $this->emit('updateCart');
        }
    }

    public function actionDelete($product_id)
    {

        if (Cart::getContent()->contains('id', $product_id)) {
            Cart::remove($product_id);
        }
        $this->emit('updateCart');
    }

    public function actionPlus($id)
    {
        $this->updateQty($id, 1);
    }

    public function actionMinus($id)
    {
        $qty = Cart::getContent()->get($id)->quantity;
        if ($qty >= 2) {
            $this->updateQty($id, 0);
        }
    }

    public function removeCoupon()
    {
        $promo = Cart::getConditions()->first();
        if ($promo) {
            Cart::removeCartCondition($promo->getName());
        }

        $this->emit('updateCart');
    }

    public function updateCoupon()
    {
        if (!empty($this->coupon)) {

            $rules = [
                'coupon' => 'required|exists:marketing_promo,marketing_promo_code',
            ];

            $this->validate($rules, ['exists' => 'Voucher Not Valid !']);
            $this->updateTotal();
        }
    }

    public function updateTotal()
    {
        $code = Cart::getConditions()->first() ? Cart::getConditions()->first()->gettype() : false;
        if (!empty($this->coupon)) {
            $code = $this->coupon;
        }
        $data = PromoFacades::codeRepository(strtoupper($code));
        if ($data) {
            $value = Cart::getSubTotal();
            $matrix = $data->marketing_promo_matrix;
            if ($matrix) {

                $string = str_replace('@value', $value, $matrix);
                $total = $value;

                try {
                    $total = Helper::calculate($string);
                } catch (\Throwable $th) {
                    $total = $value;
                }

                $promo = Cart::getConditions()->first();
                if ($promo) {
                    Cart::removeCartCondition($promo->getName());
                }
                $condition = new CartCondition(array(
                    'name' => $data->marketing_promo_name,
                    'type' => $data->marketing_promo_code,
                    'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                    'value' => -$total,
                    'order' => 1,
                    'attributes' => array( // attributes field is optional
                        'name' => $data->marketing_promo_name,
                        'discount' => $total,
                        'matrix' => $data->marketing_promo_matrix,
                    ),
                ));

                Cart::condition($condition);
            }
        }

        $this->emit('updateCart');
    }
}
