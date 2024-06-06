<?php

namespace App\Http\Controllers\Nfe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Nfe\NfeService;

class NfeController extends Controller
{
    public function index(){
        $data = [
            'styles' => [
                '/assets/css/plugins/style.css',
            ],
            'scripts' => [
                '/assets/js/nfe/nfe.js',
                '/assets/js/plugins/jquery.dataTables.min.js',
                '/assets/js/plugins/dataTables.bootstrap5.min.js',
                '/assets/js/plugins/dataTables.buttons.min.js',
                '/assets/js/plugins/dataTables.colReorder.min.js',
                '/assets/js/plugins/dataTables.rowReorder.min.js',
                '/assets/js/plugins/simple-datatables.js',
            ]
        ];
        return view('nfe.nfe', $data);
    }

    public function loadNfesFromDatatable(NfeService $nfeService){
        return $nfeService->loadNfesFromDatatable();
    }
    
    public function viewNfe(Request $request, NfeService $nfeService){
        return $nfeService->viewNfe($request);
    }
    
    public function nfeSettingsIndex(){
        $data = [
            'scripts' => [
                '/assets/js/nfe/nfeSettings.js',
                ]
            ];
        return view('nfe.nfe_settings', $data);
    }

    public function nfeSettingsGetData(Request $request, NfeService $nfeService){
        return $nfeService->nfeSettingsGetData($request);
    }
}
