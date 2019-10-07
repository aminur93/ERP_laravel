<?php

namespace App\Http\Controllers\Hr\ServiceBook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Hr\GrievanceIssue; 
use App\Models\Hr\GrievanceAppeal;
use App\Models\Hr\ServiceBook;
use Auth, DB, Validator, Image, DataTables, ACL; 


class ServiceBookController extends Controller
{
	public function showForm()
    {    
        ACL::check(["permission" => "hr_ess_grievance_appeal"]);
        #-----------------------------------------------------------# 

    	$issueList = GrievanceIssue::where('hr_griv_issue_status', '1')
    				->pluck('hr_griv_issue_name', 'hr_griv_issue_id'); 
        $sbooklist=ServiceBook::get();

    	return view('hr/ess/service_book', compact('issueList','sbooklist'));
    }
    public function servicebookPage(Request $request){


          $sbook=ServiceBook::where('hr_associate_id', $request->associate_id)->first();
         

          if(empty($sbook)){ 
            ///Insert Form
                $list = "<div class=\"form-group\">
                           <label class=\"col-sm-4 control-label no-padding-right\" for=\"page1\">Page 1 :<span style=\"color: red\">&#42;</span><br/><span style=\"font-size: 10px\">(pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb)</span></label>
                          <div class=\"col-sm-8\">
                               
                               <input type=\"file\" class=\"form-control\" name=\"page1\" data-validation=\"mime size required\"data-validation-allowing=\"docx,doc,pdf,jpeg,png,jpg\" data-validation-max-size=\"512kb\"
                                data-validation-error-msg-size=\"You can not upload images larger than 512kb\" data-validation-error-msg-mime=\"You can only upload docx, doc, pdf, jpeg, jpg or png type file\" style=\"border: 0px;\" >
                            </div>
                        </div>
                        <div class=\"form-group\">
                           <label class=\"col-sm-4 control-label no-padding-right\" for=\"page2\">Page 2 : <br/><span style=\"font-size: 10px\">(pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </span> </label>
                          <div class=\"col-sm-8\">
                                <input type=\"file\" class=\"form-control\" name=\"page2\" data-validation=\"mime size\" data-validation-allowing=\"docx,doc,pdf,jpeg,png,jpg\" data-validation-max-size=\"512kb\"
                                data-validation-error-msg-size=\"You can not upload images larger than 512kb\" data-validation-error-msg-mime=\"You can only upload docx, doc, pdf, jpeg, jpg or png type file\" style=\"border: 0px;\">
                              </div>
                        </div>
                        <div class=\"form-group\">
                           <label class=\"col-sm-4 control-label no-padding-right\" for=\"page3\">Page 3 : <br/><span style=\"font-size: 10px\">(pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </span> </label>
                          <div class=\"col-sm-8\">
                                <input type=\"file\" id=\"inp_page3\" class=\"form-control\" name=\"page3\" data-validation=\"mime size\" data-validation-allowing=\"docx,doc,pdf,jpeg,png,jpg\" data-validation-max-size=\"512kb\"
                                data-validation-error-msg-size=\"You can not upload images larger than 512kb\" data-validation-error-msg-mime=\"You can only upload docx, doc, pdf, jpeg, jpg or png type file\" style=\"border: 0px;\" >
                          </div>
                        </div>
                        <div class=\"form-group\">
                           <label class=\"col-sm-4 control-label no-padding-right\" for=\"page4\">Page 4 :<br/> <span style=\"font-size: 10px\">(pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </span> </label>
                          <div class=\"col-sm-8\">
                                <input type=\"file\" class=\"form-control\" name=\"page4\" data-validation=\"mime size\" data-validation-allowing=\"docx,doc,pdf,jpeg,png,jpg\" data-validation-max-size=\"512kb\"
                                data-validation-error-msg-size=\"You can not upload images larger than 512kb\" data-validation-error-msg-mime=\"You can only upload docx, doc, pdf, jpeg, jpg or png type file\" style=\"border: 0px;\"> 
                          </div>
                        </div>
                        <div class=\"form-group\">
                           <label class=\"col-sm-4 control-label no-padding-right\" for=\"page5\">Page 5 :<br/> <span style=\"font-size: 10px\">(pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </span> </label>
                          <div class=\"col-sm-8\">
                                <input type=\"file\" class=\"form-control\" name=\"page5\" data-validation=\"mime size\" data-validation-allowing=\"docx,doc,pdf,jpeg,png,jpg\" data-validation-max-size=\"512kb\"
                                data-validation-error-msg-size=\"You can not upload images larger than 512kb\" data-validation-error-msg-mime=\"You can only upload docx, doc, pdf, jpeg, jpg or png type file\" style=\"border: 0px;\"> 
                          </div>
                        </div>
                        <div class=\"form-group\">
                           <label class=\"col-sm-4 control-label no-padding-right\" for=\"page6\">Page 6 :<br/> <span style=\"font-size: 10px\">(pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </span> </label>
                          <div class=\"col-sm-8\">
                                <input type=\"file\" class=\"form-control\" name=\"page6\" data-validation=\"mime size\" data-validation-allowing=\"docx,doc,pdf,jpeg,png,jpg\" data-validation-max-size=\"512kb\"
                                data-validation-error-msg-size=\"You can not upload images larger than 512kb\" data-validation-error-msg-mime=\"You can only upload docx, doc, pdf, jpeg, jpg or png type file\" style=\"border: 0px;\"> 
                          </div>
                        </div>

 
                       <div class=\"form-group\">
                           <label class=\"col-sm-4 control-label no-padding-right\" for=\"page7\">Page 7 :<br/> <span style=\"font-size: 10px\">(pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </span> </label>
                          <div class=\"col-sm-8\">
                                <input type=\"file\" class=\"form-control\" name=\"page7\" data-validation=\"mime size\" data-validation-allowing=\"docx,doc,pdf,jpeg,png,jpg\" data-validation-max-size=\"512kb\"
                                data-validation-error-msg-size=\"You can not upload images larger than 512kb\" data-validation-error-msg-mime=\"You can only upload docx, doc, pdf, jpeg, jpg or png type file\" style=\"border: 0px;\"> 
                          </div>
                        </div> 
                        <input type=\"hidden\" name=\"store\" value=\"store\"> 
                        ";
                    }

        else { ///Update form

          $url=asset('');
          if ($sbook->page1_url){$url1 = asset($sbook->page1_url);}
          else $url1='No file available!';

          if ($sbook->page2_url){$url2 = asset($sbook->page2_url);}
          else $url2='No file available!';

          if ($sbook->page3_url){$url3 = asset($sbook->page3_url);}
          else $url3='No file available!';

          if ($sbook->page4_url){$url4 = asset($sbook->page4_url);}
          else $url4='No file available!';

          if ($sbook->page5_url){$url5 = asset($sbook->page5_url);}
          else $url5='No file available!';

          if ($sbook->page6_url){$url6 = asset($sbook->page6_url);}
          else $url6='No file available!';

          if ($sbook->page7_url){$url7 = asset($sbook->page7_url);}
          else $url7='No file available!';
               $list ="<div class=\"form-group\">
                           <label class=\"col-sm-4 control-label no-padding-right\" for=\"page1\">Page 1 :<span style=\"color: red\">&#42;</span><br/> <span style=\"font-size: 10px\">(pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </span> </label>
                          <div class=\"col-sm-5\">
                               <input type=\"file\" class=\"form-control\" name=\"page1\" data-validation=\"mime size\"data-validation-allowing=\"docx,doc,pdf,jpeg,png,jpg\" data-validation-max-size=\"512kb\"
                                data-validation-error-msg-size=\"You can not upload images larger than 512kb\" data-validation-error-msg-mime=\"You can only upload docx, doc, pdf, jpeg, jpg or png type file\" style=\"border: 0px;\" >
                            </div>
                              <strong class='text-success'>".basename($url1)."</strong>
                             <a href=\"$url1\" class=\"btn btn-xs btn-primary\" target=\"_blank\" title=\"View\"><i class=\"fa fa-eye\"></i> </a>
                            <a href=\"$url1\" class=\"btn btn-xs btn-success\" target=\"_blank\" download title=\"Download\"><i class=\"fa fa-download\"></i> </a>
                        </div>
                        <div class=\"form-group\">
                           <label class=\"col-sm-4 control-label no-padding-right\" for=\"page2\">Page 2 : <br/><span style=\"font-size: 10px\">(pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </span> </label>
                          <div class=\"col-sm-5\">
                                <input type=\"file\" class=\"form-control\" name=\"page2\" data-validation=\"mime size\" data-validation-allowing=\"docx,doc,pdf,jpeg,png,jpg\" data-validation-max-size=\"512kb\"
                                data-validation-error-msg-size=\"You can not upload images larger than 512kb\" data-validation-error-msg-mime=\"You can only upload docx, doc, pdf, jpeg, jpg or png type file\" style=\"border: 0px;\">
                              </div> 
                              <strong class='text-success'>".basename($url2)."</strong>
                              <a href=\"$url2\" class=\"btn btn-xs btn-primary\" target=\"_blank\" title=\"View\"><i class=\"fa fa-eye\"></i> </a>
                              <a href=\"$url2\" class=\"btn btn-xs btn-success\" target=\"_blank\" download title=\"Download\"><i class=\"fa fa-download\"></i> </a>
                        </div>
                        <div class=\"form-group\">
                           <label class=\"col-sm-4 control-label no-padding-right\" for=\"page3\">Page 3 : <br/><span style=\"font-size: 10px\">(pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </span> </label>
                          <div class=\"col-sm-5\">
                                <input type=\"file\" id=\"inp_page3\" class=\"form-control\" name=\"page3\" data-validation=\"mime size\" data-validation-allowing=\"docx,doc,pdf,jpeg,png,jpg\" data-validation-max-size=\"512kb\"
                                data-validation-error-msg-size=\"You can not upload images larger than 512kb\" data-validation-error-msg-mime=\"You can only upload docx, doc, pdf, jpeg, jpg or png type file\" style=\"border: 0px;\" >
                          </div>
                           
                              <strong class='text-success'>".basename($url3)."</strong>
                           <a href=\"$url3\" class=\"btn btn-xs btn-primary\" target=\"_blank\" title=\"View\"><i class=\"fa fa-eye\"></i> </a>
                           <a href=\"$url3\" class=\"btn btn-xs btn-success\" target=\"_blank\" download title=\"Download\"><i class=\"fa fa-download\"></i> </a>
                           </div>
                        <div class=\"form-group\">
                           <label class=\"col-sm-4 control-label no-padding-right\" for=\"page4\">Page 4 :<br/> <span style=\"font-size: 10px\">(pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </span> </label>
                          <div class=\"col-sm-5\">
                                <input type=\"file\" class=\"form-control\" name=\"page4\" data-validation=\"mime size\" data-validation-allowing=\"docx,doc,pdf,jpeg,png,jpg\" data-validation-max-size=\"512kb\"
                                data-validation-error-msg-size=\"You can not upload images larger than 512kb\" data-validation-error-msg-mime=\"You can only upload docx, doc, pdf, jpeg, jpg or png type file\" style=\"border: 0px;\"> 
                          </div> 
                              <strong class='text-success'>".basename($url4)."</strong>
                              <a href=\"$url4\" class=\"btn btn-xs btn-primary\" target=\"_blank\" title=\"View\"><i class=\"fa fa-eye\"></i> </a>
                             <a href=\"$url4\" class=\"btn btn-xs btn-success\" target=\"_blank\" download title=\"Download\"><i class=\"fa fa-download\"></i> </a>
                        </div>
                        <div class=\"form-group\">
                           <label class=\"col-sm-4 control-label no-padding-right\" for=\"page5\">Page 5 :<br/> <span style=\"font-size: 10px\">(pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </span> </label>
                          <div class=\"col-sm-5\">
                                <input type=\"file\" class=\"form-control\" name=\"page5\" data-validation=\"mime size\" data-validation-allowing=\"docx,doc,pdf,jpeg,png,jpg\" data-validation-max-size=\"512kb\"
                                data-validation-error-msg-size=\"You can not upload images larger than 512kb\" data-validation-error-msg-mime=\"You can only upload docx, doc, pdf, jpeg, jpg or png type file\" style=\"border: 0px;\"> 
                          </div> 
                              <strong class='text-success'>".basename($url5)."</strong>
                          <a href=\"$url5\" class=\"btn btn-xs btn-primary\" target=\"_blank\" title=\"View\"><i class=\"fa fa-eye\"></i> </a>
                          <a href=\"$url5\" class=\"btn btn-xs btn-success\" target=\"_blank\" download title=\"Download\"><i class=\"fa fa-download\"></i> </a>
                          </div>
                        <div class=\"form-group\">
                           <label class=\"col-sm-4 control-label no-padding-right\" for=\"page6\">Page 6 :<br/> <span style=\"font-size: 10px\">(pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </span> </label>
                          <div class=\"col-sm-5\">
                                <input type=\"file\" class=\"form-control\" name=\"page6\" data-validation=\"mime size\" data-validation-allowing=\"docx,doc,pdf,jpeg,png,jpg\" data-validation-max-size=\"512kb\"
                                data-validation-error-msg-size=\"You can not upload images larger than 512kb\" data-validation-error-msg-mime=\"You can only upload docx, doc, pdf, jpeg, jpg or png type file\" style=\"border: 0px;\"> 
                          </div>
                           <strong class='text-success'>".basename($url6)."</strong>
                          <a href=\"$url6\" class=\"btn btn-xs btn-primary\" target=\"_blank\" title=\"View\"><i class=\"fa fa-eye\"></i> </a>
                          <a href=\"$url6\" class=\"btn btn-xs btn-success\" target=\"_blank\" download title=\"Download\"><i class=\"fa fa-download\"></i> </a>
                          </div>

 
                       <div class=\"form-group\">
                           <label class=\"col-sm-4 control-label no-padding-right\" for=\"page7\">Page 7 :<br/> <span style=\"font-size: 10px\">(pdf|doc|docx|jpg|jpeg|png <br/> Maximum 512kb) </span> </label>
                          <div class=\"col-sm-5\">
                                <input type=\"file\" class=\"form-control\" name=\"page7\" data-validation=\"mime size\" data-validation-allowing=\"docx,doc,pdf,jpeg,png,jpg\" data-validation-max-size=\"512kb\"
                                data-validation-error-msg-size=\"You can not upload images larger than 512kb\" data-validation-error-msg-mime=\"You can only upload docx, doc, pdf, jpeg, jpg or png type file\" style=\"border: 0px;\"> 
                          </div>
                           <strong class='text-success'>".basename($url7)."</strong>
                          <a href=\"$url7\" class=\"btn btn-xs btn-primary\" target=\"_blank\" title=\"View\"><i class=\"fa fa-eye\"></i> </a>
                          <a href=\"$url7\" class=\"btn btn-xs btn-success\" target=\"_blank\" download title=\"Download\"><i class=\"fa fa-download\"></i> </a>
                          </div>
                           <input type=\"hidden\" name=\"serviceid\" value=\"$sbook->hr_associate_id\">";
                    }

        return $list;
    }
    public function servicebookStore(Request $request)
    {    
        ACL::check(["permission" => "hr_ess_grievance_appeal"]);
        #-----------------------------------------------------------# 
      $validator= Validator::make($request->all(),[
            'associate_id'       =>'required'
           
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!!");
        }
        else{
            if ($request->store){
                // Insert query

            $page1 = null;  
            if($request->hasFile('page1')){
                $file = $request->file('page1');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page1 = $dir.$filename;
            }
            $page2 = null;  
            if($request->hasFile('page2')){
                $file = $request->file('page2');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page2 = $dir.$filename;
            }
            $page3 = null;  
            if($request->hasFile('page3')){
                $file = $request->file('page3');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page3 = $dir.$filename;
            }
           $page4 = null;  
            if($request->hasFile('page4')){
                $file = $request->file('page4');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page4 = $dir.$filename;
            }
            $page5 = null;  
            if($request->hasFile('page5')){
                $file = $request->file('page5');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page5 = $dir.$filename;
            }

            $page6 = null;  
            if($request->hasFile('page6')){
                $file = $request->file('page6');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page6 = $dir.$filename;
            }

            $page7 = null;  
            if($request->hasFile('page7')){
                $file = $request->file('page7');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page7 = $dir.$filename;
            }

            ///File Url Store //////////

                  ServiceBook::insert([
                        'hr_associate_id' => $request->associate_id,
                        'page1_url'       => $page1,
                        'page2_url'       => $page2,
                        'page3_url'       => $page3,
                        'page4_url'       => $page4,
                        'page5_url'       => $page5,
                        'page6_url'       => $page6,
                        'page7_url'       => $page7,
                        'created_by'      => auth()->user()->associate_id
                    ]);
            
      
            return back()
            ->with('success', "Page File Saved Successfully!!");
        }
        else { // Update query
          $sbook=ServiceBook::where('hr_associate_id',$request->serviceid)->first();

        //File upload///
              $page1 = $sbook->page1_url;  
            if($request->hasFile('page1')){
                $file = $request->file('page1');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page1 = $dir.$filename;
            }
           $page2 = $sbook->page2_url;  
            if($request->hasFile('page2')){
                $file = $request->file('page2');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page2 = $dir.$filename;
            }
            $page3 = $sbook->page3_url;  
            if($request->hasFile('page3')){
                $file = $request->file('page3');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page3 = $dir.$filename;
            }
           $page4 = $sbook->page4_url;  
            if($request->hasFile('page4')){
                $file = $request->file('page4');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page4 = $dir.$filename;
            }
            $page5 = $sbook->page5_url;  
            if($request->hasFile('page5')){
                $file = $request->file('page5');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page5 = $dir.$filename;
            }

            $page6 = $sbook->page6_url;  
            if($request->hasFile('page6')){
                $file = $request->file('page6');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page6 = $dir.$filename;
            }

            $page7 = $sbook->page7_url;  
            if($request->hasFile('page7')){
                $file = $request->file('page7');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page7 = $dir.$filename;
            }

           ///File Update  //////////
              $sbookup = ServiceBook::where('hr_associate_id',$request->serviceid)->update([
                        'hr_associate_id' => $request->associate_id,
                        'page1_url'       => $page1,
                        'page2_url'       => $page2,
                        'page3_url'       => $page3,
                        'page4_url'       => $page4,
                        'page5_url'       => $page5,
                        'page6_url'       => $page6,
                        'page7_url'       => $page7,
                        'updated_by'      => auth()->user()->associate_id
                    ]);

           

        return back()
        ->with('success', "Service Book Successfully Updated!!");
    }
     }   
    } 

    public function servicebookEdit($id)
    {    
        ACL::check(["permission" => "hr_ess_grievance_appeal"]);
        #-----------------------------------------------------------# 

        $issueList = GrievanceIssue::where('hr_griv_issue_status', '1')
                    ->pluck('hr_griv_issue_name', 'hr_griv_issue_id'); 
        $sbook=ServiceBook::where('hr_s_book_id', $id)->first();

       // dd($sbook);

        return view('hr/ess/service_book_edit', compact('issueList','sbook'));
    }  

      public function servicebookUpdate(Request $request){ 
        //dd($request->all());
        ACL::check(["permission" => "hr_ess_grievance_appeal"]);
        #-----------------------------------------------------------# 

       $validator= Validator::make($request->all(),[
            'associate_id'       =>'required',
            'page1'              =>'required|mimes:docx,doc,pdf,jpg,png,jpeg|max:512'           
           

        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('error', "Incorrect Input!");
        }
        else{

      
   
            $sbook=ServiceBook::where('hr_s_book_id',$request->serviceid)->first();

        //File upload///
              $page1 = $sbook->page1_url;  
            if($request->hasFile('page1')){
                
                // previous file delete 
                   // $url1 = asset($page1);
   
                   //    if (file::exists($url1)) { // unlink or remove previous image from folder
                   //     unlink($url1);
                   //   }
      
                $file = $request->file('page1');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page1 = $dir.$filename;
            }
           $page2 = $sbook->page2_url;  
            if($request->hasFile('page2')){
                $file = $request->file('page2');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page2 = $dir.$filename;
            }
            $page3 = $sbook->page3_url;  
            if($request->hasFile('page3')){
                $file = $request->file('page3');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page3 = $dir.$filename;
            }
           $page4 = $sbook->page4_url;  
            if($request->hasFile('page4')){
                $file = $request->file('page4');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page4 = $dir.$filename;
            }
            $page5 = $sbook->page5_url;  
            if($request->hasFile('page5')){
                $file = $request->file('page5');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page5 = $dir.$filename;
            }

            $page6 = $sbook->page6_url;  
            if($request->hasFile('page6')){
                $file = $request->file('page6');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page6 = $dir.$filename;
            }

            $page7 = $sbook->page7_url;  
            if($request->hasFile('page7')){
                $file = $request->file('page7');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $dir  = '/assets/files/servicebook/';
                $file->move( public_path($dir) , $filename );
                $page7 = $dir.$filename;
            }

           ///File Update  //////////
              $sbookup = ServiceBook::where('hr_s_book_id',$request->serviceid)->update([
                        'hr_associate_id' => $request->associate_id,
                        'page1_url'       => $page1,
                        'page2_url'       => $page2,
                        'page3_url'       => $page3,
                        'page4_url'       => $page4,
                        'page5_url'       => $page5,
                        'page6_url'       => $page6,
                        'page7_url'       => $page7,
                        'updated_by'      => auth()->user()->associate_id
                    ]);

           

        return back()
        ->with('success', "Service Book Successfully Updated!!");
     } 

    //return redirect('merch/setup/infoBrand');
  }

 
}
