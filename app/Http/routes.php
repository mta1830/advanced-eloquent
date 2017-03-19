<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Entidades
use AdvancedELOQUENT\Book;
use AdvancedELOQUENT\Category;
use AdvancedELOQUENT\User;

Route::get('/', function () {
    return Book::all();
});

Route::get('/relaciones',function (){
    $categories = Category::get();

    return view('relationship', compact('categories'));
});

//Many to Many
Route::get('/m_to_m',function (){
    $users = User::all();

    return view('manytomany.index', compact('users'));
});

Route::get('/qb',function (){
    //$users = DB::table('users')->get();

    //$users = DB::table('users')->where('name','Thurman Friesen')->first();
    //return $users->name;

    //$email = DB::table('users')
    //            ->where('name','Thurman Friesen')
    //            ->value('email');
    //return $email;

    $users = DB::table('users')
            ->select('name as user_name','email as user_email')
            ->get();

    return view('querybuilder.index', compact('users'));
});

Route::get('/qb_p2',function (){
    $books = DB::table('categories')
        //->join('','','','')
        ->join('books','categories.id','=','books.category_id')
        //->where('books.status','public')
        ->select('categories.name as category','books.*')
        ->get();

    return view('querybuilder.index2', compact('books'));
});

Route::get('edit-m_to_m/{user_id}',[
    'as' => 'getEdit',
    'uses' => 'UserController@getEditManyToMany'
]);

Route::put('put-m_to_m/{user_id}',[
    'as' => 'putEdit',
    'uses' => 'UserController@putEditManyToMany'
]);

Route::get('/relaciones-has',function (){
    $categories = Category::has('books')->get();

    return view('relationship', compact('categories'));
});

Route::get('/relaciones-wherehas',function (){
    $categories = Category::whereHas('books',function ($query){
        $query->where('status','public');
    })->get();

    return view('relationship_video6', compact('categories'));
});

Route::get('/delete-multiple',function () {
    $books = Book::all();
    return view('destroy',compact('books'));
});

Route::delete('/destroy',function (Illuminate\Http\Request $request) {
    $ids = $request->get('ids');

    if (count($ids)){
        Book::destroy($ids);
    }

    return back();
});

Route::get('/registros-softdeletes', function () {
    return Book::onlyTrashed()->get();
});

// Buscar un registro que está en papelera
Route::get('registro-en-papelera/{id}', function ($id) {
    $book = Book::withTrashed()->find($id);
    return $book;
});
// Enviar un registro a papelera
Route::get('enviar-a-papelera/{id}', function ($id) {
    $book = Book::find($id);
    $book->delete();
    return 'Enviado a papelera';
});
// Restaurar un registro que está en papelera
Route::get('restaurar-registro/{id}', function ($id) {
    $book = Book::withTrashed()->find($id);
    $book->restore();
    return 'Restaurado';
});
// Eliminar un registro de forma permanente
Route::get('eliminar-registro/{id}', function ($id) {
    $book = Book::withTrashed()->find($id);
    $book->forceDelete();
    return 'Eliminado de forma permanente';
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
