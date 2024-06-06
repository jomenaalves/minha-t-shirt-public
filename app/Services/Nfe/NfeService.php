<?php 

namespace App\Services\Nfe;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NfeService{
    
    public function loadNfesFromDatatable() {
        try {
            // $users = User::where('store_id', Auth::user()->store_id)->get();

            $nfes = [
            [
                'id' => 1,
                'number' => 685,
                'type' => 'saída',
                'client' => 'Hélia dos Santos',
                'key' => '35240444317077000246550020000006941000088686',
                'status' => 'número reservado',
                'data' => '2024-03-24 08:15:00',
            ],
            [
                'id' => 2,
                'number' => 686,
                'type' => 'saída',
                'client' => 'Le Closet',
                'key' => '35240444317077000246550020000006941000088687',
                'status' => 'número reservado',
                'data' => '2024-03-25 08:10:00',
            ],
            [
                'id' => 3,
                'number' => 687,
                'type' => 'saída',
                'client' => 'Elaine Ferraz',
                'key' => '35240444317077000246550020000006941000088688',
                'status' => 'autorizado',
                'data' => '2024-03-26 08:20:00',
            ],
            [
                'id' => 4,
                'number' => 688,
                'type' => 'saída',
                'client' => 'Le Closet',
                'key' => '35240444317077000246550020000006941000088689',
                'status' => 'número reservado',
                'data' => '2024-03-27 09:20:00',
            ],
            [
                'id' => 5,
                'number' => 689,
                'type' => 'saída',
                'client' => 'Hélia dos Santos',
                'key' => '35240444317077000246550020000006941000088690',
                'status' => 'número reservado',
                'data' => '2024-03-28 10:20:00',
            ],
            [
                'id' => 6,
                'number' => 690,
                'type' => 'saída',
                'client' => 'Elaine Ferraz',
                'key' => '35240444317077000246550020000006941000088691',
                'status' => 'autorizado',
                'data' => '2024-03-29 11:20:00',
            ],

            ];

            $nfesObject = json_decode(json_encode($nfes));

            $data = [];
            foreach ($nfesObject as $nfe) {
                $data[] = [
                    'id' => $nfe->id,
                    'number' => $nfe->number,
                    'type' => $nfe->type,
                    'client' => $nfe->client,
                    'key' => $nfe->key,
                    'status' => $nfe->status,
                    'date' => date('d/m/Y H:i', strtotime($nfe->data)),
                ];
            }
            return response()->json($data);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível carregar a lista de NF-es.',
            ], 500);
        }
    } 
    
    public function viewNfe($request) {
        try {
            // $users = User::where('store_id', Auth::user()->store_id)->get();
        
            $nfeObject = [
                'id' => 1,
                'invoiceNumber' => 685,
                'numberSerie' => '685 / 1',
                'type' => 'saída',
                'client' => 'Hélia dos Santos',
                'value' => '380.00',
                'key' => '35240444317077000246550020000006941000088686',
                'status' => 'número reservado',
                'date' => '2024-03-24 08:15:00',
            ];


            $nfe = json_decode(json_encode($nfeObject)); 
        
            $data[] = [
                'id' => $nfe->id,
                'invoiceNumber' => $nfe->invoiceNumber,
                'numberSerie' => $nfe->numberSerie,
                'type' => $nfe->type,
                'client' => $nfe->client,
                'value' => "R$ ". str_replace('.', ',', $nfe->value),
                'key' => $nfe->key,
                'status' => $nfe->status,
                'date' => date('d/m/Y H:i', strtotime($nfe->date)),
            ];

            return response()->json($data);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível carregar a NF-e.',
            ], 500);
        }
    } 

    public function nfeSettingsGetData(){

        try {
            // $users = User::where('store_id', Auth::user()->store_id)->get();
        
            $nfeObject = [
                'id' => 1,
                'logo' => 'logo_tshirt.jpg',
                'fantasyName' => 'Minha T-Shirt',
                'corporateReason' => 'True Rose LTDA',
                'cnpj' => '44.317.077/0002-46',
                'stateRegistration' => '120751020110',
                'cep' => '03.031-010',
                'address' => 'Rua Vitor Hugo',
                'addressNumber' =>'358',
                'neighborhood' => 'Caninde',
                'complement' => 'Sala 129',
                'state' => 'SP',
                'city' => 'São Paulo',
                'percentagePrice' => '100',
                'certificateIssued' => '2024-03-24 08:15:00',
                'certificateExpires' => '2025-03-24 08:15:00',
            ];

            $nfe = json_decode(json_encode($nfeObject)); 
        
            $data[] = [
                'id' => $nfe->id,
                'logo' => $nfe->logo ? Storage::url('logotype/' . $nfe->logo) : null,
                'fantasyName' => $nfe->fantasyName,
                'corporateReason' => $nfe->corporateReason,
                'cnpj' => $nfe->cnpj,
                'stateRegistration' => $nfe->stateRegistration,
                'cep' => $nfe->cep,
                'address' => $nfe->address,
                'addressNumber' => $nfe->addressNumber,
                'neighborhood' => $nfe->neighborhood,
                'complement' => $nfe->complement,
                'state' => $nfe->state,
                'city' => $nfe->city,
                'percentagePrice' => $nfe->percentagePrice,
                'certificateIssued' => date('d/m/Y H:i', strtotime($nfe->certificateIssued)),
                'certificateExpires' => date('d/m/Y H:i', strtotime($nfe->certificateExpires)),
            ];

            return response()->json($data);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível carregar os dados da empresa emissora.',
            ], 500);
        }

    }
}