<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RequestArticle;
use App\Models\Article;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class AdminArticleController extends Controller
{

    public function index()
    {
        $articles = Article::all();
        return view('admin.article.index',compact('articles'));
    }


    public function create()
    {
       
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $requestArticle)
    {
        $this->insertOrUpdate($requestArticle);
        return redirect()->back()->with('success','Thêm mới thành công');
    }
  
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        
        $article = Article::find($id);
        
        return view('admin.article.update',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $requestArticle, $id)
    {
        $this->insertOrUpdate($requestArticle,$id);
        return redirect()->back()->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function insertOrUpdate($requestArticle,$id = '')
    {   
        $article= new Article();
        if($id) $article= Article::find($id);
        $article->a_name = $requestArticle->a_name;
        $article->a_slug = Str::slug($requestArticle->a_name);
        $article->a_content = $requestArticle->a_content;
        $article->a_title_seo = $requestArticle->a_title_seo;
        $article->a_description =  $requestArticle->a_description;

        if($requestArticle->hasFile('avatar'))
        {
            if($id!=''){
                $unlink= 'uploads/article/'.$article->a_avatar;
                unlink($unlink);
            }
            $name = date("y-m-d-h-m-s", time()) .'_'. $requestArticle->avatar->getClientOriginalName();
            $requestArticle->avatar->move(public_path().'/uploads/article', $name);
            //save image
            $article->a_avatar = $name;
        }

        $article->save();
    }
    public function action($action,$id)
    {
        if($action)
        {
            $article = Article::find($id);
            switch ($action)
            {
                case 'delete':
                    if($article->a_avatar){
                        $unlink= 'uploads/article/'.$article->a_avatar;
                        unlink($unlink);
                    }
                    $article->delete();
                    $messages= 'Xóa thành công';                  
                    break;
                case 'active':
                    $article->a_active = $article->a_active ? 0 : 1;
                    $article->save();
                    $messages= 'Cập nhật thành công';
                    break;
                case 'hot':
                    $article->a_hot = $article->a_hot ? 0 : 1;
                    $article->save();
                    $messages= 'Cập nhật thành công';
                    break;
            }

        }
        return redirect()->back()->with('success','Cập nhật thành công');
    }
}
