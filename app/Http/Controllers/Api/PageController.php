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

        //per reiterare la gestione del percorso delle immagini per ogni progetto
        foreach ($projects as $project) {
            if ($project->img) {
                $project->img = asset('storage/' . $project->img);
            } else {
                $project->img = '/img/placeholder.jpg';
                $project->original_name_img = 'nessuna immagine';
            }
        }

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

    //BONUS//

    //metodo per creare una API di un singolo progetto con tipo e tecnologie associate attraverso lo slug
    public function projectBySlug($slug){

        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();

        //se il progetto esiste il controllo è andato a buon fine
        if($project){
            $success = true;
            //e l'immagine presenta il percorso assoluto se esiste
            if ($project->img) {
                $project->img = asset('storage/' . $project->img);
            //se l'immagine non è presente, sarà presente il placeholder
            } else {
                $project->img = '/img/placeholder.jpg';
                $project->original_name_img = 'nessuna immagine';
            }
        //se il progetto non esiste l'operazione non è andata a buon fine
        }else{
            $success = false;
        }


        return response(compact('success', 'project'));

    }

    //metodo che restituisce l'API dei progetti per tipo
    public function projectByType($slug){

        $type = Type::where('slug', $slug)->with('projects.technologies')->first();

        if ($type) {

            foreach ($type->projects as $project) {
                if ($project->img) {
                    $project->img = asset('storage/' . $project->img);
                }
                else {
                    $project->img = '/img/placeholder.jpg';
                    $project->original_name_img = 'nessuna immagine';
                }
            }

            $success = true;
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'type'));
    }

    //metodo che restituisce l'API con l'elenco dei progetti per tecnologia
    public function projectByTechnologies($slug)
    {
        $technologies = Technology::where('slug', $slug)->with('projects.type')->first();

        if ($technologies) {

                foreach ($technologies->projects as $project) {
                    if ($project->img) {
                        $project->img = asset('storage/' . $project->img);
                    } else {
                        $project->img = '/img/placeholder.jpg';
                        $project->original_name_img = 'nessuna immagine';
                    }
                }

            $success = true;
        } else {
            $success = false;
        }
        return response()->json(compact('success', 'technologies'));
    }


}
