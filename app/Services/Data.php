<?php

namespace App\Services;

use App\Models\Product;

class Data {

    public static function save($result_array)
    {
        // dd('DATA');
        foreach($result_array as $result)
        {        
            // echo $result['_source']['search_result_data']['ean'] . '<hr>';
            Product::create([
                'ean' => $result['_source']['search_result_data']['ean'] ?? '',
                'name' => $result['_source']['search_result_data']['name'] ?? '',
                'brand' => $result['_source']['search_result_data']['brand'] ?? '',
                'price' => $result['_source']['search_result_data']['price'] ?? '',
                'price_retail' => $result['_source']['search_result_data']['price_retail'] ?? '',
    
                'small_image' => $result['_source']['search_result_data']['small_image'] ?? '',
                'image' => $result['_source']['search_result_data']['image'] ?? '',
                'big_image' => $result['_source']['search_result_data']['big_image'] ?? '',
                
                'group_slug' => $result['_source']['search_result_data']['group_slug'] ?? '',
                // 'ean' => $result['_source']['search_result_data']['homepage'],
                'url' => $result['_source']['search_result_data']['url'] ?? '',
            ]);
            
        }
    }
}