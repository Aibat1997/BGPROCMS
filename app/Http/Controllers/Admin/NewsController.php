<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;
use App\Models\Subscription;
use App\Models\NewsPosition;
use App\Mail\NewsSubscription;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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
        $news = News::where('news.is_show',1)
                    ->leftJoin('rubrics','rubrics.rubric_id','=','news.news_rubric_id')
                    ->select('news.*', 'rubrics.rubric_name_ru')
                    ->get();

        $news_not = News::where('news.is_show',0)
                    ->leftJoin('rubrics','rubrics.rubric_id','=','news.news_rubric_id')
                    ->select('news.*', 'rubrics.rubric_name_ru')
                    ->get();            
                    
        return view('admin.news.news', compact('news','news_not'));
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
            'news_image_ru' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'news_image_kz' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'news_image_en' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('news_image_ru')) {
            $result_ru = $this->storeImg('news_image_ru', $request);
        }
        if ($request->hasFile('news_image_kz')) {
            $result_kz = $this->storeImg('news_image_kz', $request);
        }
        else {
            $result_kz = $result_ru;
        }
        if ($request->hasFile('news_image_en')) {
            $result_en = $this->storeImg('news_image_en', $request);
        }
        else {
            $result_en = $result_ru;
        }
        
        $lang="";
        foreach ($request->news_lang as $value) {
            $lang .= $value.",";
        }

        $news = new News();
        //Ru
        $news->news_name_ru = $request->news_name_ru;
        $news->news_short_desc_ru = $request->news_short_desc_ru;
        $news->news_desc_ru = $request->news_desc_ru;
        $news->news_meta_description_ru = $request->news_meta_description_ru;
        $news->news_meta_keywords_ru = $request->news_meta_keywords_ru;
        $news->tag_ru = $request->tag_ru;
        $news->news_image_ru = $result_ru;
        //Kz
        $news->news_name_kz = (!empty($request->news_name_kz)) ? $request->news_name_kz : $request->news_name_ru;
        $news->news_short_desc_kz = (!empty($request->news_short_desc_kz)) ? $request->news_short_desc_kz : $request->news_short_desc_ru; 
        $news->news_desc_kz = (!empty($request->news_desc_kz)) ? $request->news_desc_kz : $request->news_desc_ru;
        $news->news_meta_description_kz = (!empty($request->news_meta_description_kz)) ? $request->news_meta_description_kz : $request->news_meta_description_ru;
        $news->news_meta_keywords_kz = (!empty($request->news_meta_keywords_kz)) ? $request->news_meta_keywords_kz : $request->news_meta_keywords_ru;
        $news->tag_kz = (!empty($request->tag_kz)) ? $request->tag_kz : $request->tag_ru;
        $news->news_image_kz = $result_kz;
        //En
        $news->news_name_en = (!empty($request->news_name_en)) ? $request->news_name_en : $request->news_name_ru;
        $news->news_short_desc_en = (!empty($request->news_short_desc_en)) ? $request->news_short_desc_en : $request->news_short_desc_ru; 
        $news->news_desc_en = (!empty($request->news_desc_en)) ? $request->news_desc_en : $request->news_desc_ru;
        $news->news_meta_description_en = (!empty($request->news_meta_description_en)) ? $request->news_meta_description_en : $request->news_meta_description_ru;
        $news->news_meta_keywords_en = (!empty($request->news_meta_keywords_en)) ? $request->news_meta_keywords_en : $request->news_meta_keywords_ru;
        $news->tag_en = (!empty($request->tag_en)) ? $request->tag_en : $request->tag_ru;
        $news->news_image_en = $result_en;

        $news->news_date = $request->news_date;
        $news->news_lang = $lang;
        $news->author_id = $request->author_id;
        $news->news_rubric_id = $request->news_rubric_id;
        $news->is_show = $request->is_show;
        $news->save();

        foreach ($request->news_position as $value) {
            $news_position = new NewsPosition();
            $news_position->np_news_id = $news->news_id;
            $news_position->np_position_id = $value;
            $news_position->save();
        }

        $subscription = Subscription::where('subscription_status',1)->get();
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
    public function edit($id)
    {
        $news = News::where('news_id', $id)
        ->leftJoin('news_positions','news_positions.np_news_id','=','news.news_id')
        ->first();
        
        return view('admin.news.edit-news', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'news_image_ru' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'news_image_kz' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'news_image_en' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $news = News::find($id);

        if ($request->hasFile('news_image_ru')) {
            $result_ru = $this->storeImg('news_image_ru', $request);
        }else {
            $result_ru = $news->news_image_ru;
        }
        if ($request->hasFile('news_image_kz')) {
            $result_kz = $this->storeImg('news_image_kz', $request);
        }else {
            $result_kz = $news->news_image_kz;
        }
        if ($request->hasFile('news_image_en')) {
            $result_en = $this->storeImg('news_image_en', $request);
        }else {
            $result_en = $news->news_image_en;
        }

        News::where('news_id', $id)
                ->update([
                    'news_name_ru' => $request->news_name_ru,
                    'news_name_kz' => $request->news_name_kz,
                    'news_name_en' => $request->news_name_en,
                    'news_short_desc_ru' => $request->news_short_desc_ru,
                    'news_short_desc_kz' => $request->news_short_desc_kz,
                    'news_short_desc_en' => $request->news_short_desc_en,
                    'news_desc_ru' => $request->news_desc_ru,
                    'news_desc_kz' => $request->news_desc_kz,
                    'news_desc_en' => $request->news_desc_en,
                    'news_image_ru' => $result_ru,
                    'news_image_kz' => $result_kz,
                    'news_image_en' => $result_en,
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
                    'news_lang' => $request->news_lang,
                    'author_id' => $request->author_id,
                    'news_rubric_id' => $request->news_rubric_id,
                    'is_show' => $request->is_show
                    ]);

        foreach ($request->news_position as $value) {
            $news_pos = NewsPosition::where('np_news_id', $id)
            ->where('np_position_id', $value)
            ->first();

            if (empty($news_pos)) {
                $news_position = new NewsPosition();
                $news_position->np_news_id = $id;
                $news_position->np_position_id = $value;
                $news_position->save();                
            }            
        }

        return redirect("/admin/news");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete(); 
    }

    public function storeImg($name, $request)
    {
        $image = $request->file($name);
        $image_name = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $destinationPath = $request->disk . '/' . date('Y') . '/' . date('m') . '/' . date('d');
        $image_name = $destinationPath . '/' . $image_name;

        if (Storage::disk('image')->exists($image_name)) {
            $now = \DateTime::createFromFormat('U.u', microtime(true));
            $file_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
        }

        Storage::disk('image')->put($image_name, File::get($image));
        $result = '/media' .$image_name;
        return $result;
    }
}
