<?php
$dirname ='/assets/files/';
if (substr($dirname, 0, 14) === '/assets/files/'){   
    echo "file type ";} 
    else  echo "Nai ";


    //if($request->march_file[0] != null)
        //{
  		   //dd($request->all()); 
       		$colorfile=MaterialColorAttach::where('clr_id', $request->color_id)->delete();

       			//File upload///
               	for($i=0; $i<sizeof($request->march_file); $i++){
                  
                  $march_file = null;
                   if(($request->hasFile('march_file.'. $i))
                    
                   {
                        $file = $request->file('march_file.'. $i);

                         if (substr($file, 0, 14) === '/assets/files/'){  
                               $march_file=$file;
                             } 
                        else{
                        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                        $dir  = '/assets/files/materialcolor/';
                        $file->move( public_path($dir) , $filename );
                        $march_file = $dir.$filename;}
                          
                else if( $request->march_file[$i])    

            		}
///////////////////////

            
        //if($request->march_file[0] != null)
        //{
  		   //dd($request->all()); 
       		$colorfile=MaterialColorAttach::where('clr_id', $request->color_id)->delete();

       			//File upload///
             $dir  = '/assets/files/materialcolor/';
               	for($i=0; $i<sizeof($request->march_file); $i++){
                  
                  $march_file = null;
                  if(!empty($request->march_file_bk[$i])){

                    $path=$request->march_file[$i];
                       if (substr($path, 0, 14) === '/assets/files/'){  
                               $march_file=$path;
                             } 
                       else{
                        $filename1 = uniqid() . '.' . $path->getClientOriginalExtension();
                       
                        $path->move( public_path($dir) , $filename );
                        $march_file = $dir.$filename1;} 

                  }   
                   if($request->hasFile('march_file.'. $i))
                    
                   {
                        $file = $request->file('march_file.'. $i);

                        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                 
                        $file->move( public_path($dir) , $filename );
                        $march_file = $dir.$filename;
                    }

                    //dd($file);
        	///File Url Store //////////

        		MaterialColorAttach::insert([
                        'clr_id'               => $request->color_id,
                        'col_attach_url'       => $march_file
                    ]);
           //}
       } 	