<?php

namespace App\Http\Controllers;

use App\CategorySuggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Gate;

class CategorySuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sug_categories = CategorySuggestion::all();

        if(Gate::allows('delete-users')){
            return view('admin.sug_categories.index')->with('sug_categories', $sug_categories);
        }
        if(Gate::denies('delete-users')){
            return back()->with('error','Nemate dozvolu pristupiti navedenoj stranici');
        }

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
        $this->validate($request, [
            'sug_name' => 'required',
            'sug_cover_image' => 'required|mimes:jpeg,png,jpg,bmp|max:5048',
        ]);

        $filenameWithExt = $request->file('sug_cover_image')->getClientOriginalName();
        $image = $request->file('sug_cover_image'); //sada
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('sug_cover_image')->getClientOriginalExtension();
        $filenameToStore = $filename . '_' . time() . '.' . $extension;
        Storage::disk('public')->putFileAs(
            'uploads/sug_categories_photos/',
            $image,
            $filenameToStore
        );

        $sug_category = new CategorySuggestion();
        $sug_category->sug_name = $request->input('sug_name');
        $sug_category->sug_cover_image = $filenameToStore;

        if($sug_category->save()){
            echo "Upload Successfully";

            $request->session()->flash('success', "Prijedlog " . $sug_category->sug_name . ', uspješno je poslan administratorima');
            return redirect('home');
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
    public function destroy(CategorySuggestion $sug_category)
    {
        if($sug_category->delete()){
            $path = storage_path().'/app/public/uploads/sug_categories_photos/'.$sug_category->sug_cover_image;
            unlink($path);
            session()->flash('success', "Prijedlog kategorije " . $sug_category->sug_name . ' uspješno je izbrisan');

        }else{
            session()->flash('error', 'Došlo je do greške prilikom brisanja kategorije - ' . $sug_category->sug_name . '!');
        }

        if(Gate::denies('delete-users')){
            return redirect()->route('home');
        }

        return redirect()->route('home');
    }
}
