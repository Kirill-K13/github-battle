<?php

namespace App\Http\Controllers\PersonalArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class InvoiceController extends Controller
{

    public function __construct()
    {
        // Only subscribed user
        $this->middleware('subscribed');
    }


    public function index()
    {
        try {
            $invoices = Auth::user()->invoices();
        } catch (Exception $e) {
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
