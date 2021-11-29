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
use Yajra\DataTables\DataTables;





use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

use Storage;
use DB;
use Hash;



Class FirebaseController extends Controller
{


	private $ADMIN_ROUTE_NAME;

    public function __construct(){

        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();

        $routeName = CustomHelper::getAdminRouteName();
    }

public function index()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/fansstudio-cd84b-firebase-adminsdk-81lln-3c3a65ec6f.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://fansstudio-cd84b-default-rtdb.firebaseio.com/')
        ->create();

        $database = $firebase->getDatabase();

        $newPost = $database
        ->getReference('questions')
        ->push([
        'qid' => 1,
        ]);
   

        // $database->getReference('questions')->remove();
        //$reference =  $database->getReference('questions');




             echo '<pre>';
        print_r($newPost->getValue());
    }



}