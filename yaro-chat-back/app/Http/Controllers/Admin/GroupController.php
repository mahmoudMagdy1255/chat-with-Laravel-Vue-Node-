<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\GroupsDatatables;
use App\Group;
use Storage;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GroupsDatatables $GroupsDatatables)
    {
        return $GroupsDatatables->render('admin.groups.index' , ['title' => trans('admin.groups')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.groups.create' , ['title' => trans('admin.create_record')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate( $request , [
            'name' => 'required|string|min:3|max:100',
            'image' => 'sometimes:nullable|' . v_image()
        ]);

        if($request->hasFile('image') ){
            $data['image'] = upload([
                'file' => 'image',
                'path' => 'groups',
                'delete_file' => '' 
            ]);
        }else {
            $data['image'] = 'groups/default.png';
        }

        Group::Create( $data );

        session()->flash('success' , trans('admin.added') );

        return redirect( aurl('groups') );

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
        $group = Group::find($id);
        return view('admin.groups.edit' , ['title' => trans('admin.edit_record') , 'group' => $group]);
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
        $data = $this->validate( $request , [
            'name' => 'required|string|min:3|max:100',
            'image' => 'sometimes:nullable|' . v_image()
        ]);

        $group = Group::find($id);

        if($request->hasFile('image') ){
            $data['image'] = upload([
                'file' => 'image',
                'path' => 'groups',
                'delete_file' => $group->image
            ]);
        }
        
        Group::where('id' , $id)->Update( $data );

        session()->flash('success' , trans('admin.updated') );

        return redirect( aurl('groups') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id , $from = null)
    {
        $group = Group::find($id);

        if ( $group->image != 'groups/default.png') {
            Storage::has($group->image) ? Storage::delete($group->image) : '';
        }
        
        $group->delete();

        if( $from == null){
           
           session()->flash('success' , trans('admin.deleted') );

            return redirect( aurl('groups') ); 
        }
        
    }

    public function destroy_all(Request $request)
    {
        if ( is_array( $request->item ) ) {
            foreach ($request->item as $item) {
                $this->destroy($item , 'destroy_all');
            }
        }else {
            $this->destroy($request->item , 'destroy_all');
        }

        session()->flash('success' , trans('admin.deleted') );

        return redirect( aurl('groups') );
    }
}
