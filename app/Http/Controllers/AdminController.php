<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Kropify\Kropify;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return view('back.pages.dashboard', [
            'pageTitle' => 'Dashboard'
        ]);
    }

    public function logoutHandler(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.login')
            ->with('fail', 'You are now logged out!');
    }

    public function profileView()
    {
        return view('back.pages.profile', [
            'pageTitle' => 'Profile'
        ]);
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profilePictureFile' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();

        $relativePath = 'images/users/';
        $absolutePath = public_path($relativePath);

        // Ensure directory exists
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }

        $file = $request->file('profilePictureFile');
        $oldPicture = $user->picture;
        $filename = 'IMG_' . uniqid() . '.png';

        try {
            $upload = Kropify::getFile($file, $filename)
                ->maxWoH(500)
                ->save($relativePath);

            if (!$upload) {
                throw new \Exception('Kropify upload failed');
            }

            // Delete old image
            if ($oldPicture && File::exists($absolutePath . $oldPicture)) {
                File::delete($absolutePath . $oldPicture);
            }

            // Update database
            $user->update([
                'picture' => $filename
            ]);

            return response()->json([
                'status' => 1,
                'message' => 'Your profile picture has been updated successfully.',
                'image_url' => asset($relativePath . $filename)
            ]);
        } catch (\Throwable $e) {
            Log::error('Profile image upload failed', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 0,
                'message' => 'Server error occurred while uploading image.'
            ], 500);
        }
    } //end method


    public function categoriesPage(Request $request){
        $data = [
            'pageTitle'=>'Manage categories'

        ];
        return view('back.pages.categories_page',$data);

    }//end method


}
