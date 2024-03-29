<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Diary;
use App\User;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Diary $diary)
    {   
        $diary=Diary::where('user_id',Auth::user()->id)->with(['pictures','user'])->orderBy('date', 'DESC')->orderBy('updated_at', 'DESC')->paginate(10);
        return view('diaries.index')->with(['diaries'=> $diary]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('diaries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Diary $diary ,$picture_controller_path='App\Http\Controllers\PictureController')
    {
        
        $request->validate([
            'diary.date'=>'required',
            'diary.title'=>'required',
        ]);
        $diary->title = $request['diary']['title'];
        $diary->text = $request['diary']['text'];
        $diary->user_id =$request['diary']['user_id'];
        $diary->date = $request['diary']['date'];
        $diary->save();
        
        $files = $request['pic'];
        if(isset($files)){
            foreach($files as $file){
                $array=array(
                    "img" =>$file,
                    "diaries_id"=>$diary->id,
                );
                
                $called = app()->make($picture_controller_path);
                $called->store($array);
            }
        }
        
        return redirect(route('diaries.show',$diary->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $diary = Diary::with(['pictures','user'])->find($id);
        return view('diaries.show')->with(['diary'=>$diary]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diary = Diary::with(['pictures','user'])->find($id);
        
        return view('diaries.edit')->with(['diary'=>$diary]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diary $diary,$picture_controller_path='App\Http\Controllers\PictureController')
    {
        
        $request->validate([
            'diary.date'=>'required',
            'diary.title'=>'required',
        ]);
        
        $diary->fill($request['diary'])->save();
        $files = $request['pic'];
        if(isset($files)){
            foreach($files as $file){
                
                $array=array(
                    "img" =>$file,
                    "diaries_id"=>$diary->id,
                );
                $called = app()->make($picture_controller_path);
                $called->store($array);
            }
        }
        return redirect(route('diaries.show', $diary->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id ,$picture_controller_path='App\Http\Controllers\PictureController')
    {
        $diary = Diary::with('pictures')->find($id);
        $files = $diary->pictures;
        if(isset($files)){
            foreach($files as $file){
                $called = app()->make($picture_controller_path);
                $called->destroy($file->id);
            }
        }
        $diary->delete();
        return redirect(route('diaries.index'));
    }
    
    public function search(Request $request)
    {
        
        $request->validate([
            'search'=>'required'
        ]);
        
        $diaries=Diary::where('title','like',"%$request->search%")
                ->orWhere('text','like',"%$request->search%")
                ->orderBy('updated_at', 'DESC')
                ->paginate(5);
        
        
        $search_result = $request->search.'の件数は'.$diaries->total().'件です。';
        return view('diaries.index')->with(['diaries' => $diaries,'search_result'=>$search_result,'search_query'=>$request->search]);  
       
        
    }
    
}
