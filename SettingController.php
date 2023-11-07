<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        
    
        
        $selecteds=['selectDefault' =>'','selectList' =>'','selectEdit' =>''];
        
        $selecteds[session('afterEdit', 'selectDefault')]='selected';
        
       
        
        $options=[['value'=> 'selectList','select'=>$selecteds['selectList'], 'message'=> 'Show all movie list'],
                ['value'=> 'selectEdit','select'=>$selecteds['selectEdit'], 'message'=> 'Show edit movie form']];
        
        
        $defaultSelectect=['select'=>$selecteds['selectDefault'], 'message'=> 'Choose an option'];
        $checked = session('afterInsert', 'show movies');
        $checkedList='checked';
        $checkedCreate='';
        
        if($checked != 'show movies'){
            $checkedCreate='checked';
            $checkedList='';
        }
        
        return view('setting.index',['checkedList' => $checkedList, 'checkedCreate' => $checkedCreate, 'options'=> $options, 'defaultSelectect' => $defaultSelectect]);
    }
    
    public function update(Request $request){

        session(['afterInsert'=> $request->afterInsert]);
        session(['afterEdit'=> $request->afterEdit]);
        
        
        return  back();
        
    }
}
