<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vote;

class AdminController extends Controller
{
    public function viewUsers(Request $request) {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
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
                Vote::where('user', $id)->delete();
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
        $file = '/tmp/opentipp_last_update';
        if (file_exists($file)) {
            $timestamp = file_get_contents($file);
            $datetime = new \DateTime();
            $datetime->setTimestamp((int)$timestamp);
            $time_output = $datetime->format('H:i:s, d.m.Y');
        }
        else {
            $time_output = "Keine Aktualisierungsdaten verfügbar.";
        }

            return view('admin.users', [
            "accepted_users" => User::where('is_accepted', true)->get(),
            "unaccepted_users" => User::where('is_accepted', false)->get(),
            "time_output" => $time_output,
        ]);
    }
}
