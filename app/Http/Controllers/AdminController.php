<?php

namespace App\Http\Controllers;

use App\Mail\DefaultMail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Support\Facades\Mail;

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
                Mail::to(User::find($id))->send(new DefaultMail(
                    User::find($id),
                    "Account aktiviert!",
                    "Dein Account wurde erfolgreich aktiviert. Du kannst dich jetzt in das Tippspiel einloggen!"
                ));
            } elseif ($activate == 'false') {
                $id = $request->query('id');
                Vote::where('user_id', $id)->delete();
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
