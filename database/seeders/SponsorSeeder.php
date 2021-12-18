<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sponsor;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sponsor::insert([
            [
                'id' => 1,
                'brand' => 'Google',
                'image' => 'https://pbs.twimg.com/profile_images/805651234698842112/uPSrYOHT.jpg',                
                'link' => 'https://www.google.com/',
                'position' => 'header'
            ],
            [
                'id' => 2,
                'brand' => 'Tokopedia',
                'image' => 'https://i1.wp.com/netjurnal.com/wp-content/uploads/2016/08/Logo-tokopedia-netjurnal.jpg',                
                'link' => 'https://www.tokopedia.com/',                
                'position' => 'carousel'
            ],
            [
                'id' => 3,
                'brand' => 'Laravel',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png',                
                'link' => 'https://laravel.com/',                
                'position' => 'content'
            ],
            [
                'id' => 4,
                'brand' => 'vue',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/f/f1/Vue.png',                
                'link' => 'https://vuejs.org/',                
                'position' => 'content'
            ],
            [
                'id' => 5,
                'brand' => 'node js',
                'image' => 'https://img1.pngdownload.id/20180803/kih/kisspng-website-development-logo-node-js-scalable-vector-g-jet-5b643ebe602530.4459709115332963183938.jpg',                
                'link' => 'https://nodejs.org/',                
                'position' => 'content'
            ],
            [
                'id' => 6,
                'brand' => 'mongodb',
                'image' => 'https://media.trustradius.com/product-logos/x1/BQ/UA6NT9PUI691.PNG',                
                'link' => 'https://www.mongodb.com/',                
                'position' => 'content'
            ],
            [
                'id' => 7,
                'brand' => 'firebase',
                'image' => 'https://www.gstatic.com/devrel-devsite/prod/v7385327dc46d08b8dfdb825d1a873cb039e1740549bdbb7e3c982c2f1dbdd48e/firebase/images/touchicon-180.png',                
                'link' => 'https://firebase.google.com/',                
                'position' => 'carousel'
            ],            
            [
                'id' => 8,
                'brand' => 'mysql',
                'image' => 'https://www.freepnglogos.com/uploads/logo-mysql-png/logo-mysql-mysql-logo-png-images-are-download-crazypng-21.png',                
                'link' => 'https://www.mysql.com/',                
                'position' => 'carousel'
            ],            
        ]);
    }
}
