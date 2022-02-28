<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use DB;

class PostsController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
    public function index()
    {   
        //Pegar tudi
        //$posts = Post::all();
        //Formas de pegar o get
        //Ordenando
        //$posts = Post::orderBy('created_at', 'asc')-> get();
        //Fazendo query
        //$posts = DB::select('SELECT * FROM posts');
        //Pegar uma quantidade especifica
        //$posts = Post::orderBy('title', 'asc')->take(1)->get();

        //Fazer paginação:
        $posts = Post::orderBy('created_at', 'asc')->paginate(10);

        return view('posts.index')->with('posts', $posts);
    }

   
    public function create()
    {
        return view('posts.create');
    }

  
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('cover_image')){
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //create post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

   
    public function edit($id)
    {
        
        $post = Post::find($id);
        
        //checar por usuario correto
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Forbidden Page');
        }

        return view('posts.edit')->with('post', $post);
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        if($request->hasFile('cover_image')){
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } 

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('posts')->with('success', 'Post Updated');
    }

    
    public function destroy($id)
    {
        
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Forbidden Page');
        }

        if($post->cover_image != 'noimage.jpg'){
            
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted');
    }
}
