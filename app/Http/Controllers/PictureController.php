<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picture;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request , $dir_path='public/image')
    {
        // $request->imgはformのinputのname='img'の値です
        $path = $request->img->store($dir_path);
        // パスから、最後の「ファイル名.拡張子」の部分だけ取得します 例)sample.jpg
        $filename = basename($path);
        // FileImageをインスタンス化(実体化)します
        $data = new Picture;
        // 登録する項目に必要な値を代入します
        $data->user_id = 1;
        $data->pic_name = $request->pic_name;
        $data->file_name = $filename;
        // データベースに保存します
        dd($data);
        $data->save();

        // 登録後/fileにリダイレクトします その際にフラッシュメッセージを渡します
        return redirect(route('diaries.show',$request->diary_id))->with(['picture'=>$data]);
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
