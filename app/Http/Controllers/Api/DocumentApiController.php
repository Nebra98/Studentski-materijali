<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Document;


class DocumentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Document::all();

    }

    public function getSingleDocument(Document $document)
    {
        return $document;
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
        $document = new Document();
        $document->user_id = $request->user_id;
        $document->category_id = $request->category_id;
        $document->doc_file = $request->input('doc_file');
        $document->doc_name = $request->input('doc_name');
        $document->user_name = $request->input('user_name');
        $document->description = $request->input('description');
        $document->save();

        return $document;
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
        $document = Document::find($id);

        if($request->input('doc_file')){
            $document->doc_file = $request->input('doc_file');
        }
        if($request->input('doc_name')){
            $document->doc_file = $request->input('doc_name');
        }
        if($request->input('description')){
            $document->doc_file = $request->input('description');
        }
        $document->save();
        
        return $document;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Document::find($id);
        if($document)
            $document->delete(); 
        else
        return response()->json([
            'message' => 'Greška prilikom brisanja dokumenta. Provjerite postoji li dokument u sustavu.'], 404);

        return response()->json(null); 
    }
}
