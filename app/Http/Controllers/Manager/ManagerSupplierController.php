<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class ManagerSupplierController extends Controller
{
    public function index()
    {
 $suppliers = Supplier::paginate(10);
        
        return view('manager.suppliers.index', compact('suppliers'));
    }
}
