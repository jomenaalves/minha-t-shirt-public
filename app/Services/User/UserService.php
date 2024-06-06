<?php 

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class UserService {
    
    public function loadUsersFromDatatable() {
        try {
            $users = User::where('store_id', Auth::user()->store_id)->get();

            $data = [];
            foreach ($users as $user) {
                $data[] = [
                    'photo' => $user->photo ? Storage::url('user/' . $user->photo) : null,
                    'name' => $user->name,
                    'username' => $user->username,
                    'function' => $user->function,
                    'status' => $user->status,
                    'id' => $user->id,
                ];
            }
            return response()->json($data);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível carregar a lista de usuários.',
            ], 500);
        }
    }

    public function createUser($request) {     

        try {
            DB::beginTransaction();
            $permissions = $this->processPermissions($request);                

            $user = new User();
            $user->store_id = 1;
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->function = $request->input('function');
            $user->password = Hash::make($request->input('username'));
            $user->save();
        
            $user->givePermissionTo($permissions);
           
            DB::commit();
            return response()->json([
                'message' => 'Usuário cadastrado com sucesso!',
            ], 200);
        
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Não foi possível cadastrar novo usuário.',
            ], 500);
        }
        
    }

    public function processPermissions($request){
        
        $permissions = [];
        $data = $request->input();
        $userPermissionEdit = isset($data['user_permission_edit']) ? $data['user_permission_edit'] : 'off';

        if ($userPermissionEdit === 'off') {

            foreach ($data as $key => $value) {
                if ($value === 'on') {
                    $permissions[] = $key . '.access';
                }
            }

        } else {

            foreach ($data as $key => $value) {
                $keys = ['name', 'username', 'function', 'user_permission_edit'];
                $userHavePermissionInThisPage = !in_array($key, $keys) && $value === 'on';
                $userCanOnlyAccessThisPage = $value === 'off' && $key !== 'access';

                if ($userHavePermissionInThisPage) {
                    $permissions[] = $key . '.access';
                    $permissions[] = $key . '.create';
                    $permissions[] = $key . '.edit';
                    $permissions[] = $key . '.delete';
                }

                if ($userCanOnlyAccessThisPage) {
                    $permissions[] = $key . '.access';
                }
            }
        }

        return $permissions;
    }

    public function getDataUser($request){

        try {
            $user = User::findOrFail($request->id);            
            $permissions = $user->getAllPermissions();

            $statusPermissions = $this->verifyPermissions($permissions);

            $data = [
                'photo' => $user->photo ? Storage::url('user/' . $user->photo) : null,
                'name' => $user->name,
                'username' => $user->username,
                'function' => $user->function,
                'status' => $user->status,
                'id' => $user->id,
                'permissions'=> $statusPermissions,
            ];

            return $data;

        } catch (\Throwable $th) {
            throw new \Exception("Não foi possível carregar os detalhes do usuário.");
        }
    }

    public function updateDetailsUser($request){

        try {

            $userIsActive = $request->input('user_is_active');
            DB::beginTransaction();

            $user = User::find($request->input('id'));
            $user->store_id = 1;
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->function = $request->input('function');
            $user->status = isset($userIsActive) ? 1 : 0;
            $user->save();

            DB::commit();
            return response()->json([
                'message' => 'Detalhes do usuário atualizados com sucesso!',
            ], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Não foi possível atualizar os detalhes do usuário.',
            ], 500);
        }
    }

    public function updatePermissionsUser($request){

        try {
            DB::beginTransaction();
            $permissions = $this->processPermissions($request);   
            
            if (empty($permissions)) {
                throw new \Exception('Não foram encontradas novas permissões válidas para o usuário.');
            }

            $user = User::find($request->input('id'));
            $user->revokePermissionTo($user->getAllPermissions()->pluck('name')->toArray());              
            $user->givePermissionTo($permissions);
           
            DB::commit();
            return response()->json([
                'message' => 'Permissões do usuário atualizadas com sucesso!',
            ], 200);
        
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Não foi possível atualizar as permissões do usuário.',
            ], 500);
        }
    }

    public function updatePasswordUser($request){

        try {
            DB::beginTransaction();
            $user = User::find($request->input('id'));

            if(!password_verify($request->old_password, $user->password)) {
                return response()->json([
                    'message' => 'Senha atual incorreta.',
                ], 422);
            }

            $user->password = Hash::make($request->input('password'));
            $user->save();

            DB::commit();
            return response()->json([
                'message' => 'Senha do usuário atualizada com sucesso!',
            ], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Não foi possível atualizar a senha do usuário.',
            ], 500);
        }
    }

    public function updatePhotoUser($request){

        try {
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');

                $user = User::find($request->input('id'));
                if ($user->photo) {
                    Storage::delete('user/' . $user->photo);
                }
        
                $fileName = Str::random(15) . '.' . $photo->getClientOriginalExtension();
        
                Storage::putFileAs('user', $photo, $fileName, 'public');
        
                $user->photo = $fileName;
                $user->save();
        
                return response()->json([
                    'message' => 'Foto do usuário atualizada com sucesso.',
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível atualizar a foto do usuário.',
            ], 500);
        }     
    }

    public function verifyPermissions($data) {

        $allPermissions = [];            
        $statusPermissions = [];

        foreach ($data as $permission) {
            $allPermissions[] = [
                'name' => $permission->name,
            ];
        };
   
        foreach ($allPermissions as $item) {   
            $name = $item['name'];
            $prefix = explode('.', $name)[0];
            $statusPermissions[$prefix] = 'on';
            if (strpos($name, '.access') !== false) {
                $statusPermissions[$prefix] = 'off';
            } else {
                // Se encontrarmos algum item que não seja '.access' e não está 'off', definimos a permissão de edição como 'on'
                $statusPermissions['permission_edit'] = 'on';
            }
        }


        if (!in_array('on', $statusPermissions)) {
            $statusPermissions['permission_edit'] = 'off';
        }

        return $statusPermissions;
    }
    
    public function user() {
        return response()->json([
            'user' => auth()->user()
        ], 200);
    }
}