<?php

namespace App\Observers;

use App\Models\Customer;
use App\Mail\CustomerStoredEmail;

class CustomerObserver
{
    /**
     * Handle the Customer "created" event.
     */
    public function created(Customer $customer): void
    {
        $this->sendMailable($customer, CustomerStoredEmail::class);
    }

    private function sendMailable(Customer $customer, $mailable)
    {
        \Mail::to($customer->email)->send(
            new $mailable($customer)
        );
    }
}
