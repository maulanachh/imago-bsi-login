<?php

namespace App\Livewire\Master\Customers;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CustomerIndex extends Component
{
    #[Layout('components.layouts.app')]
    public $username;
    public $isTableLoaded = false;
    public function loadTable()
    {
        $this->isTableLoaded = true;
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->username = Auth::user()->user_name;
        } else {
            return redirect()->route('login');
        }
    }
    public function createCustomer()
    {
        session()->forget(['cus_id', 'function']);

        $this->redirect('/master/customer/mastercustomer/create');
    }

    public function render()
    {
        return view('livewire.master.customers.customer-index');
    }
}
