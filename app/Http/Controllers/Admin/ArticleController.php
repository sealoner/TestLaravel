<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ArticleController extends Controller
{
    public function index() {
        //获取数据库里的文章
        return view('admin/article/index')->withArticles(Article::all());
    }
    //新增文章
    public function create() {
        return view('admin/article/create');
    }
    //编辑文章
    public function edit($id) {
        return view('admin/article/edit')->withArticles(Article::find($id));
    }

    //获取提交的数据
    public function store(Request $request) {
        //调用laravel自带的验证机制
        $this->validate($request,[
           'title'  =>  'required|unique:articles|max:255',
            'body'  =>  'required',
        ]);
        //初始化Article对象
        $article = new Article;
        //验证标题是否符合规范
        $article->title   = $request->get('title');
        //验证主体内容是否符合规范
        $article->body    = $request->get('body');
        //获取当前 Auth 系统中注册的用户，并将其 id 赋给 article 的 user_id 属性
        $article->user_id = $request->user()->id;
        //判断数据库存储状态
        if($article->save()) {
            return redirect('admin/article');
        }else{
            return redirect()->back()->withInput()->withErrors('参数错误，保存失败.');
        }
    }

    //更新文章
    //将Request实例注入控制器方法中，会获取前台视图中提交的表单数据，这些数据会放在request数组中，如要获取数据，则直接调用对应的数组下标
    public function update(Request $request, $id) {
        //根据文章的id
        //对获取到的数据进行校验
        $this->validate($request,[
            'title'  =>  'required|unique:articles|max:255',
            'body'   =>  'required',
        ]);
        //从数据库中获取对应id的数据,存入article数组中
        $article = Article::find($id);
        $article->title = $request->get('title');
        $article->body  = $request->get('body');
        //判断值的更新状态
        if($article->save()) {
            return redirect('admin/article');
        }else{
            return redirect()->back()->withInput()->withErrors('参数错误，无法更新');
        }
    }
    //删除文章
    public function destroy($id) {
        Article::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功');
    }
}
