<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Gate;
use Auth;

class PostsController extends Controller
{
    
    public function getIndex(){
        $posts=Post::all();

        return view('index', [
            'posts'=>$posts
        ]);
    }

    public function getAdminIndex() {
    	$posts=Auth::user()->posts;

    	return view('admin.index', [
    		'posts'=> $posts,
    		'edit_mode'=>0,
    		'edit_post'=>NULL
    	]);
    }

    public function postAdminNew(Request $req){

        $post=new Post([
    		'title'=>$req->input('title'),
    		'body'=>$req->input('body')
    	]);

    	Auth::user()->posts()->save($post);

    	return redirect()->back()->with('info', 'Post created!');
    }

    public function getAdminDelete($id) {
    	$post=Post::find($id); //$post=Post::where('id','=', $id)->orderBy('id', 'desc')->first()


        if (Gate::allows('delete-post', $post)) {
            $post->delete();    
            return redirect()->back()->with('info', 'Post deleted!');
        } else {
             return redirect()->back()->with('info', 'Post is not deleted! Unauthorized delete detected.');
        }
    }

    public function getAdminEdit($id) {
    	$posts=Post::all();
    	$edit_post=Post::find($id);

    	return view('admin.index', [
    		'posts'=> $posts,
    		'edit_mode'=>1,
    		'edit_post'=>$edit_post
    	]);
    }


    public function postEdit(Request $req){
    	$post=Post::find($req->input('id'));
    	$post->body=$req->input('body');

    	$post->save();


    	return redirect()->route('admin.index')->with('info', 'Post updated!');
    }
}
