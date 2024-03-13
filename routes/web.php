<?php

use Illuminate\Support\Facades\Route;
use App\Models\Article;

/**
 * Converts the category name stored in the database to a uri slug.
 * Expects the name to be given in the form "Tech news", with spaces between the words and the first word capitalized.
 * Return a string in the form "tech-news" with all characters lower case and the hyphens instead of spaces.
 *
 * @param $name The name from the database.
 * @return string the converted string
 */
function getSlugFromName($name) {
    return strtr(lcfirst($name)," ", "-");
}

/**
 * Converts the category uri slug a name in the same form as what is stored in the database.
 * Expects the slug to be given in the form "tech-news", with hyphens between the words and all character in lowercase.
 * Returns a string in the form "Tech news" with the first word capitalized and the spaces instead of hyphens.
 *
 * @param $slug The uri slug of a category.
 * @return string the converted string
 */
function getNameFromSlug($slug) {
    return strtr(ucfirst($slug),"-", " ");
}

function getArticlesByTag($tagName) {
    return DB::table('articles')
        ->join('article_tag_joins', 'articles.id', '=', 'article_tag_joins.article_id')
        ->where('article_tag_joins.tag_name', '=', $tagName)
        ->select('articles.*')
        ->get();
}

function getTagViewFromSlug($slug) {
    $tagName = getNameFromSlug($slug);
    $articles = getArticlesByTag($tagName);
    if (sizeof($articles) > 0) {
        return view('tag', [
            'articles' => $articles,
            'tagName' => $tagName
        ]);
    } else {
        abort(404);
    }
}

function getCategoryViewFromSlug($slug) {
    $categoryName = getNameFromSlug($slug);
    $articles = Article::where('category_name', $categoryName)->get();

    if (sizeof($articles) > 0) {
        return view('category', [
            'articles' => $articles,
            'categoryName' => $categoryName
        ]);
    } else {
        abort(404);
    }
}

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * Web route for the home page. Fetches the 5 latest article from the database, extracts the id, title
 * and the first paragraph from the content and passes the mto the home pag view in an array.
 */
Route::get('/', function () {
    $articlesFromDB = Article::latest()->take(5)->get();
    $articles = [];
    foreach ($articlesFromDB as $articleFromDB) {
        //Extract the first paragraph to be displayed on the home page as a "snippet" of the article
        $firstPara = substr($articleFromDB->content,0, strpos($articleFromDB->content, "\n\n"));
        $firstParaWithClass = '<p class="article-snippet">' . $firstPara . "</p>";
        $articles[] = [
            "title" => $articleFromDB->title,
            "id" => $articleFromDB->id,
            "firstPara" => $firstParaWithClass
        ];
    }
    return view('home', ['articles' => $articles]);
});

Route::get('/article', function() {
    if ($_GET['term'] != null) {

        $article = Article::where('title', $_GET['term'])->first();
        if ($article != null) {
            return view('article', ['article'=>$article]);
        }

        $articles = Article::where('title', 'like', "%" . $_GET['term'] . "%")->get();
        if ( sizeof($articles) > 0 ) {
            return view('article-list',
                [
                    'articles' =>$articles,
                    'searchTerm' => $_GET['term']
                ]);
        }
    }

    abort(404);

});

Route::get('/article/{id}', function($id) {
    $article = Article::find($id);
    if ($article == null) {
        abort(404);
    } else {
        return view('article', ['article' => $article]);
    }
});

Route::get('/category', function() {
    if ($_GET['term'] != null) {
        return getCategoryViewFromSlug(getSlugFromName($_GET['term']));
    } else {
        abort(404);
    }
});

Route::get('/category/{slug}', function($slug) {
    return getCategoryViewFromSlug($slug);
});

Route::get('/tag', function() {
    if ($_GET['term'] != null) {
        return getTagViewFromSlug(getSlugFromName($_GET['term']));
    } else {
        abort(404);
    }
});

Route::get('/tag/{slug}', function($slug) {
    return getTagViewFromSlug($slug);
});

Route::get('/search', function() {
    return view('search');
});

Route::get('/privacy', function() {
    return view('privacy');
});

Route::get('/terms', function() {
    return view('terms');
});

Route::get('/login', function(){
    return view('login');
});

Route::get('/register', function(){
    return view('register');
});

Route::get('/admin/{mode?}/{id?}', function(?string $mode = null, ?string $id = null){

    $data = [
        'mode' => $mode,
        'id' => $id
    ];


    if ($mode == 'articles') {
        if ($id != null) {
            $data['articleToEdit'] = Article::find($id);
        } else {
            $data['allArticles'] = Article::all();
        }
    }

    return view('admin', $data);
});

require __DIR__.'/auth.php';
