<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($i)
    {
        dd($i);
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
    public function store($request , $dir_path='public/image')
    {
        
        
        // $request->imgはformのinputのname='img'の値です
        $path = $request['img']->store($dir_path);
        // パスから、最後の「ファイル名.拡張子」の部分だけ取得します 例)sample.jpg
        $filename = basename($path);
        // FileImageをインスタンス化(実体化)します
        $data = new Picture;
        // 登録する項目に必要な値を代入します
        $data->diaries_id = $request['diaries_id'];
        $data->pic_name = $request['img']->getClientOriginalName();
        $data->file_name = $filename;
        // データベースに保存します
        $data->save();

        // 登録後/fileにリダイレクトします その際にフラッシュメッセージを渡します
        // return redirect(route('diaries.show',$request->diary_id));
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
    public function destroy($id,$dir_path='public/image/')
    {
        $picture = Picture::find($id);
        $path= $dir_path.($picture->file_name);
        Storage::delete($path);
        $picture->delete();
    }
}
