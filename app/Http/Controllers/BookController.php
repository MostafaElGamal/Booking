<?php

namespace App\Http\Controllers;

use App\Helper\BookReading;
use App\Model\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        logger(__FUNCTION__);
        return view('admin.books.index');
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        logger(__FUNCTION__);
        logger($request->all());
        //put request into inputs array for mass store
        $inputs = $request->all();

        //get inputs to mass fill data without save
        $bookModel = new Book($inputs);

 $bookModel->save();
        //calc chapters reading mapping array
        $bookModel->{Book::$chapter_reading_map} = BookReading::getChaptersAvailableReadings($bookModel);
        //push to db
        $bookModel->save();

        //render view and return
        $chaptersTable = \View::make("admin.books.partials.chaptersReadingTimesTable")->with(['chaptersArray'=>$bookModel->{Book::$chapter_reading_map}])->render();

        return response()->json(['success' => true, 'chaptersTable' => $chaptersTable]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
