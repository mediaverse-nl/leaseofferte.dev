<?php


namespace App\Http\Controllers\Site;

use App\Http\Requests\Site\ContactStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartelController extends Controller
{
    public function index()
    {
        return include(base_path() .'/cartel-module/occasions.php');
    }
}
