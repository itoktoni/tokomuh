<table width=100%>
    <tbody>
        <tr>
            <td bgcolor="#ffffff" id="m_-3784408755349078820contentContainer"
                style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                <table align="left" width="100%" style="border-collapse:collapse;border-spacing:0;margin:0;padding:0">
                    <tbody>
                        <tr>
                            <td width="15"
                                style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                            </td>
                            <td align="left" width="550"
                                style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                                <table align="left" width="100%"
                                    style="border-collapse:collapse;border-spacing:0;margin:0;padding:0">
                                    <tbody>
                                        <tr>
                                            <td
                                                style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                                                <div style="margin:10px 2px -25px">
                                                    <p
                                                        style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:15px;font-weight:bold;margin:0;padding:0">
                                                        Notification Order From System
                                                        {{ config('website.name') }},
                                                    </p>

                                                </div>
                                                <div style="margin:10px 2px">
                                                    <br>
                                                    <table border="0" cellpadding="5" cellspacing="0"
                                                        id="m_-3784408755349078820templateList" width="100%"
                                                        style="border-collapse:collapse;border-spacing:0;font-size:13px;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0 0 25px;padding:0"
                                                        bgcolor="#FFFFFF">
                                                        <tbody>
                                                            <tr>
                                                                <th colspan="4"
                                                                    style="border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px"
                                                                    bgcolor="#{{ config('website.color') }}">
                                                                    <h2
                                                                        style="font-family:Arial,sans-serif;color:#ffffff;line-height:1.5;font-size:15px;font-weight:bold;margin:0;padding:5px 0">
                                                                        No. Order : {{ $master->sales_order_id }}
                                                                    </h2>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" colspan="1" valign="top"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px"
                                                                    bgcolor="#FFFFFF">
                                                                    <span
                                                                        style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:13px;margin:0;padding:0">Waktu
                                                                        Transaksi</span>
                                                                </td>
                                                                <td align="right" valign="top" colspan="3"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px"
                                                                    bgcolor="#FFFFFF">
                                                                    <span
                                                                        style="text-align: right;font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:13px;margin:0;padding:0">{{ $master->sales_order_created_at->format('d M Y H:i:s') }}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" colspan="1" valign="top"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px"
                                                                    bgcolor="#FFFFFF">
                                                                    <span
                                                                        style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:13px;margin:0;padding:0">
                                                                        Nama Customer</span>
                                                                </td>
                                                                <td align="right" valign="top" colspan="3"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px"
                                                                    bgcolor="#FFFFFF">

                                                                    <span
                                                                        style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:13px;margin:0;padding:0">
                                                                        {{ $master->sales_order_to_name ?? '' }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" colspan="1" valign="top"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px"
                                                                    bgcolor="#FFFFFF">
                                                                    <span
                                                                        style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:13px;margin:0;padding:0">Email</span>
                                                                </td>
                                                                <td align="right" valign="top" colspan="3"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px"
                                                                    bgcolor="#FFFFFF">
                                                                    <a
                                                                        style="text-align: right;color:#{{ config('website.color') }}!important;font-family:Arial,sans-serif;line-height:1.5;text-decoration:none;font-size:13px;margin:0;padding:0">
                                                                        {{ $master->sales_order_to_email ?? '' }}
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" colspan="1" valign="top"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px"
                                                                    bgcolor="#FFFFFF">
                                                                    <span
                                                                        style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:13px;margin:0;padding:0">Phone</span>
                                                                </td>
                                                                <td align="right" valign="top" colspan="3"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px"
                                                                    bgcolor="#FFFFFF">
                                                                    <span
                                                                        style="text-align: right;font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:13px;margin:0;padding:0">
                                                                        {{ $master->sales_order_to_phone ?? '' }}
                                                                    </span>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td align="left" colspan="1" valign="top"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px"
                                                                    bgcolor="#FFFFFF">
                                                                    <span
                                                                        style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:13px;margin:0;padding:0">Address</span>
                                                                </td>
                                                                <td align="right" valign="top" colspan="3"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px"
                                                                    bgcolor="#FFFFFF">
                                                                    <span
                                                                        style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:13px;margin:0;padding:0">
                                                                        {{ $master->sales_order_to_address ?? '' }} /
                                                                        {{ Helper::getSingleArea($master->sales_order_to_area, true) ?? '' }}
                                                                    </span>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th colspan="4"
                                                                    style="border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px"
                                                                    bgcolor="#{{ config('website.color') }}"></th>
                                                            </tr>
                                                            <tr>
                                                                <td align="left"
                                                                    class="m_-3784408755349078820headingList"
                                                                    valign="top" width="65%"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;font-size:11px;margin:0;padding:5px 10px"
                                                                    bgcolor="#F0F0F0">
                                                                    <strong style="color:#555;font-size:13px">
                                                                        Product Name
                                                                    </strong>
                                                                </td>
                                                                <td align="center"
                                                                    class="m_-3784408755349078820headingList"
                                                                    valign="top" width="10%"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;font-size:11px;margin:0;padding:5px 10px"
                                                                    bgcolor="#F0F0F0">
                                                                    <strong
                                                                        style="color:#555;font-size:13px">Qty</strong>
                                                                </td>
                                                                <td align="center"
                                                                    class="m_-3784408755349078820headingList"
                                                                    valign="top" width="10%"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;font-size:11px;margin:0;padding:5px 10px"
                                                                    bgcolor="#F0F0F0">
                                                                    <strong
                                                                        style="color:#555;font-size:13px">Price</strong>
                                                                </td>
                                                                <td align="right"
                                                                    class="m_-3784408755349078820headingList"
                                                                    valign="top" width="15%"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;font-size:11px;margin:0;padding:5px 10px"
                                                                    bgcolor="#F0F0F0">
                                                                    <strong
                                                                        style="color:#555;font-size:13px">Total</strong>
                                                                </td>
                                                            </tr>

                                                            <?php
                                                            $sub = 0;
                                                            $total = 0;
                                                            ?>
                                                            @foreach ($detail as $item)
                                                            <?php
                                                            $sub = $item->sales_order_detail_qty_order * $item->sales_order_detail_price_order;
                                                            $total = $total + $sub;
                                                            ?>

                                                            <tr>
                                                                <td align="left" valign="middle" width="50%"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px"
                                                                    bgcolor="#FFFFFF">
                                                                    {{ $item->product->item_product_name ?? '' }}
                                                                    @foreach($item->variant->where('sales_order_detail_variant_qty','>',0) as $variant)
                                                                    <p>
                                                                        -
                                                                        |{{ $variant->sales_order_detail_variant_qty }}|
                                                                        {{ $variant->variant->item_variant_name }}
                                                                    </p>
                                                                    @endforeach
                                                                </td>
                                                                <td align="center" valign="middle" width="10%"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px"
                                                                    bgcolor="#FFFFFF">
                                                                    {{ Helper::createRupiah($item->sales_order_detail_qty) ?? '' }}
                                                                </td>
                                                                <td align="center" valign="middle" width="15%"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px"
                                                                    bgcolor="#FFFFFF">
                                                                    {{ Helper::createRupiah($item->sales_order_detail_price) ?? '' }}
                                                                </td>
                                                                <td align="right" valign="middle" width="25%"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px"
                                                                    bgcolor="#FFFFFF">
                                                                    <span
                                                                        style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:13px;margin:0;padding:0"></span><span
                                                                        style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:13px;margin:0;padding:0">
                                                                        {{ Helper::createRupiah($item->sales_order_detail_total) ?? '' }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            @endforeach

                                                            <tr>
                                                                <th colspan="4"
                                                                    style="border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px"
                                                                    bgcolor="#{{ config('website.color') }}"></th>
                                                            </tr>
                                                            @if (!empty($master->sales_order_discount_value))
                                                            <tr>
                                                                <td align="left" colspan="2" valign="top"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px"
                                                                    bgcolor="#f0f0f0">
                                                                    <span
                                                                        style="font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:13px;margin:0;padding:0">
                                                                        {{ ucfirst($master->sales_order_discount_name) ?? '' }}
                                                                        : =
                                                                        Total Discount
                                                                    </span>
                                                                </td>
                                                                <td align="right" valign="top" colspan="2"
                                                                    style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#555;line-height:1.5;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;margin:0;padding:5px 10px"
                                                                    bgcolor="#f0f0f0">
                                                                    <span
                                                                        style="text-align: right;font-family:Arial,sans-serif;color:#555;line-height:1.5;font-size:13px;margin:0;padding:0">
                                                                        -{{ Helper::createRupiah($master->sales_order_discount_value) ?? '' }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            @endif

                                                            @php
                                                            $total_delivery = $master->sales_order_sum_product;
                                                            $total_discount = $master->sales_order_sum_discount;
                                                            $grand_total = $master->sales_order_sum_total;
                                                            @endphp

                                                            <tr>
                                                                <th colspan="1"
                                                                    style="text-align: left;border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px"
                                                                    bgcolor="#{{ config('website.color') }}">
                                                                    <h2
                                                                        style="font-family:Arial,sans-serif;color:#ffffff;line-height:1.5;font-size:13px;margin:0;padding:5px 0">
                                                                        Total
                                                                    </h2>
                                                                </th>
                                                                <th colspan="3"
                                                                    style="text-align: right;border-bottom-style:none;color:#ffffff;padding-left:10px;padding-right:10px"
                                                                    bgcolor="#{{ config('website.color') }}">
                                                                    <h2
                                                                        style="text-align: right;font-family:Arial,sans-serif;color:#ffffff;line-height:1.5;font-size:13px;margin:0;padding:5px 0">
                                                                        {{ Helper::createRupiah($grand_total) ?? '' }}
                                                                    </h2>
                                                                </th>
                                                            </tr>

                                                        </tbody>
                                                    </table>

                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </td>
                            <td width="15"
                                style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                            </td>
                        </tr>
                        <tr>
                            <td height="30" width="15"
                                style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                            </td>
                            <td height="30" width="550"
                                style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                            </td>
                            <td height="30" width="15"
                                style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td
                style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                <table align="left" id="m_-3784408755349078820securityAnnouncementWrapper" width="100%"
                    style="border-collapse:collapse;border-spacing:0;font-size:13px;margin:0;padding:0"
                    bgcolor="#f0f0f0">
                    <tbody>
                        <tr>
                            <td height="5" width="15"
                                style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                            </td>
                            <td height="5" width="24"
                                style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                            </td>
                            <td height="5" width="10"
                                style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                            </td>
                            <td height="5" width="516"
                                style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                            </td>
                            <td height="5" width="15"
                                style="border-collapse:collapse;border-spacing:0;font-family:Arial,sans-serif;color:#999;line-height:1.5;margin:0;padding:0">
                            </td>
                        </tr>

                    </tbody>
                </table>

            </td>
        </tr>

    </tbody>
</table>