<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('parent_id', auth()->id())->get();
        return view('users.index', compact('users'));
    }
    public function totalsale()
    {
        $sales = Sale::whereHas('user', function ($query) {
            $query->where('parent_id', auth()->id());
        })
        ->groupBy('user_id')
        ->get();
        
        return response()->json($sales);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('users.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validating image
            'parent_id'=>['nullable', 'integer']
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $profileImage = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $profileImage);
        }
        $user =new User;
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password= Hash::make($request->input('password'));
        $user->image=$profileImage;
        $user->parent_id=auth()->id();
         $user->save();
         $notification = array(
            'message' => 'added user succesfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
    
        return view('users.edit', compact('user'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
                        'name' => 'required|string|max:255',
                        'parent_id' => 'nullable|integer',
                    ]);
            
                    $user->update($request->all());
                    $notification = array(
                        'message' => 'added user succesfully',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('users.index')->with($notification);
                }
        
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        $notification = array(
            'message' => 'Deleted  user succesfully',
            'alert-type' => 'success'
        );
        return redirect()->route('users.index')->with($notification);
    }
}


// <?php

// namespace App\Http\Controllers;

// use App\Models\Sale;
// use App\Models\User;
// use Illuminate\Http\Request;

// class UserController extends Controller
// {
//     public function index()
//     {

//         $users = User::all();
//         return response()->json($users);

//     }
//     public function totalsale()
//     {
//         $sales = Sale::whereHas('user', function ($query) {
//             $query->where('parent_id', auth()->id());
//         })
//         ->groupBy('user_id')
//         ->get();
        
//         return response()->json($sales);
//     }
//     public function addUser(){
        
//     }
// }
