<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Backend\StaticPageRequest;
use App\Http\Controllers\Controller;
use App\Model\StaticPage;

class StaticPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staticPages = StaticPage::select('id', 'title', 'content')
            ->orderby('id', 'DESC')
            ->paginate(StaticPage::ROW_LIMIT);
        return view('backend.static_pages.index', compact('staticPages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id call static page
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staticPage = StaticPage::select('id', 'title', 'content')
            ->findOrFail($id);
         return view('backend.static_pages.edit', compact('staticPage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StaticPageRequest $request add event
     * @param int               $id      call static page
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StaticPageRequest $request, $id)
    {
        $staticPage = StaticPage::findOrFail($id);
        $requests = $request->all();
        if ($staticPage->update($requests)) {
            flash(__('Update Success'))->success();
            return redirect()->route('static-page.index');
        } else {
            flash(__('Update Fail'))->error();
            return redirect()->back()->withInput();
        }
    }
}
