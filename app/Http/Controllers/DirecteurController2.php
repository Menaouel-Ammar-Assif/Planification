<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use App\Models\Direction;
use App\Models\Volet;
use App\Models\Vda;
use App\Models\Description;
use Carbon\Carbon;

class DirecteurController extends Controller
{
    public function DirecteurDashboard()
    {
        $currentDate = date('Y-m');
        $currentDateD = date('Y-m-d');

        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;    
        $code = $direction->code;
        $id_dir = $direction->id_dir;

        $id_act= Vda::where('id_dc', $id_dir)->pluck('id_act');
        $actions = Action::whereIn('id_act', $id_act)->get();

        $actionIds = $actions->pluck('id_act')->toArray();
        $descriptions = Description::whereIn('id_act', $actionIds)->get();

        // $latestEtats = $descriptions->groupBy('id_act')->map(function ($group) {
        //     return $group->max('etat');
        // });
        $numActions = $actions->count();

        // actions terminnes
        $etatTerm = $actions->where('etat', '100')->count();

        // actions retardées 
        $etatRet = $actions->where('etat','<>', '100')->where('df', '<',$currentDate)->count();

        // actions en cours
        $etatEnC = $numActions - ($etatTerm + $etatRet);


        $totalEtat = $actions->sum('etat');

      

        $endDateThreshold = date('Y-m-d', strtotime('+10 days', strtotime($currentDateD)));

        // Filter actions that ended within 10 days or less
        $actionsInDanger = $actions->where('df', '<=', $endDateThreshold)->count();
        

        // Calculate the average etat
        if ($numActions > 0) {
            $averageEtat = $totalEtat / $numActions;
            $averageEtat = number_format($averageEtat, 2, '.', '');
        } else {
            $averageEtat = 0;
        }

        $currentDate = Carbon::now();
        $startOfYear = Carbon::createFromFormat('Y-m-d H:i:s', $currentDate->format('Y') . '-01-01 00:00:00');
        $totalDaysInYear = $startOfYear->diffInDays($startOfYear->copy()->endOfYear());
        $daysElapsed = $startOfYear->diffInDays($currentDate);
        $percentageElapsed = ($daysElapsed / $totalDaysInYear) * 100;
        $percentageElapsed = number_format($percentageElapsed, 2, '.', '');

        return view('directeur.directeur_dashboard', compact('dir', 'actions','code','currentDate','descriptions','averageEtat','percentageElapsed','etatTerm','etatRet','etatEnC', 'actionsInDanger'));
    }


    public function add_desc(Request $request)
    {
        $currentDate = date('Y-m-d');

        $id_act = $request->input('id_act');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        Description::create([
            'id_act'=> $id_act,
            'faite'=> $faite,
            'a_faire' =>$a_faire,
            'probleme' =>$probleme,
            'date' =>$currentDate,
            'etat' =>$rangeValue,
        ]);

        $maxEtat = Description::where('id_act', $id_act)->max('etat');

        $action = Action::where('id_act', $id_act)->first();

        if ($action) {
            // Update the existing record with the maximum etat
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    } 

}
