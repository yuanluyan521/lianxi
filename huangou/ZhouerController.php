<?php

namespace App\Http\Controllers\Zhou;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Zhou\Zhouer;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Verfiry;

class ZhouerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $res)
    {
        $cou=DB::table('scores')->count();
        $size=3;
        $maxpage=ceil($cou/$size);
        $page=$res->get('page');
        $page=isset($page)?$page:1;
        $nextpage=$page+1;
        $prevpage=$page-1;
        $set=($page-1)*$size;
        $dat=DB::table('scores')->offset($set)->limit($size)->get();
        return view('Zhou.Zhouer.index',['data'=>$dat,'maxpage'=>$maxpage,'next'=>$nextpage,'prev'=>$prevpage]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(){
        return view('Zhou.Zhouer.add');
    }
    public function create(Verfiry $res)
    {
        $data=$res->all();
        $model=new Zhouer();
        $re=$model->creat($data);
        if ($re){
            return redirect()->route('zer.index');
        }else{
            return redirect()->route('zer.add');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $arr=['uid'=>'1','rid'=>[1,2,3]];
        $s=count($arr['rid']);
        for($i=0;$i<=$s;$i++){
            $array[][]=$arr['uid'];
            $o=count($array);
            for($i=0;$i<$o;$i++){
                $array[$i][1]=$arr['rid'][$i];
            }
        }
        dump($array);

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
    public function edit(Request $res)
    {
        $id=$res->get('id');
        $data=DB::table('scores')->where(['id'=>$id])->get();
        return view('Zhou.Zhouer.up',['data'=>$data]);
    }

    public function update(Verfiry $res)
    {
        $da=$res->all();
        $model=new Zhouer();
        $re=$model->change($da);
        if ($re){
            return redirect()->route('zer.index');
        }else{
            return redirect()->route('zer.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $res)
    {
        $id=$res->get('id');
        $data=DB::table('scores')->where(['id'=>$id])->delete();
        if ($data){
            return response()->json([
                'code'=>'200',
                'msg'=>'删除成功'
            ]);
        }else{
            return response()->json([
                'code'=>'0',
                'msg'=>'删除失败'
            ]);
        }
    }
}
