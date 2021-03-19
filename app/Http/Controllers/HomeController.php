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
}
