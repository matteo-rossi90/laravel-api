<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //metodo in index che restituisce una API con progetti, categorie e tecnologie
    public function index(){
        $projects = Project::orderBy('id', 'desc')->with('type', 'technologies')->get();

        return response()->json($projects);
    }
}
