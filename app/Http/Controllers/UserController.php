<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Changes the user's role to the next level up (e.g. users become writers)
     * Admins remain unchanged.
     *
     * @param $userID The database id of the user to change
     * @return void
     */
    private function promoteUserInDB($userID) {
        $oldRole = DB::table('users')->where('id', $userID)->first()->role;
        $newRole = null;
        switch ($oldRole) {
            case 'user':
                $newRole = 'writer';
                break;
            case 'writer':
                $newRole = 'admin';
                break;
            default:
                $newRole = $oldRole;
                break;
        }
        DB::table('users')->where('id', $userID)->update(['role' => $newRole]);
    }

    /**
     * Changes the user's role to the next level down (e.g. writers become users)
     * Normal users remain unchanged.
     *
     * @param $userID The database id of the user to change
     * @return void
     */
    private function demoteUserInDB($userID) {
        $oldRole = DB::table('users')->where('id', $userID)->first()->role;
        $newRole = null;
        switch ($oldRole) {
            case 'admin':
                $newRole = 'writer';
                break;
            case 'writer':
                $newRole = 'user';
                break;
            default:
                $newRole = $oldRole;
                break;
        }
        DB::table('users')->where('id', $userID)->update(['role' => $newRole]);
    }

    private function deleteUserInDB($userID) {
        User::find($userID)->delete();
    }

    public function updateUserRole(Request $request) {
         $input = $request->input();

         switch ($input['action']) {
             case 'promote':
                 $this->promoteUserInDB($input['user-id-to-change']);
                 break;
             case'demote':
                 $this->demoteUserInDB($input['user-id-to-change']);
                 break;
             case 'delete':
                 $this->deleteUserInDB($input['user-id-to-change']);
         }

        $numberOfAdmins = DB::table('users')->where('role', 'admin')->count();

        $data = [
            'mode' => 'users',
            'allUsers' => User::all(),
            'numberOfAdmins' => $numberOfAdmins
        ];


        return view('admin', $data);
    }
}
