<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class TagList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $articleId)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $tags = DB::table('article_tag_joins')->where('article_id', '=', $this->articleId)->get();
        return view('components.tag-list', ['tags' => $tags]);
    }
}
