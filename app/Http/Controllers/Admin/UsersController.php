<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Document;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Gate;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = User::latest()->where([
            [function ($query) use ($request){
                if (($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])->orderBy("name", "asc")->paginate(5);

       // $users = User::all();
        $categories = Category::all();
        $documents = Document::all();

        $users_count = $users->count();
        $categories_count = $categories->count();
        $documents_count = $documents->count();

        return view('admin.users.index', compact(['users', 'users_count', 'categories_count', 'documents_count']))->with('i', (request()->input('page', 1)-1)*5);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        if(Gate::denies('edit-users')){
            return redirect(route('admin.users.index'));
        }

        $roles = Role::all();

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        $user->name = $request->name;
        $user->email = $request->email;


        if($user->save()){
            $request->session()->flash('success', $user->name . ' has been updated');
        }else{
            $request->session()->flash('error', 'There was an error updating the user');
        }



        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        if(Gate::denies('delete-users')){
            return redirect(route('admin.users.index'));
        }
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
