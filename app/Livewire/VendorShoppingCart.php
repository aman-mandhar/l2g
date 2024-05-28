<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\VendCart;
use App\Models\Vendor;
use App\Models\VendorOrder;
use App\Models\User;

use GuzzleHttp\Psr7\Request;

class VendorShoppingCart extends Component
{
    
    public $carts;
    public $spl_coupens;
    public $customer;
    public $user;
    
    public function render()
    {
        
        // Fetch session data
        $this->customer = session()->get('customer');

        // Fetch user data
        $this->user = User::where('id', auth()->id())->first();

        // Fetch cart items here and assign to $carts
        $this->carts = VendCart::where('user_id', auth()->id())
        ->where('customer_id', $this->customer->id)
        ->where('order_id', null)
        ->get();
        
        return view('livewire.vendor-shopping-cart')->with('carts', $this->carts, 'user', $this->user);
    }

    public function removeFromCart($cartId)
    {
        $cart = VendCart::find($cartId);

        if ($cart) {
            $cart->delete();
        }

        // Re-render the component to update the cart items
        $this->render();
    }
}
