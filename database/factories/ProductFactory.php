<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $imgLinks = [
            'https://smileshop.vn/uploads/plugin/news/77/1546848268-2090947319-t-i-sao-th-t-bo-wagyu-l-i-co-gia-t.jpg',
            'https://www.sieuthithitbo.net/uploads/files/2016/07/02/Th-n-Ngo-i-B-c-2.jpg',
            'http://kokugyu.com.vn/wp-content/uploads/2020/07/skiLh7yvO7.jpg',
            'https://nghebep.com/wp-content/uploads/2018/06/cach-lam-thit-bo-xao-dua.jpg',
            'https://monngonmoingay.tv/wp-content/uploads/2019/08/thit-bo-xao-he.jpg',

            'https://cdn.daynauan.info.vn/wp-content/uploads/2020/10/ga-nuong-muoi-ot.jpg',
            'https://images.foody.vn/res/g89/888442/prof/s640x400/foody-upload-api-foody-mobile-2-190219161034.jpg',
            'https://cdn.cet.edu.vn/wp-content/uploads/2022/01/ga-rang-muoi.jpg',
            'https://nghebep.com/wp-content/uploads/2017/11/mon-chan-ga-nuong-muoi-ot.jpg',
            'http://file.hstatic.net/1000115147/file/ga-gion-sot-chua-ngot_06d6f8c40f9a49cf9a6176c0fc9796df_grande.jpg'
        ];
        $dishName = 'This is great dish ' . implode($this->faker->words);
        $des = '';
        for ($i = 0; $i < rand(10, 30); $i++) {
            $des .= '<p>' . $this->faker->sentence(rand(5, 10)) . '</p>';
        }
        return [
            'name' => $dishName,
            'price' => $this->faker->numberBetween(15000, 30000),
            'description' => $des,
            'main_image_path' => $this->faker->randomElement($imgLinks),
            'main_image_name' => $this->faker->name(),
            'amount' => '69',
            'slug' => Str::slug($dishName, '-')
        ];
    }
}
