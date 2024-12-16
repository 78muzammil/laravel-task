<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;

class UserController extends Controller
{
    public function list(){
        $list = User::all();
        return view('list',compact('list'));
    }
    public function form($id=null){
        $detail = User::where('id', $id)->first();
        return view('user',compact('detail'));
    }
    public function save(Request $request){
        $validated = $request->validate([
            'profile_image' => 'nullable|image|mimes:jpg|max:2048',
            'name' => 'required|max:25',
            'phone' => ['required', 'regex:/^\+1-\(\d{3}\) \d{3}-\d{4}$/'],
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required',
            'country' => 'required',
        ]);
        
        if ($request->id) {
            $detail = User::findOrFail($request->id);
        } else {
            $detail = new User;
        }

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = $file->getClientOriginalName();
            $targetPath = public_path('profile_images/' . $filename);
            $path = $file->move(public_path('profile_images'), $filename);

        } elseif ($request->id) {
            $filename = $detail->profile_image;
        }

        $detail->profile_image = $filename;
        $detail->name = $request->name;
        $detail->phone = $request->phone;
        $detail->email = $request->email;
        $detail->street_address = $request->address;
        $detail->city = $request->city;
        $detail->state = $request->state;
        $detail->country = $request->country;
        $detail->save();

        if(!$request->id){
            return redirect()->back()->with('success', 'Form submitted successfully!');
        }else{
            return redirect()->back()->with('success', 'Form Updated successfully!');
        }

    }

    public function delete($id){
    
        $delete = User::where('id',$id)->delete();
        return response()->json(['status'=>true, 'message'=>'Delete Successfully']);
    
    }

    public function importForm(){
        return view('import');
    }

    public function importFile(Request $request){
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        Excel::import(new UserImport, $request->file('file'));
        return back()->with('success', 'Data Imported Successfully');
    }
}
