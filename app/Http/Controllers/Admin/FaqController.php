<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use App\Helpers\CustomHelper;
use Auth;
use Validator;
use App\User;
use App\Admin;
use App\Category;

use App\Course;
use App\Exam;
use App\Question;
use App\Testimonial;
use App\Faq;
use Yajra\DataTables\DataTables;


use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

use App\Imports\QuestionImport;
use App\Exports\UserExport;

use Maatwebsite\Excel\Facades\Excel;

use App\QuestionNotValid;

use Storage;
use DB;
use Hash;



Class FaqController extends Controller
{


	private $ADMIN_ROUTE_NAME;

    public function __construct(){

        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


    }



    public function index(Request $request){
       $data = [];
       return view('admin.faqs.index',$data);
   }


   public function get_faqs(Request $request){

    $routeName = CustomHelper::getAdminRouteName();
    $datas = Faq::orderBy('id','desc')->get();

    return Datatables::of($datas)


    ->editColumn('id', function(Faq $data) {

        return  $data->id;
    })
    ->editColumn('question', function(Faq $data) {
        $question = mb_strlen(strip_tags($data->question),'utf-8') > 50 ? mb_substr(strip_tags($data->question),0,50,'utf-8').'...' : strip_tags($data->question);

        return  $question ?? '';
    })
    ->editColumn('answer', function(Faq $data) {
        $answer = mb_strlen(strip_tags($data->answer),'utf-8') > 50 ? mb_substr(strip_tags($data->answer),0,50,'utf-8').'...' : strip_tags($data->answer);
        return  $answer ?? '';
    })


    ->editColumn('status', function(Faq $data) {
     $sta = '';
     $sta1 ='';
     if($data->status == 1){
        $sta1 = 'selected';
    }else{
        $sta = 'selected';
    }

    $html = "<select id='change_status$data->id' onchange='change_status($data->id)'>
    <option value='1' ".$sta1.">Active</option>
    <option value='0' ".$sta.">InActive</option>
    </select>";
    return  $html;
})
    ->editColumn('created_at', function(Faq $data) {
        return  date('d M Y',strtotime($data->created_at));
    })

    ->addColumn('action', function(Faq $data) {

      $routeName = CustomHelper::getAdminRouteName();

      $BackUrl = $routeName.'/faqs';


      return '<a title="Edit" href="' . route($routeName.'.faqs.edit',$data->id.'?back_url='.$BackUrl) . '"><i class="fa fa-edit">Edit</i></a>&nbsp;&nbsp;&nbsp;';
  })

    ->rawColumns(['name', 'status', 'action','image'])
    ->toJson();
}





public function add(Request $request){
    $data = [];

    $id = (isset($request->id))?$request->id:0;

    $faqs = '';
    if(is_numeric($id) && $id > 0){
        $faqs = Faq::find($id);
        if(empty($faqs)){
            return redirect($this->ADMIN_ROUTE_NAME.'/faqs');
        }
    }

    if($request->method() == 'POST' || $request->method() == 'post'){

        if(empty($back_url)){
            $back_url = $this->ADMIN_ROUTE_NAME.'/faqs';
        }

        $name = (isset($request->name))?$request->name:'';


        $rules = [];

        $rules['question'] = 'required';
        $rules['status'] = 'required';
        $rules['answer'] = 'required';
        


        $this->validate($request, $rules);

        $createdCat = $this->save($request, $id);

        if ($createdCat) {
            $alert_msg = 'Faqs has been added successfully.';
            if(is_numeric($id) && $id > 0){
                $alert_msg = 'Faqs has been updated successfully.';
            }
            return redirect(url($back_url))->with('alert-success', $alert_msg);
        } else {
            return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
        }
    }


    $page_heading = 'Add Faqs';

      if(is_numeric($id) && $id > 0){
        $page_heading = 'Update Faqs';
    }  

    $data['page_heading'] = $page_heading;
    $data['id'] = $id;
    $data['faqs'] = $faqs;

    return view('admin.faqs.form', $data);

}





public function save(Request $request, $id=0){

    $data = $request->except(['_token', 'back_url', 'image']);

        //prd($request->toArray());


    $oldImg = '';

    $faqs = new Faq;

    if(is_numeric($id) && $id > 0){
        $exist = Faq::find($id);

        if(isset($exist->id) && $exist->id == $id){
            $faqs = $exist;

            $oldImg = $exist->image;
        }
    }
        //prd($oldImg);

    foreach($data as $key=>$val){
        $faqs->$key = $val;
    }

    $isSaved = $faqs->save();

    // if($isSaved){
    //     $this->saveImage($request, $faqs, $oldImg);
    // }

    return $isSaved;
}


private function saveImage($request, $testimonial, $oldImg=''){

    $file = $request->file('image');
    if ($file) {
        $path = 'testimonial/';
        $thumb_path = 'testimonial/thumb/';
        $storage = Storage::disk('public');
            //prd($storage);
        $IMG_WIDTH = 768;
        $IMG_HEIGHT = 768;
        $THUMB_WIDTH = 114;
        $THUMB_HEIGHT = 114;

        $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);

           // prd($uploaded_data);
        if($uploaded_data['success']){

            if(!empty($oldImg)){
                if($storage->exists($path.$oldImg)){
                    $storage->delete($path.$oldImg);
                }
                if($storage->exists($thumb_path.$oldImg)){
                    $storage->delete($thumb_path.$oldImg);
                }
            }

            $image = $uploaded_data['file_name'];

            $testimonial->image = $image;
            $testimonial->save();         
        }

        if(!empty($uploaded_data)){   
            return $uploaded_data;
        }  

    }

}




public function delete(Request $request){

        //prd($request->toArray());

    $id = (isset($request->id))?$request->id:0;

    $is_delete = '';

    if(is_numeric($id) && $id > 0){
        $is_delete = Faq::where('id', $id)->delete();
    }

    if(!empty($is_delete)){
        return back()->with('alert-success', 'Faq has been deleted successfully.');
    }
    else{
        return back()->with('alert-danger', 'something went wrong, please try again...');
    }
}


public function change_status(Request $request){
  $faq_id = isset($request->faq_id) ? $request->faq_id :'';
  $status = isset($request->status) ? $request->status :'';
  $faq = Faq::where('id',$faq_id)->first();
  if(!empty($faq)){
     Faq::where('id',$faq_id)->update(['status'=>$status]);
     $response['success'] = true;
     $response['message'] = 'Status updated';
     return response()->json($response);
 }else{
     $response['success'] = false;
     $response['message'] = 'Not Found';
     return response()->json($response);
 }
}





/* ajax_delete_image */
public function ajax_delete_image(Request $request){

        // prd($request->toArray());

    $response['success'] = false;

    $id = ($request->has('id'))?$request->id:0;

    if (is_numeric($id) && $id > 0) {
        $testimonial = Event::find($id);

        if(isset($testimonial->id) && $testimonial->id == $id){

            $path = 'events/';
            $thumb_path = 'events/thumb/';
            $storage = Storage::disk('public');

            $image = $testimonial->image;

            $isImgDeleted = false;

            if(!empty($image)){
                if($storage->exists($path.$image)){
                    $isImgDeleted = $storage->delete($path.$image);
                }
                if($storage->exists($thumb_path.$image)){
                    $isImgDeleted = $storage->delete($thumb_path.$image);
                }
            }

            if($isImgDeleted){
                $response['success'] = true;
            }
        }

    }

    return response()->json($response);
}

public function import(Request $request){
   $data = [];
   $exam_id = isset($request->id) ? $request->id :'';


   $method = $request->method();
   if($method == 'post' || $method == 'POST'){
    $rules = [];
    $rules['importfile'] = 'required';
    $message = ['importfile.required' => 'You have to choose the file!',];
    $this->validate($request,$rules,$message);

    $sucess = Excel::import(new QuestionImport($exam_id),request()->file('importfile'));

    $questions = QuestionNotValid::get();
    if(!empty($questions) && $questions->count() > 0){
        // $this->export($questions);
        foreach($questions as $question){
            $questionArr = [];
            $questionArr['question_name'] = $question->question_name;
            $questionArr['option_1'] = $question->option_1;
            $questionArr['option_2'] = $question->option_2;
            $questionArr['option_3'] = $question->option_3;
            $questionArr['option_4'] = $question->option_4;
            $questionArr['right_option'] = $question->right_option;
            $questionArr['difficulti_level'] = $question->difficulti_level;
            $exportArr[] = $questionArr;
        }

        $filedNames = array_keys($exportArr[0]);

        $fileName = 'questions_'.date('Y-m-d-H-i-s').'.xlsx';
        QuestionNotValid::truncate();
        return Excel::download(new UserExport($exportArr, $filedNames), $fileName);
    }

}


$data['exam_id'] = $exam_id;

return view('admin.exams.import', $data); 
}


public function get_exam_question(Request $request){

    $routeName = CustomHelper::getAdminRouteName();
    $exam_id = isset($request->exam_id) ? $request->exam_id : '';

    $datas = Question::where('exam_id',$exam_id)->orderBy('id','desc')->get();

    return Datatables::of($datas)


    ->editColumn('id', function(Question $data) {

        return  $data->id;
    })
    ->editColumn('question_name', function(Question $data) {
        $question_name =  mb_strlen(strip_tags($data->question_name),'utf-8') > 50 ? mb_substr(strip_tags($data->question_name),0,50,'utf-8').'...' : strip_tags($data->question_name);
        return  $question_name;
    })
    ->editColumn('option_1', function(Question $data) {
     $option_1 =  mb_strlen(strip_tags($data->option_1),'utf-8') > 50 ? mb_substr(strip_tags($data->option_1),0,50,'utf-8').'...' : strip_tags($data->option_1);
     return  $option_1;
 })
    ->editColumn('option_2', function(Question $data) {
     $option_2 =  mb_strlen(strip_tags($data->option_2),'utf-8') > 50 ? mb_substr(strip_tags($data->option_2),0,50,'utf-8').'...' : strip_tags($data->option_2);
     return  $option_2;


 })
    ->editColumn('option_3', function(Question $data) {
      $option_3 =  mb_strlen(strip_tags($data->option_3),'utf-8') > 50 ? mb_substr(strip_tags($data->option_3),0,50,'utf-8').'...' : strip_tags($data->option_3);
      return  $option_3;


  })
    ->editColumn('option_4', function(Question $data) {
      $option_4 =  mb_strlen(strip_tags($data->option_4),'utf-8') > 50 ? mb_substr(strip_tags($data->option_4),0,50,'utf-8').'...' : strip_tags($data->option_4);
      return  $option_4;


  })
    ->editColumn('right_option', function(Question $data) {
        return $data->right_option;

    })
    
    ->editColumn('difficulti_level', function(Question $data) {
        return $data->difficulti_level;


    })
    
    
    ->editColumn('status', function(Question $data) {
     $sta = '';
     $sta1 ='';
     if($data->status == 1){
        $sta1 = 'selected';
    }else{
        $sta = 'selected';
    }

    $html = "<select id='change_status$data->id' onchange='change_status($data->id)'>
    <option value='1' ".$sta1.">Active</option>
    <option value='0' ".$sta.">InActive</option>
    </select>";

    return  $html;
})
    ->editColumn('created_at', function(Question $data) {
        return  date('d M Y',strtotime($data->created_at));
    })

    ->addColumn('action', function(Question $data) {

      $routeName = CustomHelper::getAdminRouteName();

      $BackUrl = $routeName.'/exams/import/'.$data->exam_id;

      return '<a title="Edit" href="' . route($routeName.'.exams.edit_question',$data->id.'?back_url='.$BackUrl) . '"><i class="fa fa-edit">Edit</i></a>&nbsp;&nbsp;&nbsp;
      ';
  })

    ->rawColumns(['name', 'status', 'action','image'])
    ->toJson();
}


public function add_question(Request $request){
    $exam_id  = isset($request->exam_id) ? $request->exam_id :'';
    $data = [];
    $data['exam_id'] = $exam_id;
    $data['question_id'] = '';
    $question_id ='';
$back_url = $request->back_url;
if(empty($request->back_url)){
    $back_url = $this->ADMIN_ROUTE_NAME.'/exams/import/'.$question->exam_id;

}
    $method = $request->method();
    if($method == 'post' || $method == 'POST'){

        $rules = [];
        $rules['question_name'] = 'required';
        $rules['option_1'] = 'required';
        $rules['option_2'] = 'required';
        $rules['option_3'] = 'required';
        $rules['option_4'] = 'required';
        $rules['right_option'] = 'required';
        $rules['difficulti_level'] = 'required';
        $rules['status'] = 'required';

        $this->validate($request, $rules);
        $createdQuestion = $this->save_questions($request,$exam_id,$question_id);
        if ($createdQuestion) {
            $alert_msg = 'Question has been Updated successfully.';
            return redirect(url($back_url))->with('alert-success', $alert_msg);
        } else {
            return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
        }
    }


    $page_heading = 'Add Question';
    $data['page_heading'] = $page_heading;




    return view('admin.exams.question_form', $data); 


}
public function save_questions($request,$exam_id='',$question_id=''){
            //////UPDATE
    $dbArr = [];
        if($question_id !=''){
            $dbArr['question_name'] = $request->question_name;
            $dbArr['option_1'] = $request->option_1;
            $dbArr['option_2'] = $request->option_2;
            $dbArr['option_3'] = $request->option_3;
            $dbArr['option_4'] = $request->option_4;
            $dbArr['right_option'] = $request->right_option;
            $dbArr['difficulti_level'] = $request->difficulti_level;
            $dbArr['status'] = $request->status;
            $dbArr['is_delete'] = 0;

            $success = Question::where('id',$question_id)->update($dbArr);
            if($success){
                return true;
            }else{
                return false;
            }

        }else{
            ///////Create

            $dbArr['question_name'] = $request->question_name;
            $dbArr['exam_id'] = $exam_id;
            $dbArr['option_1'] = $request->option_1;
            $dbArr['option_2'] = $request->option_2;
            $dbArr['option_3'] = $request->option_3;
            $dbArr['option_4'] = $request->option_4;
            $dbArr['right_option'] = $request->right_option;
            $dbArr['difficulti_level'] = $request->difficulti_level;
            $dbArr['status'] = $request->status;
            $dbArr['is_delete'] = 0;

            $success = Question::create($dbArr);
            if($success){
                return true;
            }else{
                return false;
            }

        }

}




public function edit_question(Request $request){

 $question_id = isset($request->question_id) ? $request->question_id :'';

 $data = [];

 $question = Question::where('id',$question_id)->first();


 $data['exam_id'] = $question->exam_id;
 $data['question_id'] = $question_id;
 $data['question'] = $question;
$back_url = $request->back_url;
if(empty($request->back_url)){
    $back_url = $this->ADMIN_ROUTE_NAME.'/exams/import/'.$question->exam_id;

}
 $method = $request->method();
 if($method == 'post' || $method == 'POST'){

    $rules = [];
    $rules['question_name'] = 'required';
    $rules['option_1'] = 'required';
    $rules['option_2'] = 'required';
    $rules['option_3'] = 'required';
    $rules['option_4'] = 'required';
    $rules['right_option'] = 'required';
    $rules['difficulti_level'] = 'required';
    $rules['status'] = 'required';

    $this->validate($request, $rules);
    $createdQuestion = $this->save_questions($request,$question->exam_id,$question_id);
     if ($createdQuestion) {
            $alert_msg = 'Question has been added successfully.';
            return redirect(url($back_url))->with('alert-success', $alert_msg);
        } else {
            return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
        }



}









$page_heading = 'Update Question';
$data['page_heading'] = $page_heading;




return view('admin.exams.question_form', $data); 

}















}