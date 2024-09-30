<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //metodo in index che restituisce una API con progetti, categorie e tecnologie
    public function index(){
        $projects = Project::orderBy('id', 'desc')->with('type', 'technologies')->paginate(10);

        return response()->json($projects);
    }

    //metodo per creare una API dei tipi
    public function type(){
        $types = Type::orderBy('id', 'desc')->get();

        return response()->json($types);
    }

    //metodo per creare una API delle tecnologie
    public function technologies(){
        $technologies = Technology::orderBy('id', 'desc')->get();

        return response()->json($technologies);
    }
}
