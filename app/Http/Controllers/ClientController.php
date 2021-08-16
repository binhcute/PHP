<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Portfolio;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_hot = Product::queryStatusOne()
            ->orderBy('product_price', 'desc')->limit(4)->get();
        $product_new = Product::queryStatusOne()
            ->orderBy('created_at', 'desc')->limit(4)->get();
        $cate = Category::queryStatusOne()->get();
        return view('pages.client.index')
            ->with('product_hot', $product_hot)
            ->with('product_new', $product_new)
            ->with('cate', $cate);
    }
    public function product()
    {
        $product = Product::queryStatusOne()
            ->orderBy('product_id', 'asc')->get();
        $product_hot = Product::queryStatusOne()
            ->orderBy('product_price', 'desc')->limit(6)->get();
        $product_new = Product::queryStatusOne()
            ->orderBy('created_at', 'desc')->limit(6)->get();
        $product_cate = Category::queryStatusOne()->get();
        $portfolio = Portfolio::queryStatusOne()->get();

        return view('pages.client.productlist')
            ->with('product', $product)
            ->with('product_cate', $product_cate)
            ->with('product_hot', $product_hot)
            ->with('product_new', $product_new)
            ->with('portfolio', $portfolio);
    }
    public function product_detail($id)
    {

        $product_detail = DB::table('tpl_product')
            ->join('tpl_portfolio', 'tpl_portfolio.port_id', 'tpl_product.port_id')
            ->join('tpl_category', 'tpl_category.cate_id', '=', 'tpl_product.cate_id')
            ->where('tpl_product.product_id', $id)->first();
        $product_relate = DB::table('tpl_product')
            ->join('tpl_portfolio', 'tpl_portfolio.port_id', 'tpl_product.port_id')
            ->join('tpl_category', 'tpl_category.cate_id', '=', 'tpl_product.cate_id')
            ->where('tpl_product.product_id', $id)->get();
        foreach ($product_relate as $key => $value) {
            $cate_id = $value->cate_id;
        }
        $list = Product::queryStatusOne()
            ->join('tpl_category', 'tpl_category.cate_id', '=', 'tpl_product.cate_id')
            ->where('tpl_category.cate_id', $cate_id)
            ->whereNotIn('tpl_product.product_id', [$id])
            ->get();
        $comment = DB::table('tpl_comment')
            ->select(
                'tpl_comment.comment_description',
                'tpl_comment.rate',
                'tpl_comment.updated_at',
                'users.avatar',
                'users.firstName',
                'users.lastName'
            )
            ->join('users', 'users.id', '=', 'tpl_comment.user_id')
            ->where('tpl_comment.status', 1)
            ->where('tpl_comment.product_id', $id)->get();
        $avg_stars = DB::table('tpl_comment')
            ->where('tpl_comment.product_id', $id)
            ->avg('rate');
        return view('pages.client.productdetail')
            ->with('list', $list)
            ->with('product_detail', $product_detail)
            ->with('comment', $comment)
            ->with('avg_stars', $avg_stars);
    }

    //Article

    public function article()
    {
        $article = Article::queryStatusOne()->orderBy('created_at', 'desc')->paginate(6);
        $product_cate = Category::queryStatusOne()->get();
        return view('pages.client.articlelist')
            ->with('article', $article)
            ->with('product_cate', $product_cate);
    }
    public function article_detail($id)
    {
        $article = DB::table('tpl_article')
            ->join('users', 'users.id', '=', 'tpl_article.user_id')
            ->where('tpl_article.article_id', $id)->first();
        $related = DB::table('tpl_article')->inRandomOrder()->limit(2)->get();
        $comment = DB::table('tpl_comment')
            ->select(
                'tpl_comment.comment_description',
                'tpl_comment.updated_at',
                'users.avatar',
                'users.firstName',
                'users.lastName'
            )
            ->join('users', 'users.id', '=', 'tpl_comment.user_id')
            ->where('tpl_comment.status', 1)
            ->where('tpl_comment.article_id', $id)->get();
        $recent = Article::queryStatusOne()
            ->orderBy('created_at', 'desc')->limit(3)->get();
        $cate = Category::queryStatusOne()
            ->orderBy('created_at', 'desc')->limit(3)->get();

        return view('pages.client.articledetail')
            ->with('article', $article)
            ->with('related', $related)
            ->with('comment', $comment)
            ->with('recent', $recent)
            ->with('cate', $cate);
    }

    //Category

    public function categories_detail()
    {
        $categories = Category::queryStatusOne()->get();
        // dd($categories);
        return view('pages.client.categoriesdetail')->with('categories', $categories);
    }


    public function categories_list($id)
    {
        $product_cate = Category::queryStatusOne()->get();
        $portfolio = Portfolio::queryStatusOne()->get();
        $categories = Category::find($id);
        $product_by_category = Product::queryStatusOne()
            ->join('tpl_category', 'tpl_category.cate_id', '=', 'tpl_product.cate_id')
            ->where('tpl_category.cate_id', $id)->get();
        return view('pages.client.categorieslist')
            ->with('categories', $categories)
            ->with('portfolio', $portfolio)
            ->with('product_cate', $product_cate)
            ->with('product_by_category', $product_by_category);
    }

    //Brand

    public function portfolio_detail()
    {
        $portfolio = Portfolio::queryStatusOne()->get();
        return view('pages.client.portfoliodetail')->with('portfolio', $portfolio);
    }

    public function portfolio_list($id)
    {
        $product_cate = Category::queryStatusOne()->get();
        $portfolio = Portfolio::queryStatusOne()->get();
        $port = Portfolio::find($id);
        $product_by_portfolio = Product::queryStatusOne()
            ->join('tpl_portfolio', 'tpl_portfolio.port_id', '=', 'tpl_product.port_id')
            ->where('tpl_portfolio.port_id', $id)->get();
        return view('pages.client.portfoliolist')
            ->with('port', $port)
            ->with('portfolio', $portfolio)
            ->with('product_cate', $product_cate)
            ->with('product_by_portfolio', $product_by_portfolio);
    }

    public function cart()
    {
        return view('pages.client.cart');
    }
    public function check_out()
    {
        return view('pages.client.checkout');
    }
    public function contact_us()
    {
        return view('pages.client.contactus');
    }
    public function favorite()
    {
        return view('pages.client.favorite');
    }
    public function my_account()
    {
        return view('pages.client.myaccount');
    }

    public function about_us()
    {
        return view('pages.client.aboutUs');
    }
    public function search(request $request)
    {
        $key = $request->key;

        $product = DB::table('tpl_product')
            ->where('product_name','like',$key);
    }
}
