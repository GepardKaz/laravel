@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card">
                <div class="card-header">Редактировать книгу id : {{ $book->id }}</div>

                <div class="card-body">
                  <form action="{{ route('books.update',$book->id) }}" method="POST">
                         {{csrf_field()}}
                        {{ method_field('PATCH') }}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Название книг</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="bname" value="{{ $book->bname }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">O книге</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="description" rows="3"> {{ $book->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Cтоимость</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="price" value="{{ $book->price }}" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" required >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sale_date" class="col-md-4 col-form-label text-md-right">Дата продажи</label>

                            <div class="col-md-6">
                                <input id="sale_date" type="date" class="form-control" name="sale_date" value="{{ $book->sale_date }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="author" class="col-md-4 col-form-label text-md-right">Автор</label>

                            <div class="col-md-6">
                                <input id="author" type="text" class="form-control" name="author" value="{{ $book->author }}" required>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="publisher" class="col-md-4 col-form-label text-md-right">Издатель</label>

                            <div class="col-md-6">
                                <input id="publisher" type="text" class="form-control" name="publisher" value="{{ $book->publisher }}" required>
                            </div>
                        </div>         
             
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >Сохранить</button>
                    <a type="button" class="btn btn-warning" href="{{ url('/books') }}" >Отмена</a>
                  </div>
              </form>

                </div>
  
        </div>
    </div>
  </div>
</div>
@endsection