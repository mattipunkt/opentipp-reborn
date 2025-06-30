<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class ProfilePictureController extends Controller
{
    public function saveProfilePicture(Request $request) {
        if (!auth()->check()) {
            session()->flash('status', '❌ Was versuchst du hier?');
            return redirect('/login');
        }
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,jpg,png,gif|max:8096'
        ]);

        $image = $request->file('profile_picture');
        $image = Image::read($image);
        // Mittelpunkt und quadratischer Crop
        $width = $image->width();
        $height = $image->height();
        $side = min($width, $height);
        $x = intval(($width - $side) / 2);
        $y = intval(($height - $side) / 2);
        $image->crop($side, $side, $x, $y);
        $image->resize(100, 100);
        $base64Image = base64_encode($image->toJpeg());
        $user = auth()->user();
        $user->profile_picture = $base64Image;
        $user->save();
        session()->flash('status', '🎉 Profilbild erfolgreich geändert!');
        return redirect('/');
    }

    public function viewProfilePictureChanger() {
        if (!auth()->check()) {
            session()->flash('status', '❌ Was versuchst du hier?');
            return redirect('/login');
        }
        return view('profile_picture_changer');
    }
}
