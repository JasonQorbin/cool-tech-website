<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use App\Models\User;
use App\Models\Tag;

//Adds a few articles to the database
class SampleArticleAndTagSeeder extends Seeder
{
    private string $loremIpsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. In interdum nibh sagittis, pulvinar lacus id, congue neque. Etiam dignissim a elit vitae varius. Pellentesque blandit eleifend magna, at blandit nunc imperdiet pulvinar. Etiam euismod aliquam finibus. Praesent et justo eros. Sed imperdiet mattis elit vel fringilla. Praesent posuere ipsum ac diam iaculis ultricies. Donec vestibulum in justo vitae viverra. Morbi id purus elementum, pretium sem sit amet, euismod mi. Donec euismod ante sit amet ante efficitur, eu auctor tortor cursus. Vestibulum fermentum arcu felis, vitae bibendum urna suscipit et. Donec non mi lacinia, hendrerit nibh ut, dignissim metus. Curabitur a faucibus lectus, eget cursus tortor. Sed non cursus ipsum, id porta risus.

Morbi convallis suscipit diam, eu aliquet justo vestibulum quis. Fusce aliquam ante efficitur suscipit mollis. Donec mattis urna vel ipsum maximus feugiat. Morbi congue augue sit amet enim semper, a malesuada erat imperdiet. Phasellus maximus quam vel molestie tempus. Sed nec lacinia ante. Fusce a est ac tellus lacinia placerat. Aenean egestas eget lacus vitae lobortis. Curabitur posuere, ligula in fringilla gravida, ante lectus accumsan est, vitae iaculis est tellus in eros. Integer aliquet semper lorem, non pellentesque sapien ornare eu. Pellentesque odio elit, eleifend vehicula euismod eget, congue ornare nisi.

Ut faucibus vitae ipsum mattis scelerisque. Donec magna orci, rhoncus eu commodo vitae, cursus ac purus. Donec dignissim pellentesque massa id posuere. Nam tortor nibh, tincidunt vel commodo eget, viverra et lorem. Sed nec ultrices ipsum, et pellentesque erat. Aenean posuere sollicitudin urna in dictum. In sagittis ullamcorper venenatis. Sed egestas, nisl vel sollicitudin laoreet, nunc augue mattis risus, quis pretium nisi enim nec mi. Vestibulum non ipsum ligula. Phasellus ut aliquam lacus, non commodo tellus.

Ut tincidunt eros ac mi tristique sodales. Nulla ac sapien mauris. Pellentesque at turpis ac elit aliquam volutpat eget id diam. Vivamus rutrum tempor felis sit amet ultricies. Nunc sollicitudin vitae urna ornare mattis. Ut id magna maximus, faucibus est nec, laoreet lectus. Mauris consequat lacinia turpis quis finibus. Nullam et mi vitae lacus elementum maximus. Phasellus vitae hendrerit felis. Proin et diam eu urna varius vehicula. Morbi imperdiet, velit sed accumsan scelerisque, nibh turpis pretium nibh, eget porta neque sapien eget urna. Mauris ullamcorper, leo vehicula gravida sagittis, ligula ante pretium urna, a pharetra quam lectus ultrices lectus. Integer eget urna nulla. Nulla lorem sem, scelerisque id sagittis et, lobortis sed libero. Proin eget lectus nisi.

Vestibulum nec enim auctor magna venenatis aliquet. Aenean sit amet ornare nibh, non aliquam libero. Sed scelerisque bibendum augue nec scelerisque. Etiam sed convallis felis. Vivamus euismod neque quis est pellentesque, congue pretium nisl porta. Etiam tincidunt augue sed egestas vulputate. Sed pretium dignissim mauris, non ornare mi ornare eget. Etiam posuere luctus lacinia.";
    private function setPlaceholderContent($id){
        DB::table('articles')->where('id', $id)
            ->update(['content' => $this->loremIpsum]);
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'AI_tag' => "AI",
            'Google_tag' => "Google",
            'Hi_Perf_tag' => "High_Performance_Computing",
            'Sing_tag' => "Singularity",
            'Network_tag' => "Networking",
            'Game_tag' => "Gaming",
            'Self_tag' => "Self-hosted"
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(['name' => $tag]);
        }

        //Article 1
        $article = Article::firstOrCreate(['title' => 'An article about Google Bard'],['category_name' => 'Tech news']);

        DB::table('article_tag_joins')->insert(['article_id' => $article->id, 'tag_name' => $tags['AI_tag']]);
        DB::table('article_tag_joins')->insert(['article_id' => $article->id, 'tag_name' => $tags['Google_tag']]);
        $article->content = $this->loremIpsum;
        $article->save();

        //Article 2
        $article = Article::firstOrCreate(['title' => 'Laravel for your portfolio site!'],['category_name' => 'Software reviews']);

        DB::table('article_tag_joins')->insert(['article_id' => $article->id, 'tag_name' => $tags['Network_tag']]);
        DB::table('article_tag_joins')->insert(['article_id' => $article->id, 'tag_name' => $tags['Self_tag']]);
        $article->content = $this->loremIpsum;
        $article->save();

        //Article 3
        $article = Article::firstOrCreate(['title' => 'The SteamDeck | An Honest review'],['category_name' => 'Hardware reviews']);

        DB::table('article_tag_joins')->insert(['article_id' => $article->id, 'tag_name' => $tags['Game_tag']]);
        $article->content = $this->loremIpsum;
        $article->save();

        //Article 4
        $article = Article::firstOrCreate(['title' => 'The rise and fall of the AAA game'],['category_name' => 'Opinion pieces']);

        DB::table('article_tag_joins')->insert(['article_id' => $article->id, 'tag_name' => $tags['Game_tag']]);
        $article->content = $this->loremIpsum;
        $article->save();

        //Article 5
        $article = Article::firstOrCreate(['title' => "Palworld's success story"],['category_name' => 'Opinion pieces']);

        DB::table('article_tag_joins')->insert(['article_id' => $article->id, 'tag_name' => $tags['Game_tag']]);
        DB::table('article_tag_joins')->insert(['article_id' => $article->id, 'tag_name' => $tags['AI_tag']]);
        $article->content = $this->loremIpsum;
        $article->save();
    }
}
