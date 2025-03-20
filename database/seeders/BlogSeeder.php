<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample blog data
        $blogs = [
            [
                'title' => 'A Heartwarming Experience at the Wageningen Kerstmarkt',
                'author' => 'masmuni',
                'content' => '<p><i>Christmas Magic</i></p>

                <p>2024 Wageningen Kerstmarkt showed me the true meaning of community and support. It was a day I will never forget.</p>

                <p>The day before the market, I discovered that my stall had been placed in a small alley with very little foot traffic. To make things worse, the weather forecast predicted cold and rainy conditions. I felt a wave of disappointment. After spending an entire week baking and preparing for the event, it seemed like all my hard work would go unnoticed.</p>

                <p>But instead of giving in to those feelings, I decided to take action. I reached out to people I knew — local entrepreneurs, members of the communities I’m part of, friends, and even acquaintances. I also posted on social media, asking for help to let people know about my stall. It was a simple request, but the response was incredible.</p>

                <p>On the day of the market, my friends came early to support me. They helped set up the stall, assisted with selling the baked goods, and even put up a small sign at the main road to direct visitors to my location. As customers started to arrive, something amazing happened — they began telling their friends about my stall. Some even shared posts about it on social media.</p>

                <p>Despite the challenging location and the gloomy weather, I sold out by the end of the day. This would not have been possible without the kindness and effort of so many people. I was deeply moved by the way the Wageningen community came together to support me.</p>

                <p>This experience taught me a valuable lesson: even when things seem tough, there is always hope when you ask for help and trust in the goodness of others. The warmth, generosity, and encouragement I received reminded me of how important it is to be part of a caring community.</p>

                <p>Looking back, I feel so grateful for everyone who stood by me that day. Their support turned what could have been a difficult situation into one of my most cherished memories.</p>

                <p>Thank you, Wageningen, for showing me the power of community.</p>

                <p>My friends who helped a lot during the day</p>

                <p>Picture of my friends. My backbone during Wageningen kerstmarkt. I cannot do it without them 🙂</p>',
            ],
            [
                'title' => 'The Magic of Ube Cake',
                'author' => 'jayson',
                'content' => '<p>Ube cake is a Filipino dessert made with ube halaya (mashed purple yam). It is a light and fluffy cake with a sweet and nutty flavor. Ube cake is often topped with ube halaya, whipped cream, or grated cheese.</p>
                <p>Ube cake is a popular dessert in the Philippines and is often served at special occasions. It is also becoming increasingly popular in other parts of the world.</p>',
            ],
            [
                'title' => 'Delicious Cookies',
                'author' => 'jayson',
                'content' => '<p>Cookies are a type of baked good that is typically made from flour, sugar, and fat. They can be made in a variety of flavors and shapes, and are often enjoyed as a snack or dessert.</p>
                <p>Some popular types of cookies include chocolate chip cookies, oatmeal cookies, and sugar cookies. Cookies can be made at home or purchased from a bakery or grocery store.</p>',
            ],
            [
                'title' => 'Tasty Brownies',
                'author' => 'jayson',
                'content' => '<p>Brownies are a type of baked good that is typically made from chocolate, flour, sugar, and eggs. They are often dense and fudgy, and can be made in a variety of flavors and shapes.</p>
                <p>Some popular types of brownies include chocolate brownies, fudge brownies, and blondies. Brownies can be made at home or purchased from a bakery or grocery store.</p>',
            ],
            [
                'title' => 'Sweet Cupcakes',
                'author' => 'jayson',
                'content' => '<p>Cupcakes are a type of baked good that is typically made from cake batter and baked in a small cup-shaped mold. They can be made in a variety of flavors and shapes, and are often topped with frosting or other decorations.</p>
                <p>Some popular types of cupcakes include chocolate cupcakes, vanilla cupcakes, and red velvet cupcakes. Cupcakes can be made at home or purchased from a bakery or grocery store.</p>',
            ],
        ];

        // Insert the blog data into the database
        foreach ($blogs as $blog) {
            Blog::create([
                'title' => $blog['title'],
                'slug' => Str::slug($blog['title']),
                'content' => $blog['content'],
                'author' => $blog['author'],
            ]);
        }
    }
}
