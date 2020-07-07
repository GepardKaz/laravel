<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $books = Book::orderBy('id','DESC');

           if($request->has('bname') && $request->bname != null){
                $books->where('bname', 'like', "%$request->bname%");
            }
            if($request->has('author') && $request->author != null){
                $books->where('author', 'like', "%$request->author%");
            }

            $count = $books->count();
            $sum = $books->sum('price');

           $books = $books->paginate(5);

           return view('books', ['books' => $books, 'count'=>$count, 'sum' => $sum]);
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
        $book = new Book([
               'bname' => $request->get('bname'),
               'description' => $request->get('description'),
               'price' => $request->get('price'),
               'publisher'=>$request->get('publisher'),
               'sale_date' => $request->get('sale_date'),
               'author' => $request->get('author')
            ]);
            $book->save();

      return redirect('/books')->with('success', 'Книга добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $book = Book::find($id);

      return view('show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
      $book = Book::find($id);

      return view('edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $book = Book::find($id);
	      $book->bname = $request->get('bname');
	      $book->description= $request->get('description');
	      $book->price = $request->get('price');
	      $book->publisher = $request->get('publisher');
	      $book->sale_date = $request->get('sale_date');
	      $book->author = $request->get('author');
	      $book->save();
      
      return redirect('/books')->with('success', 'Книга обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $book = Book::find($id);
      $book->delete();

      
      return redirect('/books')->with('success', 'Книга удалена!');
    }
}
