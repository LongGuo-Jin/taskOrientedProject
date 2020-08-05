<?php

namespace App\Http\Controllers;

use App\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{

    public function Organization(Request $request) {
        $organizations = Organization::all()->get()->toArray();

    }
}
