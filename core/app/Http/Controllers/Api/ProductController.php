<?php

namespace App\Http\Controllers\Api;

use App\Helper\ProductFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\SpecialProductResource;
use App\Models\MainCategory;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SpecialProduct;
use Hamcrest\Arrays\IsArray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function allProducts(ProductRequest $request, ProductFilters $filtersClass) {
        $filters['name']              = $request->name;
        $filters['main_category_id']  = $request->mainCategoryId;
        $filters['sub_category_id']   = $request->subcategoryId;
        $filters['price']['priceMin'] = $request->priceMin;
        $filters['price']['priceMax'] = $request->priceMax;

        $filtersClass->userInputs = $filters;
        $products = Product::filter($filtersClass)->paginate(12);

        return ProductResource::collection($products);
    }

    public function allProductsforfilter() {


        // $filtersClass->userInputs = $filters;
        // $products = Product::filter($filtersClass)->paginate(12);
        $products = Product::all();

        return ProductResource::collection($products);
    }

    //

    // featuredProducts

    public function featuredProducts() {
        $products = Product::where('featured', 1)->get();
        return ProductResource::collection($products);
    }

    //Top selling products

    public function topSellingProducts(Request $request) {
        $limit = $request->query('limit', 10);
         // Subquery to calculate total sales per product
    $salesSubquery = DB::table('order_details')
    ->select('product_id', DB::raw('SUM(quantity) as total_sales'))
    ->groupBy('product_id');

         // Join products with the sales subquery
    $products = DB::table('products')
    ->leftJoinSub($salesSubquery, 'sales_summary', 'products.id', '=', 'sales_summary.product_id')
    ->select('products.*', 'sales_summary.total_sales')
    ->orderByDesc('sales_summary.total_sales')
    ->take($limit)
    ->get();
    // Add main category to each product
    $products->transform(function ($product) {


        $main_category = Product::find($product->id)->mainCategory()->get();  // Get main category

        $product->mainCategory = $main_category->map(function ($category) {
            return $category; });// Add main category to product
        return $product;
    });
    // Add main category to each product
    $products->transform(function ($product) {


        $main_category = Product::find($product->id)->attributes()->get();  // Get main category

        $product->attributes = $main_category->map(function ($category) {
            return $category; });// Add main category to product




       // Process image paths (assuming it's already an array)
       $imagePaths = $product->photos ?? []; // Assuming 'image_path' is the field


       if (is_string($imagePaths)) {
        // Decode if stored as JSON string
        $imagePaths = json_decode($imagePaths, true);
    }
    // dd($imagePaths);
       if (is_array($imagePaths)) {
        // Map image paths to URLs
        $product->photos = array_map(function ($path) {
            $cleanPath = str_replace('\\', '', $path); // Remove unwanted slashes
            return "$cleanPath";
        }, $imagePaths);
    } else {
        $product->photos = []; // Fallback to an empty array if not valid
    }


        return $product;
    });
            // return$products;

        return ProductResource::collection($products);
    }


    // get all packages

    public function packageProducts(Request $request)
    {
        $limit = $request->query('limit', 30);

        // Fetch products where is_package = true
        $products = Product::where('is_package', 1)
            ->take($limit)
            ->get();

            return ProductResource::collection($products);
            }
    public function productDetail($id) {
        $product         = new ProductResource(Product::findOrFail($id));;
        // $relatedProducts = Product::where('main_category_id', $product->main_category_id)->get();
        $productrelated = Product::with('mainCategory')->findOrFail($id);
        $relatedProducts = Product::whereHas('mainCategory', function ($query) use ($productrelated) {
            $query->whereIn('main_category_id', $productrelated->mainCategory->pluck('id'));
        })->where('products.id', '!=', $product->id)->get();
        $relatedProducts = ProductResource::collection($relatedProducts);
        return ['product' => $product, 'relatedProducts' => $relatedProducts];
    }
    public function productByCategory() {
        // $products = Product::all();
        $products = Product::with('mainCategory')->get();
        // return $products;
        $groupedProducts = $products->flatMap(function ($product) {
            return $product->mainCategory->map(function ($category) use ($product) {
                return [
                    'category' => trim($category->name),
                    'product' => new ProductResource($product),
                ];
            });
       ; // Exclude items with empty category names
        })->groupBy('category');

        return $groupedProducts;

        // ProductResource::collection($products)->groupBy('mainCategory.name');
    }
    public function mainCategories() {
        return CategoryResource::collection(MainCategory::all());
    }
    public function sliders() {
        return SliderResource::collection(Slider::all());
    }
    public function specialOffers() {
        return SpecialProductResource::collection(SpecialProduct::all());
    }
}
