<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\HomeInterface;
use App\Jobs\SendMails;
use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    private $homeInterface;
    public function __construct(HomeInterface $homeInterface)
    {
        $this->homeInterface = $homeInterface;
    }

    public function index()
    {
        return $this->homeInterface->index();
    }

    public function sendMails()
    {
//        $emails = User::select('email')->get();
//        foreach ($emails as $email)
//        {
//            Mail::to($email)->send(new RegisterMail($name = "Abdallah"));
//        }

//        User::chunk(5, function ($data) {
//            dispatch(new SendMails($data));
//        });
        return true;
    }
}
