<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('subscribed');
    }


    public function index()
    {
        try {
            $invoices = Auth::user()->invoicesIncludingPending();
        } catch ( \Exception $e ) {
            session()->flash('status', $e->getMessage());
        }
        return view('pages.personal-area.invoice', compact('invoices'));
    }


    public function download(Request $request, $id)
    {
        return $request->user()->downloadInvoice($id, [
            'vendor'  => 'K13',
            'product' => 'Subscribe to Github-battle service',
        ]);
    }
}
