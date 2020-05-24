<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Subscription;
use App\Mail\NewsSubscription;
use App\Http\Helpers;
use Illuminate\Support\Facades\Mail;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::where('news.is_show', 1)->get();

        $news_not = News::where('news.is_show', 0)->get();

        return view('admin.news.news', compact('news', 'news_not'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.edit-news');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'news_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('news_image')) {
            $result = Helpers::storeImg('news_image', 'image', $request);
        }

        $lang = "";
        foreach ($request->news_lang as $value) {
            $lang .= $value . ",";
        }

        $news = News::create([
            //Ru
            'news_name_ru' => $request->news_name_ru,
            'news_desc_ru' => $request->news_desc_ru,
            'news_meta_description_ru' => $request->news_meta_description_ru,
            'news_meta_keywords_ru' => $request->news_meta_keywords_ru,
            'tag_ru' => $request->tag_ru,
            //Kz
            'news_name_kz' => $request->news_name_kz,
            'news_desc_kz' => $request->news_desc_kz,
            'news_meta_description_kz' => $request->news_meta_description_kz,
            'news_meta_keywords_kz' => $request->news_meta_keywords_kz,
            'tag_kz' => $request->tag_kz,
            //En
            'news_name_en' => $request->news_name_en,
            'news_desc_en' => $request->news_desc_en,
            'news_meta_description_en' => $request->news_meta_description_en,
            'news_meta_keywords_en' => $request->news_meta_keywords_en,
            'tag_en' => $request->tag_en,

            'news_date' => $request->news_date,
            'news_lang' => $lang,
            'news_image' => $result,
            'author_id' => $request->author_id,
            'news_rubric_id' => $request->news_rubric_id,
            'is_show' => $request->is_show
        ]);

        $news->positions()->sync($request->news_position);

        $subscription = Subscription::where('subscription_status', 1)->get();
        foreach ($subscription as $value) {
            Mail::to($value->subscription_user_email)->send(new NewsSubscription($news));
        }

        return redirect("/admin/news");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.news.edit-news', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        if ($request->hasFile('news_image')) {
            $result = Helpers::storeImg('news_image', 'image', $request);
        } else {
            $result = $news->news_image;
        }

        $lang = "";
        foreach ($request->news_lang as $value) {
            $lang .= $value . ",";
        }

        $news->update([
            'news_name_ru' => $request->news_name_ru,
            'news_name_kz' => $request->news_name_kz,
            'news_name_en' => $request->news_name_en,
            'news_desc_ru' => $request->news_desc_ru,
            'news_desc_kz' => $request->news_desc_kz,
            'news_desc_en' => $request->news_desc_en,
            'news_image' => $result,
            'news_meta_description_ru' => $request->news_meta_description_ru,
            'news_meta_description_kz' => $request->news_meta_description_kz,
            'news_meta_description_en' => $request->news_meta_description_en,
            'news_meta_keywords_ru' => $request->news_meta_keywords_ru,
            'news_meta_keywords_kz' => $request->news_meta_keywords_kz,
            'news_meta_keywords_en' => $request->news_meta_keywords_en,
            'tag_ru' => $request->tag_ru,
            'tag_kz' => $request->tag_kz,
            'tag_en' => $request->tag_en,
            'news_date' => $request->news_date,
            'news_lang' => $lang,
            'author_id' => $request->author_id,
            'news_rubric_id' => $request->news_rubric_id,
            'is_show' => $request->is_show
        ]);

        $news->positions()->sync($request->news_position);

        return redirect("/admin/news");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
    }
}
