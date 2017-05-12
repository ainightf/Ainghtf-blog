<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends CommonController
{
    //get.admin/links 全部友情链接列表
    public function index()
    {
        $data = Links::orderBy('link_order','asc')->get();

        return view('admin.links.index',compact('data'));

    }
    public function changeOrder()
    {
        $input = Input::all();
        $links = Links::find($input['link_id']);
        $links->link_order = $input['link_order'];
        $re = $links->update();
        if ($re){
            $data = [
                'status' => 0,
                'msg' => '友情链接排序更新成功!',
            ];
        }else{
            $date = [
                'status' => 1,
                'msg' => '友情链接排序更新失败!请稍后充重试',
            ];
        }
        return $data;

    }
    //get.admin/links/create 添加友情链接
    public function create()
    {
        $data = Links::where('link_id',0)->get();
        return view('admin/links/add',compact('data'));
    }
    //post.admin/links   添加链接提交
    public function store()
    {
        $input = Input::except('_token');

        $rules = [
            'link_name' => 'required',
            'link_url' => 'required',
        ];
        $messages = [
            'link_name.required'=>'链接名称不能为空',
            'link_url.required'=>'URL不能为空',
        ];
        $validator = Validator::make($input,$rules,$messages);
//        $validator = Validator::make($input,$rules,$messages);
        if ($validator->passes()){
            $re = Links::create($input);
            if($re){
                return redirect('admin/links');
            }else{
                return back()->with('errors','链接添加失败,稍后重试!');
            }
        }
        else{
            return back()->withErrors($validator);
        }
    }
    //get.admin/category/{category}/edit 编辑链接
    public function edit($link_id)
    {
        $field = Links::find($link_id);

        return view('admin.links.edit',compact('field'));
    }
    //put.admin/category/{category} 更新链接
    public function update($link_id)
    {
        $input = Input::except('_token','_method');
        $re = Links::where('link_id',$link_id)->update($input);
        if($re){
            return redirect('admin/links');
        }else{
            return back()->with('errors','链接更新失败，请稍后重试!');
        }
    }
    //get.admin/link/{link} 显示单个链接信息
    public function show()
    {

    }
    //delete.admin/links/{link} 删除单个链接
    public function destroy($link_id)
    {
        $re = Links::where('link_id',$link_id)->delete();

        if ($re){
            $data = [
                'status' => 0,
                'msg' => '链接删除成功',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '链接删除失败，请稍后重试',
            ];
        }
        return $data;
    }
}
