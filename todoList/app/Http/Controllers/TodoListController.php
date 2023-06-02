<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListItem;
use Carbon\Carbon;

class TodoListController extends Controller
{
    public function index(){
        // return view('welcome', ['listItems' => ListItem::where('is_complete', 0)->get()]);
        return view('welcome',
         [
            'listItems' => ListItem::where('is_complete', 0)->get(),
            'listItemsDoing' => ListItem::where('is_complete', 1)->get(),
            'listItemsCompleted' => ListItem::where('is_complete', 2)->get()
         ]);
    }

    public function markDoing($id){
        $listItem = ListItem::find($id);
        $listItem->is_complete = 1;
        $listItem->save();

        return redirect('/') ;
    }

    public function markComplete($id){
        $listItem = ListItem::find($id);
        $listItem->is_complete = 2;
        $listItem->save();

        return redirect('/') ;
    }
    //
    public function saveItem(Request $request)  {
        \Log::info(json_encode($request->all()));

        $newListItem = new ListItem;
        $newListItem->name = $request->nameItem;
        $newListItem->description = $request->descriptionItem;
        $newListItem->is_complete = 0;
        $newListItem->delivery_time = $request->deliveryItem;
        $newListItem->save();

        return redirect('/') ;
    }
}

