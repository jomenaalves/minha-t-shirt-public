<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\UploadPhotoUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $data = [
            'styles' => [
                '/assets/css/plugins/style.css',
                '/assets/css/user/user.css',
            ],
            'scripts' => [
                '/assets/js/user/user.js',
                '/assets/js/plugins/jquery.dataTables.min.js',
                '/assets/js/plugins/dataTables.bootstrap5.min.js',
                '/assets/js/plugins/dataTables.buttons.min.js',
                '/assets/js/plugins/dataTables.colReorder.min.js',
                '/assets/js/plugins/dataTables.rowReorder.min.js',
                '/assets/js/plugins/simple-datatables.js',
            ]
        ];
        return view('user.user', $data);
    }

    public function editUser(){
        $data = [
            'styles' => [
                '/assets/css/user/user.css',
            ],
            'scripts' => [
                '/assets/js/user/edit.js',
            ]
        ];
        return view('user.edit', $data);
    }
  
    public function loadUsersFromDatatable(UserService $userService){
        return $userService->loadUsersFromDatatable();
    }
   
    public function createUser(UserRequest $request, UserService $userService){
        return $userService->createUser($request);
    } 

    public function getDataUser(Request $request, UserService $userService){
        $data = $userService->getDataUser($request);
        return $data;
    }

    public function updateDetailsUser(UserRequest $request, UserService $userService){
        return $userService->updateDetailsUser($request);
    }
  
    public function updatePermissionsUser(Request $request, UserService $userService){
        return $userService->updatePermissionsUser($request);
    }
   
    public function updatePasswordUser(ChangePasswordRequest $request, UserService $userService){
        return $userService->updatePasswordUser($request);
    }
    
    public function updatePhotoUser(UploadPhotoUserRequest $request, UserService $userService){
        return $userService->updatePhotoUser($request);
    }
}
