<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recusive;

// ##########
use App\Http\Requests\ProductAddRequest;
use App\Product;
use App\ProductImage;
use App\ProductSize;
use App\ProductTag;
use App\Tag;
use App\Size;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use http\Message;
use App\Models\Flight;
use Illuminate\Support\Facades\Log;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DataTables;
use Illuminate\Http\Request;


class AdminProductController extends Controller
{
    use StorageImageTrait, DeleteModelTrait;

    private $category;
    private $productImage;
    private $tag;
    private $productTag;
    private $productSize;
    private $size;


    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag, ProductSize $productSize, Size $size)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
        $this->productSize = $productSize;
        $this->size = $size;
    }

//    public function index(Request $request)
//    {
//
//        if (request()->ajax()) {
//            $products = Product::select('id', 'name', 'price', 'feature_image_path', 'category_id')->get();
//            return Datatables::of($products)
//                ->addColumn('action', function ($product) {
//                    $deletebtn = '<a class="btn btn-secondary btn-sm" href=""><i class="fa fa-trash-o">Xóa</i></a>';
//                    return $deletebtn;
//                })
//
//                ->rawColumns(['action'])
//                ->make();
//        }
//        return view('admin.product.index');
//    }
    public function index()
    {
        $products = $this->product->latest()->paginate(5);
        return view('admin.product.index',compact('products'));
    }

    public function create()
    {
        $htmlOption = $this->getCatagory($parentId = '');
        $clothes = Size::where('name', 'clothes')->get();
        $shoes = Size::where('name', 'shoes')->get();
        return view('admin.product.add', compact('htmlOption', 'clothes', 'shoes'));
    }

    //Hàm getCatagory là hàm đệ quy danh mục sản phẩm
    public function getCatagory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);

        return $htmlOption;
    }

    public function store(ProductAddRequest $request)
    {
        try {
            DB::beginTransaction();
            // Thêm thông tin input bình thường
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'category_id' => $request->category_id,
                'views_count' => $request->view_count
            ];

            // Thêm hình ảnh thông qua lớp Trait
            $dataUpload = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUpload)) {
                $dataProductCreate['feature_image_path'] = $dataUpload['file_path'];
                $dataProductCreate['feature_image_name'] = $dataUpload['file_name'];
            }
            $product = $this->product->create($dataProductCreate);

            // Thêm các hình ảnh chi tiết (Mảng),
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    // thêm dữ liệu vào table Product_images trong Database
                    //// sử dụng Eloquen Relationships sẽ tự động lấy dữ liệu product_id
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);

                    /*  $this->productImage->create([
                        'product_id' => $product->id,
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);*/
                }
            }

            // Thêm tag cho sản phẩm vào table tags trong database
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
                $product->tags()->attach($tagIds);
            }

            // Thêm Size cho sản phẩm vào table product_size trong database
            if (!empty($request->shoes_size)) {
                foreach ($request->shoes_size as $shoesSize) {
                    ProductSize::create([
                        'product_id' => $product->id,
                        'size_id' => $shoesSize,
                        'quantity_product' => $request->quantity
                    ]);
                }
            }

            if (!empty($request->clothes_size)) {
                foreach ($request->clothes_size as $clothesSize) {
                    ProductSize::create([
                        'product_id' => $product->id,
                        'size_id' => $clothesSize,
                        'quantity_product' => $request->quantity
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $exception) {
            DB::rollback();
            Log::error('Message : ' . $exception->getMessage() . 'Line :' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getCatagory($product->category_id);
        $clothes = Size::where('name', 'clothes')->get();
        $shoes = Size::where('name', 'shoes')->get();
        $product_size = ProductSize::where('product_id',$id)->get();
        //        dd($sizesChecked);
        return view('admin.product.edit', compact('htmlOption', 'product', 'clothes','shoes','product_size'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // Sửa thông tin input bình thường
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
//                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];

            // Thêm hình ảnh thông qua lớp Trait
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            }
            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);

            // Thêm các hình ảnh chi tiết (Mảng),
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    // thêm dữ liệu vào table Product_images trong Database
                    //// sử dụng Eloquen Relationships sẽ tự động lấy dữ liệu product_id
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);

                    /*  $this->productImage->create([
                        'product_id' => $product->id,
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);*/
                }
            }

            // Thêm tag cho sản phẩm vào table tags trong database
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
                $product->tags()->sync($tagIds);
            }

            // Cập nhật Size cho sản phẩm
            if (!empty($request->shoes_size && !empty($request->quantity))) {
                $product->productSize()->sync($request->shoes_size);
                ProductSize::where('product_id',$id)->update([
                    'quantity_product' => $request->quantity
                ]);
            }

            if (!empty($request->clothes_size) && !empty($request->quantity)) {
                $product->productSize()->sync($request->clothes_size);
                ProductSize::where('product_id',$id)->update([
                    'quantity_product' => $request->quantity
                ]);
            }

            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $exception) {
            DB::rollback();
            Log::error('Message : ' . $exception->getMessage() . 'Line :' . $exception->getLine());
        }
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->product);
    }


    public function search(Request $request)
    {
        $keyWords = $request->product_search;
        $search_product = Product::where('name','like','%' . $keyWords . '%')->orWhere('price','like','%' . $keyWords . '%')
            ->orWhere('price','like','%' . $keyWords . '%')->orWhere('content','like','%' . $keyWords . '%')
            ->orWhere('id','like','%' . $keyWords . '%')->get();
        return view('admin.product.search',compact('search_product'));
    }
}
