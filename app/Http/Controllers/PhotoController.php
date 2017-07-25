<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $photos = Photo::where('user_id','=', $user->id)->latest()->get();
        return view('photos.index', compact('photos', 'user'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpeg,bmp,png|size:2048',
            'caption' => 'required|max:80',
            'user_id' => 'required'
        ]);

        $user = Auth::user();

        $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('img'), $input['image']);

        $input['caption'] = $request->caption;
        $user->photos()->create($input);

        return back()
            ->with('success','Image Uploaded successfully.');

    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);

        $photo->delete();

        return redirect()->back();
    }
}
