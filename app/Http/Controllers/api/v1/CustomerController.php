<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Filters\V1\CustomersFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\CustomerResource;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\v1\CustomerCollection;
use App\Http\Requests\V1\StoreCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new CustomersFilter();
        $filterItems = $filter->transform($request); // [['column', 'operator', 'value']]

            $includeInvoices = $request->query('includeInvoices');
            // Menggunakan CustomerCollection untuk mengembalikan daftar customer
            $customers = Customer::where($filterItems);
            if ($includeInvoices) {
                $customers = $customers->with('invoices'); // Jika ada query string includeInvoices, ambil relasi invoices
            }
            // appends : untuk menambahkan query string dari request ke URL paginasi, sehingga filter tetap berlaku saat berpindah halaman
            return new CustomerCollection($customers->paginate()->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $includeInvoices = request()->query('includeInvoices');
        if ($includeInvoices) {
             return new CustomerResource($customer->loadMissing('invoices'));
        }
        // ini untuk mengembalikan resource customer dalam format JSON
        // menggunakan CustomerResource yang telah dibuat
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
