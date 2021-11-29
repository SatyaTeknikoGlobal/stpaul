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
use App\SubCategory;
use App\Influencers;
use App\InfluencersGallery;
use App\EventGallery;
use App\EventQuestion;
use App\EventQuestionAnswer;
use App\Event;
use App\EventSubscription;
use App\EventUser;
use App\EventChat;
use Yajra\DataTables\DataTables;


use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;




use Storage;
use DB;
use Hash;



Class EventController extends Controller
{


	private $ADMIN_ROUTE_NAME;

    public function __construct(){

        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


    }



    public function index(Request $request){
      $events = Event::paginate(10);
      $data['events'] = $events;
      return view('admin.events.index',$data);
  }


  public function get_events(Request $request){

    $routeName = CustomHelper::getAdminRouteName();
    $datas = Event::orderBy('id','desc')->get();

    return Datatables::of($datas)


    ->editColumn('id', function(Event $data) {

        return  $data->id;
    })
    ->editColumn('title', function(Event $data) {
        return  $data->title;
    })
    ->editColumn('image', function(Event $data) {
     $storage = Storage::disk('public');
     $path = 'events/thumb/';
     $image = $data->image;

     if(!empty($image)){
        if($storage->exists($path.$image))
        { 
            $image = url('public/storage/'.$path.'/'.$image);
        }
    }else{
        $image = url('public/assets/img/noimage.png');

    }
    return $image;


})
    ->editColumn('influencers_id', function(Event $data) {

        $Influencers = Influencers::where('id',$data->influencers_id)->first();


        return  $Influencers->name ?? '';
    })
    ->editColumn('location', function(Event $data) {

        // $description = mb_strlen(strip_tags($data->description),'utf-8') > 50 ? mb_substr(strip_tags($data->description),0,50,'utf-8').'...' : strip_tags($data->description);

        return  $data->location;


    })

    ->editColumn('about', function(Event $data) {

     $about = mb_strlen(strip_tags($data->about),'utf-8') > 50 ? mb_substr(strip_tags($data->about),0,50,'utf-8').'...' : strip_tags($data->about);

     return  $about;


 })
    ->editColumn('event_date', function(Event $data) {

        $event_date = $data->event_date;




        $event_day = date('D',strtotime($event_date));
        $event_month = date('F',strtotime($event_date));
        $event_date = date('j',strtotime($event_date));



        return  $event_day.",".$event_date." ".$event_month;


    })


    ->editColumn('start_time', function(Event $data) {


        return  date('h:i A', strtotime($data->start_time));


    })

    ->editColumn('end_time', function(Event $data) {
        return  date('h:i A', strtotime($data->end_time));


    })
    ->editColumn('subscription_price', function(Event $data) {
        return  $data->subscription_price."/-";


    })



    ->editColumn('status', function(Event $data) {

        if($data->status == 1){
            $sta = 'Active';
        }else{
            $sta = 'Inactive';
        }
        return  $sta;
    })
    ->editColumn('created_at', function(Event $data) {
        return  $data->created_at;
    })

    ->addColumn('action', function(Event $data) {
      $BackUrl = 'admin/events';
       // <a title="Chats/Comments" href="'. route('admin.events.chats', $data->id.'?back_url='.$BackUrl).'"><i class="fa fa-question-circle" aria-hidden="true"></i>Q & A</i></a>

            // <a title="Delete" href="' . route('admin.events.delete',$data->id.'?back_url='.$BackUrl) . '"  id="delete_item"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;&nbsp   
      return '<a title="Edit" href="' . route('admin.events.edit',$data->id.'?back_url='.$BackUrl) . '"><i class="fa fa-edit">Edit</i></a>&nbsp;&nbsp;&nbsp;

      <a title="Users" href="' . route('admin.events.user',$data->id.'?back_url='.$BackUrl) . '"><i class="fa fa-user"> Users</i></a>&nbsp;&nbsp;&nbsp;

      <a title="Gallery" href="'. route('admin.events.gallery', $data->id.'?back_url='.$BackUrl).'"><i class="fa fa-picture-o" aria-hidden="true">Gallery</i></a>
      <a title="Chats/Comments" href="'. route('admin.events.chats', $data->id.'?back_url='.$BackUrl).'"><i class="fa fa-comments-o" aria-hidden="true">Chat</i></a>&nbsp;&nbsp;&nbsp;&nbsp;


      <a title="Chats/Comments" href="'. route('admin.events.subscription', $data->id.'?back_url='.$BackUrl).'"><i class="fa fa-id-card" aria-hidden="true">Subscription</i></a>

      <a title="Users" href="' . route('admin.events.analysis',$data->id.'?back_url='.$BackUrl) . '"><i class="fa fa-question"> Q & A</i></a>&nbsp;&nbsp;&nbsp;



      ';
  })

    ->rawColumns(['name', 'status', 'action'])
    ->toJson();
}




public function subscription(Request $request){


    $data =[];
    $user_ids = [];
    $event_id = isset($request->event_id) ? $request->event_id :'';
    $data['event_id'] = $event_id;


    $method = $request->method();
    if($method == 'post' || $method == 'POST'){
       $rules = [];
       $rules['user_ids']='required';




       $this->validate($request,$rules);


       if(!empty($request->user_ids)){
        $user_ids = $request->user_ids;
        foreach ($user_ids as $key => $value) {
            $dbArray = [];

            $dbArray['user_id'] = $value;
            $dbArray['event_id'] = $event_id;
            EventSubscription::create($dbArray);
        }
    }
}




$sub_users = EventSubscription::where('event_id',$event_id)->get();
if(!empty($sub_users)){
    foreach($sub_users as $use){
        $user_ids[] = $use->user_id;
    }
}


$users = User::whereNotIn('id',$user_ids)->get();

$data['users'] = $users;

return view('admin.events.sub_users_list', $data);   
}



public function event_user_list(Request $request){
    $data = [];
    $event_id = isset($request->id) ? $request->id :'';
    $data['event_id'] = $event_id;

    $data['event'] = Event::where('id',$event_id)->first();



    return view('admin.events.users', $data);
}


public function subscribed_user(Request $request){

    $data = [];
    $data['events'] = Event::where('status',1)->get();
    return view('admin.events.sub_users', $data);

}


public function get_sub_users(Request $request){

    $event_id = isset($request->event_id) ? $request->event_id :0;
    $routeName = CustomHelper::getAdminRouteName();
    $datas = EventSubscription::orderBy('id','desc');

    if($event_id !=0){
        $datas->where('event_id',$event_id);
    }



    $datas = $datas->get();
    return Datatables::of($datas)
    ->editColumn('id', function(EventSubscription $data) {

        return  $data->id;
    })
    ->editColumn('name', function(EventSubscription $data) {
        $user = User::where('id',$data->user_id)->first();

        return  $user->name ?? '';
    })

    ->editColumn('event_name', function(EventSubscription $data) {

        $event = Event::where('id',$data->event_id)->first();


        return  $event->title ?? '';
    })

    ->rawColumns(['name'])
    ->toJson();



}













public function joined_user_list(Request $request){
 $routeName = CustomHelper::getAdminRouteName();

 $event_id = isset($request->event_id) ? $request->event_id :'';

 $datas = EventUser::orderBy('id','desc')->where('event_id',$event_id)->get();

 return Datatables::of($datas)


 ->editColumn('id', function(EventUser $data) {

    return  $data->id;
})
 ->editColumn('user_name', function(EventUser $data) {

    $user  = User::where('id',$data->user_id)->first();
    return  isset($user->name) ? $user->name :'';
})
 ->editColumn('created_at', function(EventUser $data) {


    return  $data->created_at;
})
 ->toJson();
}

public function add(Request $request){
    $data = [];

    $id = (isset($request->id))?$request->id:0;

    $events = '';
    if(is_numeric($id) && $id > 0){
        $events = Event::find($id);
        if(empty($events)){
            return redirect($this->ADMIN_ROUTE_NAME.'/events');
        }
    }

    if($request->method() == 'POST' || $request->method() == 'post'){

        if(empty($back_url)){
            $back_url = $this->ADMIN_ROUTE_NAME.'/events';
        }

        $name = (isset($request->name))?$request->name:'';


        $rules = [];

        $rules['influencers_id'] = 'required';
        $rules['event_date'] = 'required';
        $rules['start_time'] = 'required';
        $rules['end_time'] = 'required';
        $rules['subscription_price'] = 'required';
        $rules['title'] = 'required';
        


        $this->validate($request, $rules);

        $createdCat = $this->save($request, $id);

        if ($createdCat) {
            $alert_msg = 'Event has been added successfully.';
            if(is_numeric($id) && $id > 0){
                $alert_msg = 'Event has been updated successfully.';
            }
            return redirect(url($back_url))->with('alert-success', $alert_msg);
        } else {
            return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
        }
    }


    $page_heading = 'Add Event';

    if(isset($events->title)){
        $events_name = $events->title;
        $page_heading = 'Update Event - '.$events_name;
    }  

    $data['page_heading'] = $page_heading;
    $data['id'] = $id;
    $data['events'] = $events;


    $data['influencers'] = Influencers::where('status',1)->get();
    return view('admin.events.form', $data);

}




public function save(Request $request, $id=0){

    $data = $request->except(['_token', 'back_url', 'image']);

        //prd($request->toArray());

    $oldImg = '';

    $events = new Event;

    if(is_numeric($id) && $id > 0){
        $exist = Event::find($id);

        if(isset($exist->id) && $exist->id == $id){
            $events = $exist;

            $oldImg = $exist->image;
        }
    }
        //prd($oldImg);

    foreach($data as $key=>$val){
        $events->$key = $val;
    }

    $isSaved = $events->save();

    if($isSaved){
        $this->saveImage($request, $events, $oldImg);
    }

    return $isSaved;
}


private function saveImage($request, $events, $oldImg=''){

    $file = $request->file('image');
    if ($file) {
        $path = 'events/';
        $thumb_path = 'events/thumb/';
        $storage = Storage::disk('public');
            //prd($storage);
        $IMG_WIDTH = 768;
        $IMG_HEIGHT = 768;
        $THUMB_WIDTH = 336;
        $THUMB_HEIGHT = 336;

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

            $events->image = $image;
            $events->save();         
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
        $is_delete = Event::where('id', $id)->delete();
    }

    if(!empty($is_delete)){
        return back()->with('alert-success', 'events has been deleted successfully.');
    }
    else{
        return back()->with('alert-danger', 'something went wrong, please try again...');
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



public function gallery(Request $request){

    $method = $request->method();

    $event_id = isset($request->id) ? $request->id :'';

    $data = [];


    if($method == 'post' || $method == 'POST'){

        $rules = [];
        $rules['image'] = 'required';

        $this->validate($request,$rules);

        if($request->hasFile('image')) {

            $image_result = $this->saveImageMultiple($request,$event_id);
            if($image_result){
                return back()->with('alert-success', 'Image uploaded successfully.');

            }
        }


    }

    $events = Event::where('id',$event_id)->first();
    $events_gallery = EventGallery::where('event_id',$event_id)->get();
    $data['events'] = $events;
    $data['events_gallery'] = $events_gallery;

    return view('admin.events.gallery',$data);


}




private function saveImageMultiple($request,$event_id){

    $files = $request->file('image');
    $path = 'event_gallery/';
    $thumb_path = 'event_gallery/thumb/';
    $storage = Storage::disk('public');
            //prd($storage);
    $IMG_WIDTH = 768;
    $IMG_HEIGHT = 768;
    $THUMB_WIDTH = 336;
    $THUMB_HEIGHT = 336;
    $dbArray = [];

    if (!empty($files)) {

        foreach($files as $file){
            $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);
            if($uploaded_data['success']){
                $image = $uploaded_data['file_name'];
                $dbArray['image'] = $image;
                $dbArray['event_id'] = $event_id;
                $dbArray['status'] = 1;
                $success = EventGallery::create($dbArray);
            }
        }
        return true;
    }else{
        return false;
    }
}



public function gallerydelete(Request $request){
    $id = isset($request->id) ? $request->id :'';

    $getgallery = EventGallery::where('id',$id)->first();
    $path = 'event_gallery/';
    $thumb_path = 'event_gallery/thumb/';
    $storage = Storage::disk('public');

    if(!empty($getgallery->image)){
        $image = $getgallery->image;
        if($storage->exists($path.$image)){
            $isImgDeleted = $storage->delete($path.$image);
        }
        if($storage->exists($thumb_path.$image)){
            $isImgDeleted = $storage->delete($thumb_path.$image);
        }

    }

    if($isImgDeleted){
        $success = EventGallery::where('id',$id)->delete();
        if($success){
            return back()->with('alert-success', 'Image Deleted successfully.');

        }else{
            return back()->with('alert-danger', 'Image Not delete');

        }
    }



}

public function questionList(Request $request){


    $data = [];
    $events = Event::get();

    $data['events']= $events;


    return view('admin.questions.index',$data);

}

public function get_questions(Request $request){


    $event_id = isset($request->event_id) ? $request->event_id : 0 ;


    $routeName = CustomHelper::getAdminRouteName();


    $datas = EventQuestion::orderBy('id','desc')->get();

    if(!empty($event_id) && $event_id != 0 ){
        $datas = EventQuestion::where('event_id',$event_id)->orderBy('id','desc')->get();

    }


    return Datatables::of($datas)
    ->editColumn('id', function(EventQuestion $data) {

        return  $data->id;
    })
    ->editColumn('event_name', function(EventQuestion $data) {

        $event = Event::where('id',$data->event_id)->first();


        return  $event->title ?? '';
    })
    ->editColumn('question_name', function(EventQuestion $data) {
        $question_name = mb_strlen(strip_tags($data->question_name),'utf-8') > 50 ? mb_substr(strip_tags($data->question_name),0,50,'utf-8').'...' : strip_tags($data->question_name);
        return $question_name;


    })
    ->editColumn('option_1', function(EventQuestion $data) {

        return  $data->option_1 ?? '';
    })
    ->editColumn('option_2', function(EventQuestion $data) {

        return  $data->option_2 ?? '';
    }) 
    ->editColumn('option_3', function(EventQuestion $data) {

        return  $data->option_3 ?? '';
    })
    ->editColumn('option_4', function(EventQuestion $data) {

        return  $data->option_4 ?? '';
    })
    ->editColumn('right_option', function(EventQuestion $data) {

        $right = '';

        if($data->right_option == 1){
            $right = 'Option 1';
        }

        if($data->right_option == 2){
            $right = 'Option 2';
        }
        if($data->right_option == 3){
            $right = 'Option 3';
        }
        if($data->right_option == 4){
            $right = 'Option 4';
        }

        return  $right;
    })
    ->editColumn('time', function(EventQuestion $data) {

        return  $data->time ?? '';
    })

    ->editColumn('status', function(EventQuestion $data) {

        if($data->status == 1){
            $sta = 'Active';
        }else{
            $sta = 'Inactive';
        }
        return  $sta;
    })

    ->editColumn('created_at', function(EventQuestion $data) {
        return  $data->created_at;
    })

    ->addColumn('ask', function(EventQuestion $data) {
      $BackUrl = 'admin/events/questions';
      if($data->is_ask == 0){
        return '<button title="Ask" class="btn btn-primary" onclick="question_ask('.$data->id.')"> Ask </button>'
        ;}else{
            return '<button class="btn btn-success btn-sm">Already Asked</button>';

        }
    })

    ->addColumn('result', function(EventQuestion $data) {
      $BackUrl = 'admin/events/questions';
      if($data->is_ask == 1){
        return '<a title="Show Result" class="btn btn-primary" href='.route('admin.events.question_answer',$data->id.'?back_url='.$BackUrl).'>Result</a>'
        ;}
    })

    ->addColumn('action', function(EventQuestion $data) {
      $BackUrl = 'admin/events/questions';
      return '<a title="Edit" href="' . route('admin.events.edit_question',$data->id.'?back_url='.$BackUrl) . '"><i class="fa fa-edit"></i></a>'
      ;
  })

    ->rawColumns(['name', 'status', 'action','ask','result'])
    ->toJson();
}





public function question_answer(Request $request){
    $data =[];

    $question_id = isset($request->id) ? $request->id :'';

    $data['question_id'] = $question_id;

    $answers = EventQuestionAnswer::where('question_id',$question_id)->get();


    $question = EventQuestion::where('id',$question_id)->first();

    if(!empty($answers)){
        $data['answers'] = $answers;
    }
    $data['question'] = $question;
    

    return view('admin.questions.answer_list', $data);
}




public function answered_user_list(Request $request){

    $question_id = isset($request->question_id) ? $request->question_id :'';

    $routeName = CustomHelper::getAdminRouteName();
    $datas = EventQuestionAnswer::where('question_id',$question_id)->orderBy('id','desc')->get();
    return Datatables::of($datas)
    ->editColumn('id', function(EventQuestionAnswer $data) {

        return  $data->id;
    })
    ->editColumn('user_name', function(EventQuestionAnswer $data) {

        $user = User::where('id',$data->user_id)->first();

        return  $user->name ?? '';
    })
    ->editColumn('option', function(EventQuestionAnswer $data) {
        $option ='';
        if($data->option_id == 1){
            $option = 'Option 1';
        }
        if($data->option_id == 2){
            $option = 'Option 2';
        }
        if($data->option_id == 3){
            $option = 'Option 3';
        }
        if($data->option_id == 4){
            $option = 'Option 4';
        }


        return $option;


    })

    ->editColumn('correct_option', function(EventQuestionAnswer $data) {
        $html = '';
        $questions = EventQuestion::where('id',$data->question_id)->first();
        //pr($questions);
        if($questions->right_option == $data->option_id){
           $html = '<button class="btn btn-success">Right</button>';
       }else{
         $html = '<button class="btn btn-danger">Wrong</button>';
     }

     return $html;


 })

    ->editColumn('time', function(EventQuestionAnswer $data) {

        return $data->time;


    })

    ->editColumn('created_at', function(EventQuestionAnswer $data) {

        return $data->created_at;


    })

    ->rawColumns(['name', 'status', 'action','ask','result','correct_option'])
    ->toJson();
}

















public function question_ask(Request $request){
    $question_id = isset($request->question_id) ? $request->question_id :'';
    if(!empty($question_id)){

        $question = EventQuestion::where('id',$question_id)->first();
        if(!empty($question)){
            if($question->is_ask ==0){
                $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/fansstudio-firebase-adminsdk-treic-a355c71bc2.json');
                $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->withDatabaseUri('https://fansstudio-default-rtdb.firebaseio.com/')
                ->create();

                $database = $firebase->getDatabase();
                $database->getReference('questions')->remove();
                $newPost = $database
                ->getReference('questions')
                ->push([
                    'qid' => $question_id,
                ]);

                EventQuestion::where('id',$question_id)->update(['is_ask'=>1]);

                $response['success'] = true;
                $response['message'] = 'Question Asked Please Wait For Result';
            }else{
               $response['success'] = false;
               $response['message'] = 'Question Already Asked';
           }
       }else{
           $response['success'] = false;
           $response['message'] = 'Question Not Found';
       }

   }else{
       $response['success'] = false;
       $response['message'] = 'No Question FOund';

   }


   return response()->json($response);
}

public function add_question(Request $request){
    $data = [];
    $id = (isset($request->id))?$request->id:0;
    $questions = '';
    if(is_numeric($id) && $id > 0){
        $questions = EventQuestion::find($id);
        if(empty($questions)){
            return redirect($this->ADMIN_ROUTE_NAME.'/events/questions');
        }
    }

    if($request->method() == 'POST' || $request->method() == 'post'){

        if(empty($back_url)){
            $back_url = $this->ADMIN_ROUTE_NAME.'/events/questions';
        }

        $name = (isset($request->name))?$request->name:'';


        $rules = [];

        $rules['event_id'] = 'required';
        $rules['question_name'] = 'required';
        $rules['option_1'] = 'required';
        $rules['option_2'] = 'required';
        $rules['option_3'] = 'required';
        $rules['option_4'] = 'required';
        $rules['right_option'] = 'required';
        $rules['time'] = 'required';




        $this->validate($request, $rules);

        $createdCat = $this->save_question($request, $id);

        if ($createdCat) {
            $alert_msg = 'Question has been added successfully.';
            if(is_numeric($id) && $id > 0){
                $alert_msg = 'Question has been updated successfully.';
            }
            return redirect(url($back_url))->with('alert-success', $alert_msg);
        } else {
            return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
        }
    }


    $page_heading = 'Add Question';

    if(isset($questions->question_name)){
        $questions_name = $questions->question_name;
        $page_heading = 'Update Question ';
    }  

    $data['page_heading'] = $page_heading;
    $data['id'] = $id;
    $data['questions'] = $questions;


    $events = Event::where('event_date','>',date('Y-m-d'))->get();


    $data['events'] = $events;


    return view('admin.questions.form', $data);

}
public function save_question(Request $request, $id=0){

    $data = $request->except(['_token', 'back_url', 'image']);
    $oldImg = '';

    $questions = new EventQuestion;

    if(is_numeric($id) && $id > 0){
        $exist = EventQuestion::find($id);

        if(isset($exist->id) && $exist->id == $id){
            $questions = $exist;

            $oldImg = $exist->image;
        }
    }
        //prd($oldImg);

    foreach($data as $key=>$val){
        $questions->$key = $val;
    }

    $isSaved = $questions->save();

    // if($isSaved){
    //     $this->saveImage($request, $questions, $oldImg);
    // }

    return $isSaved;
}



public function chats(Request $request){

    $data =[];

    $event_id = isset($request->id) ? $request->id :'';


    $data['event_id'] = $event_id;
    $data['event'] = Event::where('id',$event_id)->first();
    return view('admin.events.chat', $data);

}



public function save_message(Request $request){
    $event_id = isset($request->event_id) ? $request->event_id :'';
    $message = isset($request->message) ? $request->message :'';

    $dbArray = [];
    $dbArray['user_id'] = 0;
    $dbArray['event_id'] = $event_id;
    $dbArray['text'] =$message;


    $success = EventChat::insert($dbArray);
    if($success){
        $response['success'] = true;
    }else{
        $response['success'] = false;

    }
    return response()->json($response);


}






public function get_message(Request $request){
    $event_id = isset($request->event_id) ? $request->event_id :'';
    $page = isset($request->page) ? $request->page :1;

    $perpage = 10;


    $count = $perpage * $page;

    $chats = EventChat::where('event_id',$event_id)->skip(0)->take($count);

    $chats = $chats->get();


    $html = '';
    if(!empty($chats)){
        foreach($chats as $chat){
            $side = 'left';
            if($chat->user_id == 0){
                $side = 'right';
            }


            $html.='<li class="message '.$side.' appeared">
            <div class="avatar">
            </div>
            <div class="text_wrapper">
            <div class="text">'.$chat->text.'</div>
            </div>
            </li>';
        }
    }



    echo $html;

}

public function analysis(Request $request){
    $data = [];

    $event_id = isset($request->id) ? $request->id :'';
    if(!empty($event_id)){


        $event = Event::where('id',$event_id)->first();
        $data['event'] = $event;



        $event_users = EventUser::where('event_id',$event_id)->get();


        $data['event_id'] = $event_id;
        $data['event_users'] = count($event_users);
        $questions = [];
        $questions = EventQuestion::where('event_id',$event_id)->where('is_ask',1)->where('status',1)->get();
        if(!empty($questions)){
            $data['questions'] = $questions;
        }


        return view('admin.events.analysis', $data);
    }

    return view('admin.events.analysis', $data);
}




}