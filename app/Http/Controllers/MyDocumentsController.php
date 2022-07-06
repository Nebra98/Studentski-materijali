<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Document;
use App\Category;
use App\User;
use Auth;
use Gate;
use DB;
use Illuminate\Support\Facades\Storage;


class MyDocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id, Request $request)
    {

        $user = DB::table('users')->where('id', $user_id)->first();
        $categories = Category::all();
        $user_auth = Auth::user();

        if($user_auth){
            if($user_auth->id == $user->id){
            $files = Document::latest()->where('user_id', $user->id)->where([

                ['doc_name', '!=', Null],
                [function ($query) use ($request){
                    if (($term = $request->term)) {
                        $query->orWhere('doc_name', 'LIKE', '%' . $term . '%')->get();
                    }
                }]
            ])->orderBy("doc_name", "asc")->paginate(5);


           // $files = Document::where('user_id', '=', $request->id)->get();

            return view('my_doc.show')->with('user', $user)->with('files', $files)->with('categories', $categories)->with('i', (request()->input('page', 1)-1)*5);
        }else{
                return back()->with('error','Nemate dozvolu pristupiti navedenoj stranici');
            }
        }else{
            return back()->with('error','Nemate dozvolu pristupiti navedenoj stranici');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = Document::find($id);
        $categories = Category::all();
        $user = User::find($file->user_id);
        $current_category = Category::find($file->category_id);

        return view('my_doc.edit')->with('file', $file)->with('user', $user)->with('categories', $categories)->with('current_category', $current_category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'doc_name' => 'required',
            'user_name' => 'required',
        ]);

        $file = Document::find($id);
        $file->category_id = $request->input('category_id');
        $file->doc_name = $request->input('doc_name');
        $file->user_name = $request->input('user_name');
        $file->description = $request->description;
        $category_update = Category::find($request->input('category_id'));
        $category_update->touch();

        if($file->save()){
            $request->session()->flash('success', 'Uspješno ste uredili dokument');
        }else{
            $request->session()->flash('error', 'Nastala je greška prilikom uređivanja dokumenta!');
        }

        if($request->control == 2) {
            return redirect()->route('user_detail.show', $file->user_id);
        }

        return redirect()->route('my_documents.show', Auth::user());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
