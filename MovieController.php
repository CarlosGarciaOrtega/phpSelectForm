<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all(); //eloquent
        return view('movie.index', ['movies' => $movies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('movie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1º generar el objeto para guardar
        
        $movie = new Movie($request->all());
        
         
        try{
            //2º intentar guardar el objeto
             $result = $movie->save();
             //3º si se guarda volver algun sitio : index , create
             
             
            $checked = session('afterInsert', 'show movies');
            $target='movie';
        
        if($checked != 'show movies'){
            $target = $target.'/create';
           
        }
             return redirect($target)->with(['message'=> 'The movie has been seaved']);//no hace falta poner url('movie/create') ya que lo hace redirect
        }catch(\Exception $e){
             //4º Si no lo he guardado volver para tras con los datoas rellenos
            return back() -> withInput()->withErrors(['message'=> 'The movie has not been seaved']);//volvemos para atras con los datos que me llegan 
        }
       
       
       
        
        // header(Location: url());
        //laravel redirect(url) hace un redirect
        //laravel back();
        
        
        
        
        
       // $movie = new Movie($request->all());
       // $result = $movie->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
        return view('movie.show', ['movie' => $movie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
        return view('movie.edit', ['movie' => $movie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        try{
            
            $checked = session('afterEdit', 'selectList');
            $target='movie';
        
            if($checked != 'selectList'){
            $target = $target.'/'.$movie->id.'/edit';
           
            }
           
             $result = $movie->update($request->all());
             return redirect($target)->with(['message'=> 'The movie has been update']);
        }catch(\Exception $e){
            return back() -> withInput()->withErrors(['message'=> 'The movie has not been update']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
