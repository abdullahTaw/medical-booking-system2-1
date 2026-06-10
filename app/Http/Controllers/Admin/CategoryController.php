<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.categories',compact('categories'));
    }

    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    public function create()
    {
        $modalContent = view('admin.category.create_category')->render();

        return response()->json(['modalContent' => $modalContent]);
    }


    public function store(Request $request)
    {

        // التحقق من المدخلات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
        ] );
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $validated['image'] = $request->file('image')->store('/','files');
        }
        // إنشاء خدمة جديد
        Category::create($validated);

        $notification = trans('Created Successfully');
        return response()->json(['redirect_url' => route('admin.category.index'),
        'notification' => $notification ]
    );
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $modalContent = view('admin.category.edit_category',compact('category'))->render();
        return response()->json(['modalContent' => $modalContent]);

    }


    public function update(Request $request,$id)
    {
        $category = Category::find($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
        ] );
        $validated['image']= $category->image;
        if($request->hasFile('image') && $request->file('image')->isValid()){
            if($category->image)
                Storage::disk('files')->delete($category->image);
            $validated['image'] = $request->file('image')->store('/','files');
        }
        $category->update($validated);

        $notification = trans('dash.Updated Successfully');
        return response()->json(['redirect_url' => route('admin.category.index'),
        'notification' => $notification ]
    );
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        $notification = trans('Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.category.index')->with($notification);
    }

    public function changeStatus($id){
        $category = Category::find($id);
            if($category->status=='active'){
                $category->status='inactive';
                $category->save();
                $message = trans('Inactive Successfully');
            }else{
                $category->status='active';
                $category->save();
                $message= trans('Active Successfully');
            }
            return response()->json($message);
    }

}
