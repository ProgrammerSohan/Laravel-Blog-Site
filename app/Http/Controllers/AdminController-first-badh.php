<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Kropify\Kropify;
//use Mberecall\Services\Library\Kropify;
//use SawaStacks\Utils\Kropify as UtilsKropify;

class AdminController extends Controller
{
    public function adminDashboard(Request $request){
        $data = [
            'pageTitle'=>'Dashboard'

        ];
            return view('back.pages.dashboard');
       }

       public function logoutHandler(Request $request){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.login')->with('fail','You are now logged out!');

       } //end method

       public function profileView(Request $request){
            $data = [
                'pageTitle'=>'Profile'

            ];
            return view('back.pages.profile',$data);
        
       }//end method
       
     public function updateProfilePicture(Request $request)
{
    // Validate file
    $request->validate([
        'profilePictureFile' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = User::findOrFail(auth()->id());

    $path = public_path('images/users/');
    $file = $request->file('profilePictureFile');

    $oldPicture = $user->picture;
    $filename = 'IMG_' . uniqid() . '.png';

    // Crop & save image
    $upload = Kropify::getFile($file, $filename)
        ->maxWoH(255)
        ->save('images/users/');

    if ($upload) {

        // Delete old image if exists
        if ($oldPicture && File::exists($path . $oldPicture)) {
            File::delete($path . $oldPicture);
        }

        // Update DB
        $user->update([
            'picture' => $filename
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'Your profile picture has been updated successfully.',
            'image_url' => asset('images/users/' . $filename)
        ]);
    }

    return response()->json([
        'status' => 0,
        'message' => 'Something went wrong. Please try again.'
    ]);
} //end method



}
