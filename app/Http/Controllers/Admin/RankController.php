<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rank;
class RankController extends Controller
{
    public function getList(){
        $title = "List of rank";
        $list = Rank::all();
        if(!empty($list)){
            return view('admin.rank.list',compact('title','list'));
        }
        return view('admin.rank.list',compact('title'));
    }
    public function getAdd(){
        $title = "Add rank";
        return view('admin.rank.add');
    }
    public function postAdd(Request $request){
        $request->validate([
            'name' => 'required',
            'discount' => 'required',
            'value' => 'required',
            'description' => 'required'
        ]);
        $data = new Rank();
        $data->name = $request->name;
        $data->discount = $request->discount;
        $data->value = $request->value;
        $data->description = $request->description;
        $check = $data->save();
        if(!empty($check)){
            return redirect()->route('admin.ranks.getList',compact('check'));
        }
        return redirect()->route('admin.ranks.getList');
    }
    public function getUpdate(Request $request,$id=0){
        if(!empty($id) && ctype_digit($id)){
            $rank = Rank::find($id);
            if(!empty($rank)){
                $request->session()->put('id',$id);
                return view('admin.rank.update',compact('rank'));
            }
            return view('admin.rank.list')->with('msg','Error');
        }
        return view('admin.rank.list')->with('msg','Link does not exist');
    }
    public function postUpdate(Request $request){
        $id = session('id');
        if(!empty($id) && ctype_digit($id)){
            $data = Rank::find($id);
            if(!empty($data)){
                $data->name = $request->name;
                $data->discount = $request->discount;
                $data->value = $request->value;
                $data->description = $request->description;
                $check = $data->save();
                if(!empty($check)){
                    return redirect()->route('admin.ranks.getList',compact('check'));
                }
            }
            return redirect()->route('admin.ranks.getList')->with('msg','Error');    
        }
    }
    public function deleteItem($id=0){
        if(!empty($id) && ctype_digit($id)){
            $ranks = Rank::find($id);
            if(!empty($ranks)){
                if ($ranks->canBeDeletedUser()) {
                    if($ranks->canBeDeletedDiscount()){
                        $ranks->delete();
                        return redirect()->route('admin.ranks.getList')->with('msg','Deleted Success');
                    }
                    else {
                        return redirect()->route('admin.ranks.getList')->with('error','Không thể xóa rank này vì có liên kết với bảng khác');
                    }
                } else {
                    return redirect()->route('admin.ranks.getList')->with('error','Không thể xóa rank này vì có liên kết với bảng khác');
                }
            }
        }
        return redirect()->route('admin.ranks.getList')->with('msg','Error');
    }
}
