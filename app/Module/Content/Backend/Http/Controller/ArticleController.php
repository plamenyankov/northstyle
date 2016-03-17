<?php

namespace Northstyle\Module\Content\Backend\Http\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Northstyle\Http\Requests;
use Northstyle\Http\Controllers\Controller;

use Northstyle\Module\Content\Model\Post;

class ArticleController extends Controller
{
    protected $post;
    /**
     *
     * BlogController constructor.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        \DB::enableQueryLog();
        $posts = $this->post->with('author')->orderBy('published_at','desc')->paginate(10);
//        dd($posts);
        return view('backend.blog.index',compact('posts')); //->render();
//        dd(\DB::getQueryLog());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('backend.blog.form',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StorePostRequest $request)
    {
        $this->post->create(['author_id'=>auth()->user()->id] + $request->only('title','slug','published_at','body','excerpt'));
//        Storage::put('/resources/views/'.$request->get('title').'.blade.php',$request->get('body'));
        return redirect(route('backend.blog.index'))->with('status','Post has been created.');
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
        $post = $this->post->findOrFail($id);
        return view('backend.blog.form',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdatePostRequest $request, $id)
    {
        $post = $this->post->findOrFail($id);
        $post->fill($request->only('title','slug','published_at','body','excerpt'))->save();
        return redirect(route('backend.blog.edit',$post->id))->with('status', 'Post has been updated.');
    }
    public function confirm($id){
        $post = $this->post->findOrFail($id);
        return view('backend.blog.confirm',compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->post->findOrFail($id);
        $post->delete();
        return redirect(route('backend.blog.index'))->with('status','Blog post has been deleted.');
    }
}
