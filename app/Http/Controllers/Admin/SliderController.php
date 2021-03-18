<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSlider;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders =  Slider::paginate(5);
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $max_order =  Slider::max('weight') ;
        /* $category = Slider::pluck('name', 'id')->all();*/
        return view('admin.sliders.create',[
            'slide' => [],
            'max_order' => $max_order/*,
            'category' =>  $category*/
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSlider $request)
    {
        $data = $request->all();
        if(!request()->has('show')){
            $data['active'] = 0;
        }

        $data['image'] = Slider::uploadImage($request);
        Slider::create($data);
        return redirect()->route('sliders.index')->with('success', 'Слайд добавлен');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = Slider::find($id);
        $max_order =  Slider::max('weight');
        return view('admin.sliders.edit', compact('slide', 'max_order'));
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
        $request->validate([
            'name' => 'required',
            'image' => 'sometimes|required|image|max:100000',
            'weight' => ['integer'],
            'show' => ['boolean'],
        ]);

        $slide = Slider::find($id);

        $data = $request->all();

        if(!request()->has('show')){
            $data['active'] = 0;
        }else{
            $data['active'] = 1;
        }

        if ($file = Slider::uploadImage($request, $request->slide_img)) {
            $data['image'] = $file;
        }
        $slide->update($data);
        return redirect()->route('sliders.index')->with('success', 'Слайд изменен');
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slider::find($id);
        Storage::delete($slide->image);
        $slide->delete($id);
        return redirect()->route('sliders.index')->with('success', 'Слайд удален');
    }
}
