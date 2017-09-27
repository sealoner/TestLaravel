<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
