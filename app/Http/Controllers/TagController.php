<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{

    private function createTag(Request $request) {
        $input = $request->input();

        if (!Tag::find($input['new-tag-name'])) {
            Tag::create(['name' => $input['new-tag-name']]);
        }
    }

    private function deleteTag(Request $request) {
        $input = $request->input();

        $tagToDelete = Tag::find($input['tag-to-delete']);

        //First delete all existing associations with articles
        DB::table('article_tag_joins')->where('tag_name', $tagToDelete->name)->delete();

        //Then delete the tag
        $tagToDelete->delete();
    }

    public function update( Request $request) {
        $input = $request->input();

        if ($input['action'] == 'add') {
            $this->createTag($request);
        }

        if ($input['action'] == 'delete') {
            $this->deleteTag($request);
        }

        $data = [
            'allTags' => Tag::all(),
            'mode' => 'tags',
        ];

        return view('admin', $data);
    }

}
