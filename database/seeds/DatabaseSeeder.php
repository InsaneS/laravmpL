<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Post; //Yes
use App\User; //Yes
use App\Waifu; //Yes
use App\hashtagtype; //Yes
use App\Hashtag; //Yes
use App\fiction; //Yes
use App\relationposthashtag; //Yes
use App\Userrole; //Yes
use App\waifuuserrelation; //Yes
use App\waifupostrelation; //Yes
use App\waifuhashtagrelation; //Yes
use App\relationpostuserlike; //Yes



class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call('UserTableSeeder');
        $this->call('PostSeeder');
        Model::reguard();
    }
}



class PostSeeder extends Seeder {
    
    
    public function run(){
        
        DB::table('Posts')->delete();
        Post::create([
            'previewIMG' => 'ArtsFull/ArtsPreview/1mPApreview.png',
            'fullIMG' => 'ArtsFull/1mPA.png',
            'author_id' => '1',
            'Published' => 'true',
        ]);
        Post::create([
            'previewIMG' => 'ArtsFull/ArtsPreview/2mPApreview.png',
            'fullIMG' => 'ArtsFull/2mPA.png',
            'author_id' => '1',
            'Published' => 'false',
        ]);
        Post::create([
            'previewIMG' => 'ArtsFull/ArtsPreview/3mPApreview.png',
            'fullIMG' => 'ArtsFull/3mPA.png',
            'author_id' => '1',
            'Published' => 'true',
        ]);
        
        DB::table('users')->delete();
        User::create([
            'Name' => 'Benjamin2U',
            'email' => 'aaaa2@aaaa.aaa',
            'password' => '26111996',
            'Role_id' => '1',
        ]);
        DB::table('waifus')->delete();
        Waifu::create([
            'SmName' => 'Miku',
            'FullName' => 'Hatsune Miku',
            'Archetype' => 'Yamato Nadeshiko',
            'FullImgUrl' => '/WaifuPortrait/W1_F.png',
            'previewImgUrl' => '/WaifuPortrait/WPPreview/W1_P.png',
            'Fiction_id' => '1',
            'active' => 'true',
        ]);
        
        DB::table('Relationpostuserlikes')->delete();
        
        
        
        DB::table('fictions')->delete();
        fiction::create([
            'name' => 'Vocaloid',
            'url' => 'https://en.wikipedia.org/wiki/Vocaloid',
            'active' => 'true',
        ]);
        
    }
}