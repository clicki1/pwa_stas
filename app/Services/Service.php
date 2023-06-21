<?php

namespace App\Services;

use App\Models\Product;

class Service
{
    static function array_product($res_data = null)
    {
        $first = Product::first();

        if(!$first) {

            return [];
        }

        $first_m = $first->created_at->month;
        $first_y = $first->created_at->year;

        $lst = Product::latest()->first();
        $latest_m = $lst->created_at->month;
        $latest_y = $lst->created_at->year;
        $y_res = [];
        $m_res = [];
        $k = 0;
        for ($x = 2020; $x <= $latest_y; $x++) {
            array_push($y_res, $x);
        }
        foreach ($y_res as $year) {
            //  dd($year);
            if ($year < 2021) continue;
            for ($i = 0; $i <= 12; $i++) {
                if ($year == $latest_y && $i > $latest_m) break;

                if ($year == $first_y && $i < $first_m) {
                    // dump($i);
                    continue;
                } else {
                    $m_res[$k] = $year . '-' . $i;
                }
                $k++;
            }
        }

        $now_data = ($res_data) ? $res_data[0] . '-' . $res_data[1] : $latest_y . '-' . $latest_m;

        return [
            'now_data' => $now_data,
            'm_res' => $m_res,
            'lst' => $lst,
            'latest_y' => $latest_y,
            'latest_m' => $latest_m,
        ];
    }

    static function array_excel($res_data = null)
    {
        $arrs_filter = [];
        $arrs_filter  ['year'][0] = 'Год';
        $arrs_filter  ['month'][0] = 'Месяц';
        $arrs_filter  ['day'][0] = 'День';
        $arrs_filter  ['briquette'][0] = 'Сырого брикета (день), кг';
        $arrs_filter  ['briquette_all'][0] = 'Сырого брикета (Всего), кг';
        $arrs_filter  ['bake'][0] = 'Количество заложенного в печь (день), кг';
        $arrs_filter  ['bake_all'][0] = 'Количество заложенного в печь (Всего), кг';
        $arrs_filter  ['packed_1'][0] = 'Упаковано 1 сорт (день), кг';
        $arrs_filter  ['packed_1_all'][0] = 'Упаковано 1 сорт (Всего), кг';
        $arrs_filter  ['packed_2'][0] = 'Упаковано 2 сорт (день), кг';
        $arrs_filter  ['packed_2_all'][0] = 'Упаковано 2 сорт (Всего), кг';


        $first = Product::first();

        if(!$first) {

            return  $arrs_filter;
        }
        
        $first = $first->created_at->month;
        $latest = Product::latest()->first()->created_at->month;
        $latest_y = Product::latest()->first()->created_at->year;
        if ($res_data) {

            $products = Product::orderBy('id', 'DESC')->whereMonth('created_at', $res_data[1])->whereYear('created_at', $res_data[0])->get();
        } else {

            $products = Product::orderBy('id', 'DESC')->whereMonth('created_at', $latest)->whereYear('created_at', $latest_y)->get();
        }

        $day = 0;
        $k = 0;
        foreach ($products as $key => $product) {

            if ($product->created_at->day != $day) {
                $prod_days = $product->whereDay('created_at', $product->created_at->day)->get();

                $arrs_filter ['year'][$k + 1] = $product->created_at->year;
                $arrs_filter ['month'][$k + 1] = $product->created_at->month;
                $arrs_filter ['day'][$k + 1] = $product->created_at->day;
                $arrs_filter ['briquette'][$k + 1] = $prod_days->sum('briquette');
                $arrs_filter ['briquette_all'][$k + 1] = ($k != 0) ? ($arrs_filter ['briquette_all'][$k] + $prod_days->sum('briquette')) : $prod_days->sum('briquette');
                $arrs_filter ['bake'][$k + 1] = $prod_days->sum('bake');
                $arrs_filter ['bake_all'][$k + 1] = ($k != 0) ? ($arrs_filter ['bake_all'][$k] + $prod_days->sum('bake')) : $prod_days->sum('bake');
                $arrs_filter ['packed_1'][$k + 1] = $prod_days->sum('packed_1');
                $arrs_filter ['packed_1_all'][$k + 1] = ($k != 0) ? ($arrs_filter ['packed_1_all'][$k] + $prod_days->sum('packed_1')) : $prod_days->sum('packed_1');
                $arrs_filter ['packed_2'][$k + 1] = $prod_days->sum('packed_2');
                $arrs_filter ['packed_2_all'][$k + 1] = ($k != 0) ? ($arrs_filter ['packed_2_all'][$k] + $prod_days->sum('packed_2')) : $prod_days->sum('packed_2');

                $day = $product->created_at->day;
                $k++;
            }

        }
        return $arrs_filter;
    }
}
