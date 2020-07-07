@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
             @if(session()->get('success'))
                  <div class="alert alert-success">
                     {{ session()->get('success') }}  
                  </div><br />
             @endif

            <div class="card">
                <div class="card-header">Задача 2 </div>


                <div class="card-body">
	              <form id="search_books" action="/books">
					<div class="form-group row">
						<div class="col-md-4">
                                <input  type="text" class="form-control" name="bname" value="{{ request()->bname}}"  placeholder="Название книг">
                          </div>
                      <div class="col-md-4">
                            <input  type="text" class="form-control" name="author" value="{{ request()->author }}"   placeholder="Автор">
                      </div>
                     
                      <div class="col-md-4">
                      	 @guest
                            <a class="btn btn-primary" href="#" onclick="document.getElementById('search_books').submit()"> Поиск</a>
                            <a class="btn btn-default" href="{{ url('/books') }}"> Сбросить</a>
						 @else
						 	<a class="btn btn-primary" href="#" onclick="document.getElementById('search_books').submit()"> Поиск</a>
                            <a class="btn btn-default" href="{{ url('/books') }}"> Сбросить</a>
                            <a class="btn btn-success" href="#" data-toggle="modal" data-target="#myModal"> +  Добавить</a>
                          @endguest
                      </div>
					</div>
                    </form> 
                  
					<hr>
                    <div class="form-group row">
                        <div class="col-md-6">
					       <h5>Общее количество книг: <em style="color: darkred;font-size: 18px;"> {{ $count }}</em></h5>
                        </div>
                        <div class="col-md-6">
                           <h5>Общая выручка от продажи книг: <em style="color: darkred;font-size: 18px;">  {{ $sum }} тг </em></h5>
                        </div>
                    </div>

                    {{ $books->appends(Request::input())->links() }}
					<table class="table responsive">
						<thead>
							<th>Название книг</th>
							<th>О книге</th>
							<th>Стоимость</th>
							<th>Дата продажи</th>
							<th>Автор</th>
							<th>Издатель</th>
                            <th>Операция</th>

						</thead>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $book->bname }}</td>
                                <td>{{ $book->description }}</td>
                                <td>{{ $book->price }}</td>
                                <td>{{ $book->sale_date }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>
                                    @guest
                                        <a class="btn btn-primary" href="{{ route('books.show',$book->id)}}"><i class="fa fa-eye"></i> </a>
                                     @else                                       
                                        <a class="btn btn-primary" href="{{ route('books.edit',$book->id)}}"><i class="fa fa-pencil"></i> </a>
                                        <hr>
                                        <form action="{{route('books.destroy', $book->id)}}" method="post">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger"><span class="fa fa-trash"></span></button>
                                     </form>
                                       
                                      @endguest
                                </td>

                            </tr>
                        @endforeach
                        
					</table>
                    {{ $books->appends(Request::input())->links() }}

                </div>
                <!-- Modal -->
			  <div class="modal fade" id="myModal" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			        	<h4 class="modal-title">Добавить книгу</h4>
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			        </div>
			        <div class="modal-body">
			           <form action="{{ route('books.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Название книг</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="bname" value="{{ old('bname') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">O книге</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Cтоимость</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="price" value="{{ old('price') }}" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" required >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sale_date" class="col-md-4 col-form-label text-md-right">Дата продажи</label>

                            <div class="col-md-6">
                                <input id="sale_date" type="date" class="form-control" name="sale_date" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="author" class="col-md-4 col-form-label text-md-right">Автор</label>

                            <div class="col-md-6">
                                <input id="author" type="text" class="form-control" name="author" required>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="publisher" class="col-md-4 col-form-label text-md-right">Издатель</label>

                            <div class="col-md-6">
                                <input id="publisher" type="text" class="form-control" name="publisher" required>
                            </div>
                        </div>

                    
			       
			        <div class="modal-footer">
			        	<button type="submit" class="btn btn-primary" >Сохранить</button>
			          <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
			        </div>
			        </form>
                     </div>
			      </div>
			      
			    </div>
			  </div>
            </div>
        </div>
    </div>
</div>
@endsection