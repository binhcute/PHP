<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cmt = DB::table('tpl_comment')
            ->select('tpl_comment.*', 'users.firstName', 'users.lastName', 'users.username')
            ->join('users', 'users.id', '=', 'tpl_comment.user_id')->get();
        return view('pages.server.comment.list')
            ->with('cmt', $cmt);
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
        $comment = new Comment();
        $comment->user_id =  Auth::user()->id;
        $comment->product_id = $request->product_id;
        $comment->article_id = $request->article_id;
        $comment->rate = $request->rate;
        $comment->role = $request->role;
        $comment->comment_description = $request->comment_description;
        $comment->status = 1;
        $comment->save();
        return redirect()->back();
    }

    public function disabled($id)
    {
        $comment = Comment::find($id);
        $comment->status = 0;
        $comment->save();
        if($comment->save()){
            return response()->json([
                'status' => 'success',
                'message' => 'Ẩn Bình Luận Thành Công'
            ],200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Đã Ẩn Bình Luận Thất Bại'
        ],200);
    }
    public function enabled($id)
    {
        $comment = Comment::find($id);
        $comment->status = 1;
        $comment->save();
        if($comment->save()){
            return response()->json([
                'status' => 'success',
                'message' => 'Hiển Thị Bình Luận Thành Công'
            ],200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Hiển Thị Bình Luận Thất Bại'
        ],200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = DB::table('tpl_comment')
            ->join('users', 'users.id', 'tpl_comment.user_id')
            ->leftJoin('tpl_product', 'tpl_product.product_id', 'tpl_comment.product_id')
            ->orwhere('tpl_comment.role',1)
            ->where('tpl_comment.comment_id', $id)
            ->leftJoin('tpl_article', 'tpl_article.article_id', 'tpl_comment.article_id')
            ->orwhere('tpl_comment.role',0)
            ->where('tpl_comment.comment_id', $id)
            ->select(
                'tpl_comment.*',
                'users.firstName',
                'users.lastName',
                'users.username',
                'tpl_product.product_id',
                'tpl_product.product_name',
                'tpl_article.article_id',
                'tpl_article.article_name'
            )
            ->first();
        return view('pages.server.comment.show')
            ->with('comment', $comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
