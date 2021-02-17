<?php

namespace Modules\Item\Dao\Repositories;

use App\Dao\Facades\BranchFacades;
use Plugin\Helper;
use Plugin\Notes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Modules\Item\Dao\Models\Brand;
use Modules\Item\Dao\Models\Product;
use Modules\Item\Dao\Models\Category;
use App\Dao\Interfaces\MasterInterface;
use Illuminate\Database\QueryException;
use Modules\Item\Dao\Facades\CategoryFacades;
use Modules\Item\Dao\Facades\SubCategoryFacades;
use Modules\Item\Dao\Models\ProductDetail;
use Modules\Production\Dao\Models\Vendor;

class ProductRepository extends Product implements MasterInterface
{
    private static $brand;
    private static $category;

    public static function getBrand()
    {
        if (self::$brand == null) {
            self::$brand = new Brand();
        }

        return self::$brand;
    }

    public static function getCategory()
    {
        if (self::$category == null) {
            self::$category = new Category();
        }

        return self::$category;
    }

    public function dataRepository()
    {
        $brand = self::getBrand();
        $list = Helper::dataColumn($this->datatable, $this->primaryKey);
        // $product = [$this->getTable().'.*'];
        $query = $this->select($list)
            ->leftJoin($brand->getTable(), $brand->getKeyName(), 'item_product_item_brand_id')
            ->leftJoin(CategoryFacades::getTable(), CategoryFacades::getKeyName(), 'item_product_item_category_id');
        return $query;
    }

    public function getBestSeller(){
       return $this->dataRepository()->OrderByDesc('item_product_sold', 'DESC')->limit(12);
    }

    public function getNewProduct(){
       return $this->dataRepository()->OrderByDesc('item_product_counter')->OrderByDesc('item_product_id')->limit(12);
    }

    public function stockRepository()
    {
        $brand = self::getBrand();
        $category = self::getCategory();
        $color = new ColorRepository();

        $list = Helper::dataColumn($this->stock, $this->primaryKey);
        $query = $this->select($list)
            ->leftJoin('view_stock_product', 'product', 'item_product_id')
            ->leftJoin($brand->getTable(), $brand->getKeyName(), 'item_product_item_brand_id')
            ->leftJoin($color->getTable(), $color->getKeyName(), 'color')
            ->leftJoin($category->getTable(), $category->getKeyName(), 'item_product_item_category_id')
            ->orderBy('item_product_created_at', 'DESC')->orderBy('item_product_name', 'ASC');
        return $query;
    }

    public function saveRepository($request)
    {
        try {
            $activity = $this->create($request);
            return Notes::create($activity);
        } catch (\Illuminate\Database\QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function updateRepository($id, $request)
    {
        try {
            $activity = $this->findOrFail($id)->update($request);
            return Notes::update($activity);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function deleteRepository($data)
    {
        try {
            $activity = $this->Destroy(array_values($data));
            return Notes::delete($activity);
        } catch (\Illuminate\Database\QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function deleteProductVariant($id)
    {
        return DB::table('item_product_variant')->where('item_detail_product_id', $id)->delete();
    }

    public function deleteImageDetail($id)
    {
        return DB::table('item_product_image')->where('item_product_image_file', $id)->delete();
    }

    public function getImageDetail($id)
    {
        return DB::table('item_product_image')->where('item_product_image_item_product_id', $id)->get();
    }

    public function getProductVariant($id)
    {
        return ProductDetail::where('item_detail_product_id', $id)->get();
    }

    public function saveProductVariant($id, $variant)
    {
        DB::table('item_product_variant')->insert([
            'item_detail_product_id' => $id,
            'item_detail_variant_id' => $variant,
        ]);
    }

    public function saveImageDetail($id, $image)
    {
        DB::table('item_product_image')->insert([
            'item_product_image_item_product_id' => $id,
            'item_product_image_file' => $image,
        ]);
    }

    public function slugRepository($slug, $relation = false)
    {
        if ($relation) {
            return $this->dataRepository()->where('item_product_slug', $slug)->firstOrFail();
        }
        return $this->dataRepository()->where('item_product_slug', $slug)->firstOrFail();
    }

    public function showRepository($id, $relation = false)
    {
        if ($relation) {
            return $this->with($relation)->findOrFail($id);
        }
        return $this->dataRepository()->where($this->getKeyName(), $id)->firstOrFail();
    }
}
