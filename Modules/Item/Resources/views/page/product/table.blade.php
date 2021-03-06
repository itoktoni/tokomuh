<table id="transaction" class="table table-no-more table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-left col-md-2">Custom Name</th>
            <th class="text-left col-md-3">Shop</th>
            <th class="text-left col-md-1">Color</th>
            <th class="text-left col-md-1">Size</th>
            <th class="text-left col-md-2">Variant</th>
            <th class="text-right col-md-1">Price</th>
            <th class="text-center col-md-1">Stock</th>
            <th class="text-left col-md-1">Qty</th>
            <th class="text-center col-md-2">Action</th>
        </tr>
    </thead>
    <tbody class="markup">
        @if(!empty($detail) || old('detail'))
        @foreach (old('detail') ?? $detail as $item)
        <tr>
            <td data-title="Custom Name" class="text-left col-lg-2">
                {{ $item->item_detail_name }}
            </td>
            <td data-title="Shop" class="text-left col-lg-1">
                {{ $item->item_detail_branch_name }}
            </td>
            <td data-title="Color" class="text-left col-lg-1">
                {{ $item->item_detail_color_name }}
            </td>
            <td data-title="Size" class="text-left col-lg-1">
                {{ $item->item_detail_size_name }}
            </td>
            <td data-title="Variant" class="text-left col-lg-1">
                {{ $item->item_detail_variant_name }}
            </td>
            <td data-title="Price" class="text-right col-lg-1">
                {{ Helper::createRupiah($item->item_detail_price) }}
            </td>
            <td data-title="Price" class="text-center col-lg-1">
                @if($item->item_detail_stock_enable)  
                <span class="btn btn-success btn-xs">Enable</a>
                @else
                <span class="btn btn-danger btn-xs">Disable</a>
                @endif 
            </td>
            <td data-title="Price" class="text-right col-lg-1">
                {{ $item->item_detail_stock_qty }}
            </td>
            <td data-title="Action" class="text-center col-lg-2">
                <a class="btn btn-success btn-xs" href="{{ route($module.'_variant', ['code' => $model->{$model->getKeyName()}, 'id' => $item->item_detail_id]) }}">Edit</a>
                <a class="btn btn-danger btn-xs" href="{{ route($module.'_variant', ['code' => $model->{$model->getKeyName()}, 'del' => $item->item_detail_id]) }}">Delete</a>
            </td>
        </tr>
        @endforeach
        @endisset
    </tbody>

</table>