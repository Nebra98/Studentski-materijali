<?php

namespace App\Http\Controllers;

use App\Category;
use App\Document;
use Illuminate\Http\Request;
use DB;
use Auth;
use Gate;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
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

       $categories = Category::all();

        if(Gate::allows('for-users')){
            return view('documents.create')->with('categories', $categories);
        }
        if(Gate::denies('for-users')){
            return back()->with('error','Nemate dozvolu pristupiti navedenoj stranici');
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'doc_name' => 'required',
            'user_name' => 'required',
            'doc_file' => 'required|mimes:doc,docx,pdf,txt,xlsx,csv,pptx,ppt|max:5048',
        ]);

        $filenameWithExt = $request->file('doc_file')->getClientOriginalName();
        $doc = $request->file('doc_file'); //sada
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('doc_file')->getClientOriginalExtension();
        $filenameToStore = $filename . '_' . time() . '.' . $extension;

        Storage::disk('public')->putFileAs(
            'uploads/documents/',
            $doc,
            $filenameToStore
        );

        $document = new Document();
        $document->user_id =  Auth::user()->id;

        $document->category_id = $request->input('category_id');

        $document->doc_file = $filenameToStore;
        $document->doc_name = $request->input('doc_name');
        $document->user_name = $request->input('user_name');
        $document->description = $request->description;
        $category_update = Category::find($request->input('category_id'));
        $category_update->touch();

        if($document->save()){
            echo "Upload Successfully";

            $request->session()->flash('success', "Dokument " . $document->doc_name . ' je uspještno objavljen u kategoriju ' . $category_update->name);
            //return redirect('home');
            return redirect()->route('category.show', $document->category_id);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        if($document->delete()){
            $path = storage_path().'/app/public/uploads/documents/'.$document->doc_file;
            unlink($path);
            session()->flash('success', "Dokument " . $document->doc_name . ' je uspješno izbrisan');

        }else{
            session()->flash('error', 'Došlo je do greške prilikom brisanja dokumenta - ' . $document->doc_name . '!');
        }

        if(Gate::denies('delete-users')){
            return redirect()->route('home');

        }

       return redirect()->route('home');
    }
}
