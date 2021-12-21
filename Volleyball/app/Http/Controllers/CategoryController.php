<?php

namespace App\Http\Controllers;

use App\Category;

use Illuminate\Http\Request;
use App\Components\Recusive;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category= $category;
    }

    public function index()
    {
        $categories = $this->category->latest()->paginate(5);
        return view('admin.category.index' , compact('categories'));

    }


    public function create()
    {
        $htmlOption= $this->getCatagory($parentId = '');
        return view('admin.category.add', compact('htmlOption'));
    }

    public function store(Request $request)
    {
        $this->category->create([
           'name' => $request->name,
            'parent_id'=> $request->parent_id,
            'slug'=> Str::slug($request->name)
        ]);
        return redirect()->route('categories.index');
    }

    //Hàm getCatagory là hàm đệ quy danh mục sản phẩm
    public function getCatagory($parentId)
    {
        $data= $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption= $recusive->categoryRecusive($parentId);

        return $htmlOption;
    }

    public function edit($parentId)
    {
        $category = $this->category->find($parentId);
        $htmlOption = $this->getCatagory($category->parent_id);
        return view('admin.category.edit', compact('category','htmlOption'));
    }

    public function update($id,Request $request)
    {
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id'=> $request->parent_id,
            'slug'=> Str::slug($request->name)
        ]);
        return redirect()->route('categories.index');
    }

    public function delete($parentId)
    {
        $category = $this->category->find($parentId);
        $htmlOption = $this->getCatagory($category->parent_id);

        return view('admin.category.delete', compact('category','htmlOption'));
    }
    public function deleted($id,Request $request)
    {
        $this->category->find($id)->delete([
            'name' => $request->name,
            'parent_id'=> $request->parent_id,
            'slug'=> Str::slug($request->name)
        ]);
        return redirect()->route('categories.index');
    }

}
