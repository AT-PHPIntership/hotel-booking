<?php

namespace App\Http\ViewComposers;

use App\Model\StaticPage;
use Illuminate\View\View;

class StaticPageComposer
{
    /**
     * The StaticPage model implementation.
     *
     * @var staticPages StaticPage
     */
    protected $staticPages;

    /**
     * Create a new profile composer.
     *
     * @param StaticPage $staticPages static page instance
     */
    public function __construct(StaticPage $staticPages)
    {
        // Dependencies automatically resolved by service container...
        $this->staticPages = $staticPages;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view view app
     *
     * @return void
     */
    public function compose(View $view)
    {
        $columns = [
            'id',
            'slug',
            'title',
            'content'
        ];

        $view->with('staticPages', $this->staticPages->select($columns)->get());
    }
}
