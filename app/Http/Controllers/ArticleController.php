<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Article;

class ArticleController extends Controller
{
    protected $rules = [
        'libelle'=>'required',
    ];

    protected $messages = [
        'required'=>'le champ :attribute a bien été enregistré'
    ];

    public function __construct()
    {
      $this->middleware('auth');
      Cart::destroy();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::listeArticles();
        $data = [
            'articles'=>$articles
        ];

        return view('article.index')->with($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'article'=>''
        ];
        return view('article.create')->with($data);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);
        $data = Article::getRequest($request);
        //dd($data);
        if( Article::getRequestVerifyLibelle($data['libelle']) ){
            return back()->with('danger','Cette Article de produit a déjà été enregistré');
        }
        Article::create($data);
        return redirect('article')->with('message','cette article a bien été enregistré');
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
        $article = Article::find($id);
        $data = [
            'article'=>$article
        ];  
        return view('article/edit')->with($data);
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
        $this->validate($request, $this->rules, $this->messages);
        $data = Article::getRequest($request);
        $article = Article::find($id);
        $article->update($data);
        return redirect('article')->with('message','Cet article de produit a  été modifiés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect('article')->with('message','cette famille a bien été supprimé');
    }
}
