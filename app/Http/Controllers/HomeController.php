<?php

namespace App\Http\Controllers;

use App\Category;
use App\Document;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $categories = Category::where([

            ['name', '!=', Null],
            [function ($query) use ($request){
                if (($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])->orderBy("name", "asc")->paginate(5);

        $documents = Document::all();

        return view('home', compact('categories'))
            ->with('i', (request()->input('page', 1)-1)*5)->with('documents', $documents);

       // $categories = Category::orderby('name', 'asc')->paginate(3);
       // $documents = Document::all();
       // return view('home')->with('categories', $categories)->with('documents', $documents);


    }



}
