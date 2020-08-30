<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Carbon\Carbon;

class CommentController extends Controller
{
    // Kiem tra xac thuc khi admin chua dang nhap
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->where('isdelete',false)->paginate(10);
        return view('admin.comment.index',compact('comments'));
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
        //
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
        $comment = Comment::findOrFail($id);
        return view('admin.comment.edit',compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $comment= Comment::findOrfail($id);
        $comment->reply = $request->reply;
        $comment->updated_at = Carbon::now()->toDateTimeString();
        $comment->update();
        return redirect('/admin/comment')->with('message','Reply successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function editComment(Request $request)
    {
        $comment = Comment::findOrFail($request->id);
        if ($comment->isdisplay) {
            $comment->isdisplay = false;    
        }else{
            $comment->isdisplay = true;
        } 
        $comment->update();
        return Response(1);
    }
}
