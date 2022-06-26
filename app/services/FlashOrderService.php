<?php

namespace App\services;

use Illuminate\Http\Request;
use App\Models\Product;

class FlashOrderService
{
    function flash_order($sum, $products): array
    {
        $n = sizeof($products);
        $K = array_fill(0, $n + 1,
            array_fill(0, $sum + 1, NULL));
        $recommend = [];
        // Build table K[][] in bottom up manner
        for ($i = 0; $i <= $n; $i++)
        {
            for ($w = 0; $w <= $sum; $w++)
            {
                if ($i == 0 || $w == 0)
                    $K[$i][$w] = 0;
                else if ($products[$i - 1]['price']<= $w)
                    $K[$i][$w] = max($products[$i - 1]['amount'] +
                        $K[$i - 1][$w - $products[$i - 1]['price']],
                        $K[$i - 1][$w]);
                else
                    $K[$i][$w] = $K[$i - 1][$w];
            }
        }

        // stores the result of Knapsack
        $res = $K[$n][$sum];

        $w = $sum;
        for ($i = $n; $i > 0 && $res > 0; $i--)
        {

            // either the result comes from the top
            // (K[i-1][w]) or from (val[i-1] + K[i-1]
            // [w-wt[i-1]]) as in Knapsack table. If
            // it comes from the latter one/ it means
            // the item is included.
            if ($res == $K[$i - 1][$w])
                continue;
            else
            {

                // This item is included.
                $recommend[] = $products[$i - 1]['id'];
                // Since this weight is included
                // its value is deducted
                $res = $res - $products[$i - 1]['amount'];
                $w = $w - $products[$i - 1]['price'];
            }
        }
        return $recommend;
    }
}
