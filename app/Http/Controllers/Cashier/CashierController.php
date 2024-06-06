<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cashier\AddProductsRequest;
use App\Http\Requests\Cashier\CashierRequest;
use App\Http\Requests\Cashier\CloseRequest;
use App\Http\Requests\Cashier\OpenCashierRequest;
use App\Http\Requests\Cashier\UpdateItemRequest;
use App\Http\Requests\Cashier\UpdateNoteRequest;
use App\Http\Requests\Cashier\UpdatePaymentsRequest;
use App\Http\Requests\Cashier\WithdrawalRequest;
use App\Services\Cashier\CashierService;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index(){
        $data = [
            'styles' => [
                '/assets/css/plugins/style.css',
                '/assets/css/cashier/cashier.css',
            ],
            'scripts' => [
                '/assets/js/cashier/cashier.js',
                '/assets/js/plugins/jquery.dataTables.min.js',
                '/assets/js/plugins/dataTables.bootstrap5.min.js',
                '/assets/js/plugins/dataTables.buttons.min.js',
                '/assets/js/plugins/dataTables.colReorder.min.js',
                '/assets/js/plugins/dataTables.rowReorder.min.js',
                '/assets/js/plugins/simple-datatables.js',
            ]
        ];
        return view('cashier.cashier', $data); 
    } 
    
    public function edit(){
        $data = [
            'styles' => [
                '/assets/css/plugins/style.css',
                '/assets/css/cashier/cashier.css',
            ],
            'scripts' => [
                '/assets/js/cashier/cashierEdit.js',
                '/assets/js/plugins/jquery.dataTables.min.js',
                '/assets/js/plugins/dataTables.bootstrap5.min.js',
                '/assets/js/plugins/dataTables.buttons.min.js',
                '/assets/js/plugins/dataTables.colReorder.min.js',
                '/assets/js/plugins/dataTables.rowReorder.min.js',
                '/assets/js/plugins/simple-datatables.js',
            ]
        ];
        return view('cashier.edit', $data); 
    } 

    public function loadCashiersFromDatatable(CashierService $cashierService){
        return $cashierService->loadCashiersFromDatatable();
    }

    public function details(Request $request, CashierService $cashierService) {
        return $cashierService->details($request);
    }

    public function create(CashierRequest $request, CashierService $cashierService){
        return $cashierService->create($request);
    }
    
    public function addProducts(AddProductsRequest $request, CashierService $cashierService){
        return $cashierService->addProducts($request);
    }

    public function updateNote(UpdateNoteRequest $request, CashierService $cashierService){
        return $cashierService->updateNote($request);
    }

    public function close(CloseRequest $request, CashierService $cashierService){
        return $cashierService->close($request);
    }
    
    public function withdrawal(WithdrawalRequest $request, CashierService $cashierService){
        return $cashierService->withdrawal($request);
    }
  
    public function loadCashierProduct(Request $request, CashierService $cashierService){
        return $cashierService->loadCashierProduct($request);
    }
   
    public function removeItem(Request $request, CashierService $cashierService){
        return $cashierService->removeItem($request);
    }
    
    public function updateItem(UpdateItemRequest $request, CashierService $cashierService){
        return $cashierService->updateItem($request);
    }
   
    public function loadCashierPayment(Request $request, CashierService $cashierService){
        return $cashierService->loadCashierPayment($request);
    }
   
    public function updatePayments(UpdatePaymentsRequest $request, CashierService $cashierService){
        return $cashierService->updatePayments($request);
    }
    
    public function openCashier(OpenCashierRequest $request, CashierService $cashierService){
        return $cashierService->openCashier($request);
    }



}
