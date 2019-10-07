<?php

namespace App\Http\Controllers\Merch\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merch\ArticleConstructionDimension;
use App\Models\Merch\Supplier;
use App\Models\Merch\Article;
use App\Models\Merch\Construction;
use App\Models\Merch\Composition;

use Validator, DB, ACL;

class ArticleController extends Controller
{
    //Article Setup Form
    public function articleForm($supId = null){
        ACL::check(["permission" => "mr_setup"]);
        if($supId != null){

            $articleList= DB::table('mr_article AS a')
                            ->select(
                                'a.*',
                                DB::raw('CONCAT_WS(" - ", s.sup_name, c.cnt_name) AS sup_name')
                            )
                            ->leftJoin('mr_supplier AS s','s.sup_id', '=', 'a.mr_supplier_sup_id')
                            ->leftJoin('mr_country AS c', 'c.cnt_id', 's.cnt_id')
                            ->where('a.mr_supplier_sup_id','=',$supId)
                            ->get();

            $supplier= DB::table('mr_supplier')
                            ->leftJoin('mr_country', 'mr_country.cnt_id', 'mr_supplier.cnt_id')
                            ->pluck(DB::raw('CONCAT_WS(" - ", sup_name, cnt_name) AS sup_name'), 'sup_id');

        }else{

        $articleList= DB::table('mr_article AS a')
                   ->select(
                       'a.*',
                       DB::raw('CONCAT_WS(" - ", s.sup_name, c.cnt_name) AS sup_name'),
                       'con.construction_name',
                       'com.comp_name'
                      )
                   ->leftJoin('mr_supplier AS s','s.sup_id', '=', 'a.mr_supplier_sup_id')
                   ->leftJoin('mr_composition AS com', 'com.mr_article_id', 'a.id')
                   ->leftJoin('mr_construction AS con', 'con.mr_article_id', 'a.id')
                   ->leftJoin('mr_country AS c', 'c.cnt_id', 's.cnt_id')
                   ->get();

        $supplier= DB::table('mr_supplier')
                        ->leftJoin('mr_country', 'mr_country.cnt_id', 'mr_supplier.cnt_id')
                        ->pluck(DB::raw('CONCAT_WS(" - ", sup_name, cnt_name) AS sup_name'), 'sup_id');
      }
    	return view('merch/setup/article', compact('supplier','articleList','compositionList','constructionList','supId'));
    }
    public function articleStore(Request $request){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
    	$validator= Validator::make($request->all(), [
            "supplier"         => "required|max:11",
            "art_name"         =>"required",
    		"composition"      => "max:145",
    		"art_construction" => "max:145"
    	]);

    	if($validator->fails()){
    		return back()
    			->withInput()
    			->with('error', "Incorrect Input!!");
    	}
    	else{
            $data_ar  = new Article();
    		$data_cons= new Construction();
            $data_coms= new Composition();
            $data_ar->art_name             = $request->art_name ;
            $data_ar->mr_supplier_sup_id   = $request->supplier ;
            $data_ar->save();

            $article_id= $data_ar->id;
           if($request->art_construction!=null){
          		$data_cons->construction_name  = $request->art_construction ;
          		$data_cons->mr_supplier_sup_id = $request->supplier ;
                  $data_cons->mr_article_id = $article_id ;
                  $data_cons->save();
           }
           else{
              $data_cons->construction_name  = null ;
              $data_cons->mr_supplier_sup_id = $request->supplier ;
                  $data_cons->mr_article_id = $article_id ;
                  $data_cons->save();
           }

           if($request->composition!= null){
              $data_coms->comp_name          = $request->composition ;
              $data_coms->mr_supplier_sup_id = $request->supplier ;
              $data_coms->mr_article_id = $article_id ;
              $data_coms->save();
           }
           else{
              $data_coms->comp_name          = null;
              $data_coms->mr_supplier_sup_id = $request->supplier ;
              $data_coms->mr_article_id = $article_id ;
              $data_coms->save();
           }

    	 if($data_ar->save()){
    			return back()
    				->with('success', "Saved successfully!!");
    		}
    	 else{
    			return back()
    			->withInput()
    			->with('error', "Error saving data!!");
    		}
    	}
    }
    public function articleDelete($art_id){

      
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
    	Article::where('id', $art_id)->delete();
        Composition::where('mr_article_id', $art_id)->delete();
        Construction::where('mr_article_id', $art_id)->delete();
    	return back()
    		->with('success', "Article deleted successfully!!");
    }

  public function compositionDelete($com_id){

      
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
        
        Composition::where('id', $com_id)->delete();
      return back()
        ->with('success', "Composition deleted successfully!!");
    }

  public function constructionDelete($cons_id){

      
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
       
        Construction::where('id', $cons_id)->delete();
      return back()
        ->with('success', " Construction  deleted successfully!!");
    }  

    public function articleEdit($type,$id){
      ACL::check(["permission" => "mr_setup"]);
      #---------------------------------------------------------------#
      $supplier= Supplier::pluck('sup_name', 'sup_id');
        if($type==1){

          $articleList= DB::table('mr_article AS a')
                        ->where('a.id', $id)
                        ->select(
                           'a.*',
                           's.sup_name',
                           'con.construction_name',
                           'com.comp_name'
                          )
                        ->leftJoin('mr_supplier AS s','s.sup_id', '=', 'a.mr_supplier_sup_id')
                        ->leftJoin('mr_composition AS com', 'com.mr_article_id', 'a.id')
                        ->leftJoin('mr_construction AS con', 'con.mr_article_id', 'a.id')
                        ->first();
                    return view('merch/setup/article_edit', compact('articleList','supplier','type'));
        }

        if($type==2){
          $articleList= DB::table('mr_composition AS com')
                        ->select(
                            'com.*',
                            's.sup_name'
                        )
                        ->leftJoin('mr_supplier AS s','s.sup_id', '=', 'com.mr_supplier_sup_id')
                        ->where('id', $id)
                        ->first();
                    return view('merch/setup/article_edit', compact('articleList','supplier','type'));
        }

        if($type==3){
          $articleList= DB::table('mr_construction AS mc')
                        ->select(
                            'mc.*',
                            's.sup_name'
                        )
                        ->leftJoin('mr_supplier AS s','s.sup_id', '=', 'mc.mr_supplier_sup_id')
                        ->where('id', $id)
                        ->first();
                    return view('merch/setup/article_edit', compact('articleList','supplier','type'));
        }
    }

    public function articleUpdate(Request $request){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
        $validator= Validator::make($request->all(), [
            "supplier"           => "required",
            "art_name"           => "required"
        ]);

        if($validator->fails()){
            return back()
                ->withInput()
                ->with('error', "Incorrect Input!!");
        }
        else{
          if($request->typeval==1){

            Article::where('id', $request->art_id)
                    ->update([
                        'art_name' => $request->art_name
                    ]);

            Composition::where('mr_article_id', $request->art_id)
                        ->update([
                            'comp_name' => $request->composition
                        ]);

            Construction::where('mr_article_id', $request->art_id)
                        ->update([
                            'construction_name' => $request->art_construction
                        ]);
         }

          if($request->typeval==2){
            Composition::where('id', $request->art_id)
            ->update([
                'comp_name' => $request->composition
            ]);
           }

          if($request->typeval==3){
            Construction::where('id', $request->art_id)
            ->update([
                'construction_name' => $request->art_construction
            ]);

           }

           return redirect('merch/setup/article')
                ->with('success', "Updated successfully!!");
        }
    }

    public function getSizeByItem(Request $request){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
        if($request->matitem_id){
    		$sizeList= MaterialSize::where('matitem_id', $request->matitem_id)
    					->pluck('sz_name', 'sz_id');
    		$data= "";
    		foreach ($sizeList as $key => $sizeName) {
    			$data.= "<option value=\"$key\">$sizeName</option>";
    		}
    		if(!empty($data)){
    			return $data;
    		}
    	}
    	return "<option value=\"\">No Size Available!</option>";
    }

    public function getArticleBySupplier(Request $request){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
        if($request->sup_id){
            $artList= Article::where('mr_supplier_sup_id', $request->sup_id)
                        ->pluck('art_name', 'id');
            $data= "<option value=\"\">Select Article</option>";
            foreach ($artList as $key => $sizeName) {
                $data.= "<option value=\"$key\">$sizeName</option>";
            }
            if(!empty($data)){
                return $data;
            }
        }
        return "<option value=\"\">No Article Available!</option>";
    }

    public function getCompByArticle(Request $request){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
        if($request->art_id){
            $artList= Composition::where('mr_article_id', $request->art_id)
                        ->pluck('comp_name', 'id');
            $data= "<option value=\"\">Select Composition</option>";
            foreach ($artList as $key => $comName) {
                $data.= "<option value=\"$key\">$comName</option>";
            }
            if(!empty($data)){
                return $data;
            }
        }
        return "<option value=\"\">No Composition Available!</option>";
    }

    public function addNewByArticle(Request $request){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#
       //dd($request->all());
        if($request->art_name && $request->sup_id){
            $data= new article();
            $data->art_name            = $request->art_name ;
            $data->mr_supplier_sup_id  = $request->sup_id;
            $data->save();

            $artList= Article::where('mr_supplier_sup_id', $request->sup_id)
                        ->pluck('art_name', 'id');
            $data= "<option value=\"\">Select Article</option>";
            foreach ($artList as $key => $sizeName) {
                $data.= "<option value=\"$key\">$sizeName</option>";
            }
            if(!empty($data)){
                return $data;
            }
        }
       return "<option value=\"\">No Article Available!</option>";
    }

    public function addNewComposition(Request $request){
        ACL::check(["permission" => "mr_setup"]);
        #-----------------------------------------------------------#

        if($request->comst_name && $request->art_id){
            $data= new Composition();
            $data->comp_name          = $request->comst_name ;
            $data->mr_article_id      = $request->art_id;
            $data->save();

            $const= Composition::where('mr_article_id', $request->art_id)
                        ->pluck('comp_name', 'id');
            $data= "<option value=\"\">Select Composition</option>";
            foreach ($const as $key => $comName) {
                $data.= "<option value=\"$key\">$comName</option>";
            }
            if(!empty($data)){
                return $data;
            }
        }
       return "<option value=\"\">No Composition Available!</option>";
    }
}
