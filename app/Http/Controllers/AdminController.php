<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function viewUsers(Request $request) {
        if (!auth()->user()->isAdmin()) {
            session()->flash('status', 'Du hast hier nichts zu suchen!');
            return redirect('/');
        }
        $action = $request->query('action');
        if($action == 'activate') {
            $activate = $request->query('activate');
            if($activate == 'true') {
                $id = $request->query('id');
                User::where('id', $id)->update(['is_accepted' => true]);
            } elseif ($activate == 'false') {
                $id = $request->query('id');
                User::where('id', $id)->delete();
            }
        }
        if($action == 'superuser') {
            $activate = $request->query('activate');
            if($activate == 'true') {
                $id = $request->query('id');
                User::where('id', $id)->update(['is_admin' => true])->save();
            }
        }
        //dd(User::where('is_accepted', false)->get());
        return view('admin.users', [
            "accepted_users" => User::where('is_accepted', true)->get(),
            "unaccepted_users" => User::where('is_accepted', false)->get()
        ]);
    }
}
