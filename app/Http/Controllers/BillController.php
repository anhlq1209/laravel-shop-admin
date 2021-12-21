<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index() {
        $bills = Bill::all();
        
        return view('pages.bill.index', [
            'title' => 'Bills',
            'bills' => $bills
        ]);
    }
}
