<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class ProfilePictureController extends Controller
{
    public function saveProfilePicture(Request $request)
    {
        if (! auth()->check()) {
            session()->flash('status', '❌ Was versuchst du hier?');

            return redirect('/login');
        }
        $request->validate([
            'profile_picture' => 'required|mimes:jpeg,jpg,png',
        ]);
        if (!$request->hasFile('profile_picture') || !$request->file('profile_picture')->isValid()) {
            session()->flash('status', '❌ Fehler beim Hochladen des Bildes.');
            return redirect()->back();
        }
        $image = $request->file('profile_picture');
        $image = Image::read($image)->resize(200, 200);
        $base64Image = base64_encode($image->toJpeg());
        $user = auth()->user();
        $user->profile_picture = $base64Image;
        $user->save();
        session()->flash('status', '🎉 Profilbild erfolgreich geändert!');

        return redirect('/');
    }

    public function viewProfilePictureChanger()
    {
        if (! auth()->check()) {
            session()->flash('status', '❌ Was versuchst du hier?');

            return redirect('/login');
        }

        return view('profile_picture_changer');
    }
}
