<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; // Import the correct base controller

class TicketController extends Controller
{
    public function index()
    {
        // Return a view for the web controller
        return view('ticket.index'); // Ensure this view exists at resources/views/ticket/index.blade.php
    }
}
