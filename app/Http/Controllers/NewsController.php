<?php

namespace App\Http\Controllers;
use App\News;
use Auth;
use Redis;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         #$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $news = News::all();


        return view('list', ['news'=>$news, 'message'=>''] );

    }

    public function nedit(Request $request, $id)
    {



        if(!Auth::guest()) {

            $rec = News::find($id);
            if ($rec){

                $is_edited_by = Redis::get('id:'.$id);

                if (!$is_edited_by)   {
                    Redis::set('id:'.$id,' '.Auth::user()->name.' in '.date('Y-m-d h:m:s'));
                    return view('edit', ['rec' => $rec ]);
                }else {
                    return view('edit',['rec' => $rec, 'message'=>"Новость id:$id уже открыта на изменение   $is_edited_by "]);
                }


            }else{
                return redirect('/list');
            }

        }
    }

    public  function nnew(Request $request )
    {
        return view('edit', [ 'rec'=>'', 'action'=>'new' ] );

    }

    public  function searchform(Request $request )
    {



        return view('search' );

    }
   public  function search(Request $request )
    {
        if ($request->get('datepicker')=='')  {$dfrom='01/01/01';} else {  $dfrom= $request->get('datepicker');}
        if ($request->get('datepicker2')=='') {$dto='9999/01/01';} else { $dto= $request->get('datepicker2');}


        $news = News::where('created_at', '>=', $dfrom )
                    ->where('created_at', '<=', $dto  )
                    ->get();

        return view('list', ['news'=>$news,
            'message'=>'поиск по дате с '.$request->get('datepicker').' по: '. $request->get('datepicker2')

        ] );


    }

    public  function nadd(Request $request )
    {
        if(!Auth::guest()) {


            $this->validate($request, [
                'name' => 'required|max:255',
                'anons' => 'required|max:255',
                'content' => 'required',
            ]);


            $n = News::insert(
                [
                    'name' => $request->get('name')
                    , 'anons' => $request->get('anons')
                    , 'content' => $request->get('content')
                    , 'created_at' => 'now()'
                    , 'updated_at' => 'now()'


                ]
            );
        }
        return redirect('/list');



    }

    public  function nupdate(Request $request, $id)
    {
        if(!Auth::guest()) {

            $this->validate($request, [
                'name' => 'required|max:255',
                'anons' => 'required|max:255',
                'content' => 'required',
            ]);

            $n = News::find($id);
            $n->name = $request->get('name');
            $n->anons = $request->get('anons');
            $n->content = $request->get('content');
            $n->save();


            Redis::del('id:'.$id);
        }

        return redirect('/list');

    }

    public function ndel($id)
    {
        if(!Auth::guest()){
            $item = News::destroy($id);
        }
        return redirect('/list');

    }
}
