<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    /**
     * Creates a new article and redirects the user to the editing page for that new article.
     */
    private function newArticle() {
        $newArticle = Article::create([
            'title' => 'Untitled',
            'content' => '',
            'category_name' => Category::UNASSIGNED,
        ]);
        $newArticle->refresh();
        return $newArticle;
    }

    private function edit($input) {

        $id = $input['article-id'];
        $article = Article::find($id);

        //Check if a tag-article combination exists and insert it if not
        //Otherwise, do nothing because the third parameter is not specified.
        if (array_key_exists('add-tag', $input)) {
            DB::table('article_tag_joins')->upsert(
                ['article_id' => $id,
                 'tag_name' => $input['selected-tag'],
                 'created_at' => now(),
                 'updated_at' => now()],
                ['article_id', 'tag_name']
            );
        }

        //Delete the required article-tag combination.
        if (array_key_exists('delete-tag', $input)) {
            DB::table('article_tag_joins')->where([
                ['article_id', '=', $id],
                ['tag_name', '=', $input['selected-tag']]
            ])->delete();
        }

        if (array_key_exists('article-title', $input)) {
            $article->title = $input['article-title'];
        }
        if (array_key_exists('article-content', $input)) {
            $article->content = $input['article-content'];
        }
        if (array_key_exists('article-category', $input)) {
            $article->category_name = $input['article-category'];
        }

        if ($article->isDirty()) {
            $article->save();
        }


        return view('admin',
            [
                'mode' => 'articles',
                'id' => $id, 'articleToEdit' => $article,
                'allCategories' => Category::all(),
                'allTags' => Tag::all()
            ]
        );
    }

    private function delete(Request $request) {
        $input = $request->input();

        $articleToDelete = Article::find($input['article-id']);

        if ($articleToDelete) {

            //First delete references to any associated tags
            DB::table('article_tag_joins')->where('article_id', $articleToDelete->id)->delete();

            //Delete the article
            $articleToDelete->delete();
        }
    }

    public function update(Request $request) {
        $input = $request->input();

        switch ($input['action']) {
            case 'add':
                $newArticle = $this->newArticle($request);
                return redirect('/admin/articles/' . $newArticle->id);

            case 'edit':
                $this->edit($input);
                return redirect('/admin/articles/' . $input['article-id']);
            case 'delete':
                $this->delete($request);
                break;
        }

        $data = [
            'mode' => 'articles',
            'allCategories' => Category::all(),
            'allTags' => Tag::all(),
            'allArticles' => Article::all(),
            'id' => null
        ];

        return view('admin', $data);
    }
}
