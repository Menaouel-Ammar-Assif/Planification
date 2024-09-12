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
use App\Models\DescriptionCop;
use App\Models\Objectif;
use App\Models\SousObjectif;
use App\Models\Indicateur;
use App\Models\ActionsPro;
use App\Models\ActionsProDr;
use App\Models\ActionsCopDr;
use App\Models\ActCopDrInd;
use App\Models\ActCopInd;

use App\Models\ActionsCop;
use App\Models\CopCible;
use App\Models\CopValeur;
use App\Models\NumDenom;
use App\Models\NumDenomVals;
use App\Models\prioritaires;
use App\Models\Cause;
use Carbon\Carbon;
use LDAP\Result;

class DirecteurController extends Controller
{
    public function DirecteurDashboard()
    {
        $day = date('d');
        $month = date('m');
        $year = date('Y');
        $Month = date('M');
        // $Month_pre = date('M', strtotime('+10 days', strtotime($Month)));

        $NumDenom = NumDenom::orderBy('id_num_denom')->get();

        $currentDate = date('Y-m');
        $currentDateD = date('Y-m-d');

        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;
        $code = $direction->code;
        $id_dir = $direction->id_dir;

        if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14) {
            $id_act= Vda::where('id_dc', $id_dir)->pluck('id_act');
            $actions = Action::whereIn('id_act', $id_act)->orderBy('id_act')->get();

        }else{
            $id_act= Vda::where('id_dr', $id_dir)->pluck('id_act');
            $actions = Action::whereIn('id_act', $id_act)->orderBy('id_act')->get();
        }


        $descriptionCounts = [];
        foreach ($actions as $action)
        {
            $descriptionCounts[$action->id_act] = Description::where('id_act', $action->id_act)
            ->where('mois',$month)
            // ->where('currentDateD','>', $action->df)
            ->count();
        }


        $actionIds = $actions->pluck('id_act')->toArray();
        $descriptions = Description::whereIn('id_act', $actionIds)->orderByDesc('mois')->get();

        $descriptionsMPre = Description::whereIn('id_act', $actionIds)->where('mois', ($month -1))->orderByDesc('mois')->get();

        $desc_idAct_date = Description::whereIn('id_act', $actionIds)->select('id_act','mois')->orderByDesc('mois')->get();

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
        $actionsInDanger = $actions->where('df', '<=', $endDateThreshold)->where('df', '>=', $currentDateD)->count();


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

        return view('directeur.directeur_dashboard', compact('NumDenom','dir', 'actions','code','currentDate','currentDateD','descriptions','desc_idAct_date','averageEtat','percentageElapsed','etatTerm','etatRet','etatEnC', 'actionsInDanger','month','Month','descriptionCounts','day','year','descriptionsMPre'));

    }

    public function add_desc(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');
        $month = date('m');

        $id_act = $request->input('id_act');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = Action::where('id_act', $id_act)->first();
        if ($action->etat  != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        $etat_mois = ($rangeValue - $etatT);

        Description::create([
            'id_act'=> $id_act,
            'faite'=> $faite,
            'a_faire' =>$a_faire,
            'probleme' =>$probleme,
            'date' =>$currentDate,
            'etat' =>$rangeValue,
            'mois' => $month,
            'etat_mois' => $etat_mois,
        ]);

        $maxEtat = Description::where('id_act', $id_act)->max('etat');



        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }

    public function add_desc_pre(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');
        $month = date('m');

        $id_act = $request->input('id_act');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = Action::where('id_act', $id_act)->first();
        if ($action->etat  != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        $etat_mois = ($rangeValue - $etatT);

        Description::create([
            'id_act'=> $id_act,
            'faite'=> $faite,
            'a_faire' =>$a_faire,
            'probleme' =>$probleme,
            'date' =>$currentDate,
            'etat' =>$rangeValue,
            'mois' => $month -1,
            'etat_mois' => $etat_mois,
        ]);

        $maxEtat = Description::where('id_act', $id_act)->max('etat');

        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }

    public function add_desc_pre2(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');
        $month = date('m');

        $id_act = $request->input('id_act');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = Action::where('id_act', $id_act)->first();
        if ($action->etat  != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        $etat_mois = ($rangeValue - $etatT);

        Description::create([
            'id_act'=> $id_act,
            'faite'=> $faite,
            'a_faire' =>$a_faire,
            'probleme' =>$probleme,
            'date' =>$currentDate,
            'etat' =>$rangeValue,
            'mois' => $month -2,
            'etat_mois' => $etat_mois,
        ]);

        $maxEtat = Description::where('id_act', $id_act)->max('etat');

        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }

    public function update_desc(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');

        $id_act = $request->input('id_act');
        $id_desc = $request->input('id_desc');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = Action::where('id_act', $id_act)->first();
        if ($action->etat  != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        if ($rangeValue > $etatT) {

        }else {

        }

        $description = Description::find($id_desc);
        if ($description) {
            $description->faite= $faite;
            $description->a_faire = $a_faire;
            $description->probleme = $probleme;
            $description->date_update = $currentDate;
            $description->etat = $rangeValue;

            if ($rangeValue > $etatT) {
                $etat_mois2 = ($rangeValue - $etatT);
                $SS = $description->etat_mois;
                $Z = $etat_mois2 + $SS;
            }else {
                $etat_mois2 = ($etatT - $rangeValue);
                $SS = $description->etat_mois;
                $Z = $SS - $etat_mois2;
            }

            $description->etat_mois = $Z;
            $description->save();
        }else {
            return back()->with('error', 'Not changed');
        };

        $maxEtat = Description::where('id_act', $id_act)->max('etat');


        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }

    public function update_desc2(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');

        $id_act = $request->input('id_act');
        $id_desc = $request->input('id_desc');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = Action::where('id_act', $id_act)->first();
        if ($action->etat  != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        if ($rangeValue > $etatT) {

        }else {

        }

        $description = Description::find($id_desc);
        if ($description) {
            $description->faite= $faite;
            $description->a_faire = $a_faire;
            $description->probleme = $probleme;
            $description->date_update = $currentDate;
            $description->etat = $rangeValue;

            if ($rangeValue > $etatT) {
                $etat_mois2 = ($rangeValue - $etatT);
                $SS = $description->etat_mois;
                $Z = $etat_mois2 + $SS;
            }else {
                $etat_mois2 = ($etatT - $rangeValue);
                $SS = $description->etat_mois;
                $Z = $SS - $etat_mois2;
            }

            $description->etat_mois = $Z;
            $description->save();
        }else {
            return back()->with('error', 'Not changed');
        };

        $maxEtat = Description::where('id_act', $id_act)->max('etat');


        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }

    public function Proposition()
    {
        $NumDenom = NumDenom::orderBy('id_num_denom')->get();

        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;
        $code = $direction->code;
        $id_dir = $direction->id_dir;

        // $objectifs = Objectif::orderBy('id_obj')->get();
        // $sousobjectifs = SousObjectif::orderBy('id_sous_obj')->get();
        // $indicateurs = Indicateur::orderBy('id_ind')->get();
        $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();

        // Fetch only the actions created by the authenticated user
            if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14) {
                $actions = ActionsPro::whereHas('actionsProDrs', function ($query) {
                    $query->where('created_by', auth()->user()->id_dir);
                })->with(['actionsProDrs'])->get();
            }else{
                $actions = ActionsPro::whereHas('actionsProDrs', function ($query) {
                    $query->where('id_dir', auth()->user()->id_dir);
                })->with(['actionsProDrs'])->get();
            }

        return view('directeur.directeur_proposition', compact('dir', 'code', 'directionsDr', 'actions','NumDenom'));
    }



    public function add_act_pro(Request $request)
    {
        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;

        $validatedData = $request->validate([
            'act_pro' => 'required|string',
            'dd' => 'required|date',
            'df' => 'required|date',
            'selected_dr' => 'required|array',
            'selected_dr.*' => 'integer|exists:directions,id_dir',
        ]);


        $actionsPro = new ActionsPro();
        $actionsPro->lib_act_pro = $validatedData['act_pro'];
        $actionsPro->dd = $validatedData['dd'];
        $actionsPro->df = $validatedData['df'];
        $actionsPro->save();

        $id_act_pro = $actionsPro->id_act_pro;

        if(is_null($id_act_pro)){

            return redirect()->back()->withErrors(['msg' =>'Failed to save the action']);
        }

            foreach ($validatedData['selected_dr'] as $id_dir) {
                $direction = Direction::find($id_dir);
                $actionsProDr = new ActionsProDr();
                $actionsProDr->id_act_pro = $id_act_pro;
                $actionsProDr->id_dir = $id_dir;
                $actionsProDr->created_by = auth()->user()->id_dir;
                $actionsProDr->lib_created_by = $dir;
                $actionsProDr->lib_dir = $direction->lib_dir;

                $actionsProDr->save();
            }

        return redirect()->back()->with('success', 'Action proposée ajoutée avec succès');
    }




    public function getSousObjs($objId)
    {

        $idObj = Objectif::where('id_obj', $objId)->pluck('id_obj');

        $sousObjs = SousObjectif::whereIn('id_obj', $idObj)->select('id_sous_obj', 'lib_sous_obj')->get();

        return json_encode($sousObjs);
    }






    public function add_act_cop(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'obj' => 'required|exists:objectifs,id_obj',
            'sousObjList' => 'required|exists:sousObjectifs,id_sous_obj',
            'act_cop_dr' => 'required|string',
            'dd' => 'required|date',
            'df' => 'required|date|after_or_equal:dd',
            'selected_indicateurs' => 'required|array',
            'selected_indicateurs.*' => 'exists:indicateurs,id_ind',
        ]);

        // Create a new ActionsCopDr instance
        $actCopDr = new ActionsCopDr();
        $actCopDr->lib_act_cop_dr = $validatedData['act_cop_dr'];
        $actCopDr->dd = $validatedData['dd'];
        $actCopDr->df = $validatedData['df'];
        $actCopDr->id_obj = $validatedData['obj'];
        $actCopDr->id_sous_obj = $validatedData['sousObjList'];
        $actCopDr->save();


        foreach ($validatedData['selected_indicateurs'] as $indicatorId) {
            ActCopDrInd::create([
                'id_act_cop_dr' => $actCopDr->id_act_cop_dr,
                'id_ind' => $indicatorId,
                'created_by' => auth()->user()->id_dir, // Assuming you have authentication in place to get the currently logged-in user
            ]);
        }

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Action ajoutée avec succès.');
    }

    public function Cop()
    {
        $id_act_cop_dr = ActCopDrInd::where('created_by', auth()->user()->id_dir)->pluck('id_act_cop_dr');

        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;
        $code = $direction->code;
        $id_dir = $direction->id_dir;

        $objectifs = Objectif::orderBy('id_obj')->get();
        $sousobjectifs = SousObjectif::orderBy('id_sous_obj')->get();
        $indicateursSelect = Indicateur::orderBy('id_ind')->get();
        $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();
        $NumDenom = NumDenom::orderBy('id_num_denom')->get();


        $data = [];

        foreach ($objectifs as $objectif) {
            $sousObjectifs = SousObjectif::where('id_obj', $objectif->id_obj)->get();

            foreach ($sousObjectifs as $sousObjectif) {
                $actions = ActionsCopDr::where('id_sous_obj', $sousObjectif->id_sous_obj)->whereIn('id_act_cop_dr', $id_act_cop_dr)->get();

                foreach ($actions as $action) {
                    $indicateurs = $action->indicateurs;

                    if ($indicateurs->count() > 1) {
                        $indicateursText = $indicateurs->pluck('lib_ind')->unique()->implode(', ');
                    } else {
                        $indicateursText = $indicateurs->first()->lib_ind;
                    }


                    $data[] = [
                        'objectif' => $objectif->lib_obj,
                        'sous_objectif' => $sousObjectif->lib_sous_obj,
                        'action' => $action->lib_act_cop_dr,
                        'date_debut' => Carbon::parse($action->dd)->format('d-m-y'),
                        'date_fin' => Carbon::parse($action->df)->format('d-m-y'),
                        'indicateurs' => $indicateursText,
                    ];
                }
            }
        }


        return view('directeur.directeur_cop', compact('dir', 'code', 'objectifs', 'sousobjectifs', 'indicateursSelect', 'directionsDr','data','NumDenom'));
    }

//     public function CopAddPage (){
//         $currentMonth = date('m');
//         $month = date('m');
//         $year = date('Y');
//         $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
//         $dir = $direction->lib_dir;
//         $code = $direction->code;
//         $id_dir = $direction->id_dir;

//         $NumDenomVals = NumDenomVals::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->where('id_dc', auth()->user()->id_dir)->get();

//         $NumDenom = NumDenom::orderBy('id_num_denom')->get();

//         $hasNegativeEcart = CopValeur::where('ecart', '<', 0)->exists();


//         $periode = CopValeur::whereYear('periode', '=', $year)
//         ->whereMonth('periode', '=', $month)
//         ->pluck('periode')
//         ->first();


//         $periods = [
//             'trimestre' => [1, 2, 3],
//             'semestre' => [1, 2, 3, 4, 5, 6],
//             'neuf_mois' => [1, 2, 3, 4, 5, 6, 7, 8, 9],
//             'annuel' => range(1, 12),
//         ];

//         $currentPeriod = null;
//         foreach ($periods as $period => $months) {
//             if (in_array($currentMonth, $months)) {
//                 $currentPeriod = $period;
//                 break;
//             }
//         }

// return view('directeur.copAdd', compact('month', 'NumDenom', 'year', 'dir', 'code', 'NumDenomVals', 'hasNegativeEcart', 'currentPeriod', 'periode'));
// }

public function CopAddPage() {
    $currentMonth = date('m');
    $month = date('m');

    $year = date('Y');
    $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
    $dir = $direction->lib_dir;
    $code = $direction->code;
    $id_dir = $direction->id_dir;

    // Fetching actions associated with the direction
    $actionIds = Action::where('id_dir', $direction->id_dir)
    ->whereNotNull('id_cop') // Filter only actions where id_cop is not null
    ->pluck('id_act');

    // Fetching actionsCop associated with the fetched actions
    $actionsCopIds = ActionsCop::whereIn('id_act', $actionIds)->pluck('id_act_cop');

    // Fetching actCopInd associated with the fetched actionsCop
    $indicateurIds = ActCopInd::whereIn('id_act_cop', $actionsCopIds)->pluck('id_ind');

    // Fetching indicateurs associated with the fetched indicateurIds
    $indicateurs = Indicateur::whereIn('id_ind', $indicateurIds)
                    ->orderBy('id_ind')
                    ->get();

    $NumDenomVals = NumDenomVals::whereYear('date', '=', $year)
                    ->whereMonth('date', '=', $month)
                    ->where('id_dc', auth()->user()->id_dir)
                    ->get();

    $NumDenom = NumDenom::orderBy('id_num_denom')->get();

    if ($month >= 1 && $month <= 3 ) {
        $year = $year -1;
        $myPeriod = '12';
    }elseif($month >= 4 && $month <= 6) {
        $myPeriod = '03';
    }elseif ($month >= 7 && $month <= 9) {
        $myPeriod = '06';
    }else {
        $myPeriod = '09';
    }
    $idInds = $indicateurs->pluck('id_ind');

    $latestCobValeur = CopValeur::whereIn('id_ind', $idInds)
            ->whereYear('periode', $year)
            ->whereMonth('periode', $myPeriod )
            ->where('ecartType', 'négatif')
            ->get();

    // $indicateurs = $indicateurs->map(function ($indicateur) use ($year, $myPeriod) {
    //     $latestCobValeur = CopValeur::where('id_ind', $indicateur->id_ind)
    //         ->whereYear('periode', $year)
    //         ->whereMonth('periode', '09' )
    //         ->where('ecartType', 'négative')
    //         ->get();
    //     //
    //     $indicateur->latestCobValeur = $latestCobValeur;
    //     return $indicateur;
    //     // if ($latestCobValeur && $latestCobValeur->ecartType =='négative') {
    //     //     $indicateur->latest_ecart = $latestCobValeur->ecartType;
    //     //     $indicateur->latest_periode = $latestCobValeur->periode;

    //     // }
    //     // return null;
    // });
    // $latestCobValeur = $indicateurs->pluck('latestCobValeur');

    return view('directeur.copAdd', compact('month', 'year', 'dir', 'code', 'indicateurs', 'NumDenom', 'NumDenomVals','latestCobValeur'));
}


    public function CopAddStore(Request $request){
        // $month = date('m');
        $year = date('Y');

        $month = $request->input('month');

        $NumDenom = NumDenom::orderBy('id_num_denom')->where('id_dc', auth()->user()->id_dir)->get();
        $NumDenomVals = NumDenomVals::orderBy('id_num_denom')->where('id_dc', auth()->user()->id_dir)->get();

        $NumDenomValss = NumDenomVals::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->where('id_dc', auth()->user()->id_dir)->get();

        foreach ($NumDenom as $item) {
            foreach ($NumDenomVals as $NumDenomVal){
                // if ($item->id_num_denom == $NumDenomVal->id_num_denom){
                    $NumDenomVals = NumDenomVals::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->where('id_num_denom', $item->id_num_denom)->where('id_dc', auth()->user()->id_dir)->firstOrNew(['id_num_denom' => $item->id_num_denom]);
                    if ($NumDenomVals->exists){
                            $NumDenomVals->update([
                                'id_num_denom'=> $item->id_num_denom,
                                'val'=> $request->input('chmp'.$item->id_num_denom),
                                'id_dc' => auth()->user()->id_dir,
                                'unite' => $item->unite,
                                'date' => $year.'-'.$month.'-01',
                                ]);
                    }
                    else {
                        NumDenomVals::create([
                            'id_num_denom'=> $item->id_num_denom,
                            'val'=> $request->input('chmp'.$item->id_num_denom),
                            'id_dc'=> auth()->user()->id_dir,
                            'unite' => $item->unite,
                            'date'=> $year.'-'.$month.'-01',
                        ]);
                    }
                // }
            }
        }

        return redirect()->back()->with('success', 'Ajoutée avec succès.');
    }


    public function Analyse (){
        $month = date('m');
        $currentMonth = date('m');
        $year = date('Y');
        $yearC = date('Y');
        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;
        $code = $direction->code;
        $id_dir = $direction->id_dir;

        $actionIds = Action::where('id_dir', $direction->id_dir)->pluck('id_act');

        $actionsCopIds = ActionsCop::whereIn('id_act', $actionIds)->pluck('id_act_cop');

        $indicateurIds = ActCopInd::whereIn('id_act_cop', $actionsCopIds)->pluck('id_ind');
        $indicateurs = Indicateur::whereIn('id_ind', $indicateurIds)->orderBy('id_ind')->get();

        if ($month >= 1 && $month <= 3 ) {
            $yearC = $year -1;
            $myPeriod = '12';
        }elseif($month >= 4 && $month <= 6) {
            $myPeriod = '03';
        }elseif ($month >= 7 && $month <= 9) {
            $myPeriod = '06';
        }else {
            $myPeriod = '09';
        }

        $idInds = $indicateurs->pluck('id_ind');

        $latestCobValeur = CopValeur::whereIn('id_ind', $idInds)
        ->whereYear('periode', $yearC)
        ->whereMonth('periode', $myPeriod)
        ->get()
        ->map(function ($item) {
            $item->periode = Carbon::parse($item->periode);
            return $item;
        });

        // $latestCause = Cause::whereIn('id_ind', $idInds)
        // ->whereYear('periode', $yearC)
        // ->whereMonth('periode', $myPeriod)
        // ->whereNotNull('lib_cause')
        // ->get();

        return view('directeur.directeur_analyse', compact('month', 'year','dir','code', 'direction', 'indicateurs','latestCobValeur'));
    }




    // public function CauseStore(Request $request)
    // {
    //     $currentDate = now();

    //     $request->validate([
    //         'indicateur_ids' => 'required|array',
    //         'periode' => 'required|array',
    //         'ecartType' => 'required|array',
    //         'cause' => 'nullable|array',
    //         'action_corrective' => 'nullable|array',
    //     ]);

    //     $id_dir = auth()->user()->id_dir;

    //     foreach ($request->indicateur_ids as $index => $indicateur) {
    //         if ($request->ecartType[$indicateur] == 'négatif') {
    //             $periode = $request->periode[$indicateur];

    //             Cause::create([
    //                 'id_ind' => $indicateur,
    //                 'periode' => $periode,
    //                 'date_remplissage' => $currentDate,
    //                 'lib_cause' => $request->cause[$indicateur] ?? null,
    //                 'lib_correct' => $request->action_corrective[$indicateur] ?? null,
    //                 'id_dir' => $id_dir,
    //             ]);
    //         }
    //     }

    //     return redirect()->back()->with('success', 'Enregistré avec succès.');
    // }

   

    public function CauseStore(Request $request)
{
    $selectedMonth = $request->input('month');
    $currentYear = now()->year;
    $periode = sprintf('%04d-%02d-01', $currentYear, $selectedMonth);

    $indicateurIds = $request->input('indicateur_ids');
    $causeData = $request->input('cause');
    $actionCorrectiveData = $request->input('action_corrective');

    $updateOccurred = false;

    foreach ($indicateurIds as $indicateurId) {
        $cause = $causeData[$indicateurId] ?? null;
        $actionCorrective = $actionCorrectiveData[$indicateurId] ?? null;

        // Skip if both cause and action corrective are empty
        if (empty($cause) && empty($actionCorrective)) {
            continue;
        }

        // Prepare data to update or create
        $data = [
            'periode' => $periode,
            'date_remplissage' => now(),
        ];

        // Add to data array only if not empty
        if (!empty($cause)) {
            $data['lib_cause'] = $cause;
        }

        if (!empty($actionCorrective)) {
            $data['lib_correct'] = $actionCorrective;
        }

        // Check if a record exists for the given indicateur
        $existingCause = Cause::where('id_ind', $indicateurId)
            ->orderBy('periode', 'desc')
            ->first();

        if ($existingCause && $existingCause->periode === $periode) {
            // Update only if the existing record is for the last period
            $existingCause->update($data);
            $updateOccurred = true;
        } elseif (!$existingCause) {
            // Create a new record if none exists
            Cause::create(array_merge($data, [
                'id_ind' => $indicateurId,
                'id_dir' => auth()->user()->id_dir,
            ]));
        }
    }

    if ($updateOccurred) {
        return redirect()->back()->with('success', 'Mise à jour avec succès!');
    } else {
        return redirect()->back()->with('info', 'Aucune mise à jour n a été faite.');
    }
}




    




    public function fetchCauseAction(Request $request)
{
    $month = $request->input('month');
    $yearC = date('Y');

    if ($month == '12') {
        $yearC -= 1;
    }

    $indicateurIds = Indicateur::pluck('id_ind');

    $latestCause = Cause::whereIn('id_ind', $indicateurIds)
        ->whereYear('periode', $yearC)
        ->whereMonth('periode', $month)
        ->get();

    $latestCopValeur = CopValeur::whereIn('id_ind', $indicateurIds)
        ->whereYear('periode', $yearC)
        ->whereMonth('periode', $month)
        ->with('cible')
        ->get();

    // Merge the two collections
    $data = $latestCopValeur->map(function ($item) use ($latestCause) {
        $cause = $latestCause->where('id_ind', $item->id_ind)->first();
        return [
            'id_ind' => $item->id_ind,
            'result' => $item->result,
            'cible' => $item->cible,
            'ecart' => $item->ecart,
            'ecartType' => $item->ecartType,
            'lib_cause' => $cause ? $cause->lib_cause : null,
            'lib_correct' => $cause ? $cause->lib_correct : null,
        ];
    });

    return response()->json(['data' => $data]);
}

    public function addMonth($month){
        $year = date('Y');

        $NumDenom = NumDenom::orderBy('id_num_denom')->where('id_dc', auth()->user()->id_dir)->get();

        $NumDenomVals = NumDenomVals::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->where('id_dc', auth()->user()->id_dir)->select('id_num_denom', 'val')->get();

        $months = [
            3 => 'trimestre',
            6 => 'semestre',
            9 => 'neuf mois',
            12 => 'annuel',
        ];
        $month = (int)$month;
        $m = $months[$month] ;

        $response = [
                'month' => $m,
                'year' => $year,
                'NumDenom' => $NumDenom,
                'NumDenomVals' => $NumDenomVals,
            ];
        return response()->json($response);
    }

    public function addMonthTwo($month){

        $year = date('Y');

        // $NumDenom = NumDenom::orderBy('id_num_denom')->where('id_dc', auth()->user()->id_dir)->get();

        $NumDenomVals = NumDenomVals::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->select('id_num_denom', 'val')->get();

        $months = [
            3 => 'trimestre',
            6 => 'semestre',
            9 => 'neuf mois',
            12 => 'annuel',
        ];
        $month = (int)$month;
        $m = $months[$month] ;

        $response = [
                'month' => $m,
                'year' => $year,
                // 'NumDenom' => $NumDenom,
                'NumDenomVals' => $NumDenomVals,
            ];
        return response()->json($response);

    }

    public function DirecteurPageCalculate(){
        $month = date('m');
        $NumDenom = NumDenom::orderBy('id_num_denom')->get();
        $Direction = Direction::orderBy('id_dir')->where('type_dir', 'dc')->select('id_dir', 'lib_dir' )->get();
        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;
        $code = $direction->code;
        $id_dir = $direction->id_dir;

        return view('directeur.directeur_addValue', compact('month','NumDenom', 'Direction', 'dir', 'code'));

    }



    public function DirecteurCalculate(Request $request){

        $year = date('Y');
        // CobValeur::
        $Indicateur =  Indicateur::orderBy('id_ind')->get();
        $NumDenomVals = NumDenomVals::get();
        $NumDenom = NumDenom::orderBy('id_num_denom')->get();

        // CobCible::where('id_ind', )
        $month = $request->input('month');
        
        foreach ($Indicateur as $ind) {
            // foreach ($NumDenom as $nd) {
                if ($ind->id_chiffre == '') {

                    $num = $request->input('chmp'.$ind->id_num);
                    $denom = $request->input('chmp'.$ind->id_denom);
                    if ($denom == '') {
                        $Result = '0';
                    }else {
                        if ($ind->id_ind != '8') {
                            $R = ( ($num / $denom)*100 );
                            $Result = number_format($R, 4, '.', '');
                        }else{    
                            $R = ( ($num / $denom) );
                            $Result = number_format($R, 4, '.', '');
                        }
                    }

                        $CobValeur = CopValeur::whereYear('periode', '=', $year)->whereMonth('periode', '=', $month)->firstOrNew(['id_ind' => $ind->id_ind]);
                        if ($CobValeur->exists)
                        {
                            $CobCible = CopCible::where('id_ind', $ind->id_ind)->where('annee', $year)->first();
                            $cible = $CobCible->cible;
                            if ($month == '03') {
                                $cibleP = $CobCible->cibleTrimestre;
                            }elseif ($month == '06') {
                                $cibleP = $CobCible->cibleSemestre;
                            }elseif ($month == '09') {
                                $cibleP = $CobCible->cibleT_Trimestre;
                            }

                            if ($cibleP == '') {
                                $EP = '0';
                                $eTP = '/';
                            }else {
                                $eP = ((($Result / $cibleP)-1)*100);
                                $EP = number_format($eP, 4, '.', '');
                                if ($eP >= '0') {
                                    $tP = 'positif';
                                }else {
                                    $tP = 'négatif';
                                }

                                if ($ind->type_p == $tP) {
                                    $eTP = 'positif';
                                }else {
                                    $eTP = 'négatif';
                                }
                            }

                            if ($cible == '') {
                                $E = '0';
                                $eT = '/';
                            }else {
                                $e = ((($Result / $cible)-1)*100);
                                $E = number_format($e, 4, '.', '');
                                if ($e >= '0') {
                                    $t = 'positif';
                                }else {
                                    $t = 'négatif';
                                }

                                if ($ind->type_p == $t) {
                                    $eT = 'positif';
                                }else {
                                    $eT = 'négatif';
                                }
                            }

                            $CobValeur->update([
                                'id_ind' => $ind->id_ind,
                                'num' => $num,
                                'denom' => $denom,
                                'result' => $Result,
                                'periode' => $year.'-'.$month.'-'.'1',
                                'ecart' => $E,
                                'ecartType' => $eT,
                                'ecartP' => $EP,
                                'ecartTypeP' => $eTP,
                            ]);
                        }else
                        {
                            $CobCible = CopCible::where('id_ind', $ind->id_ind)->where('annee', $year)->first();
                            $cible = $CobCible->cible;

                            if ($month == '03') {
                                $cibleP = $CobCible->cibleTrimestre;
                            }elseif ($month == '06') {
                                $cibleP = $CobCible->cibleSemestre;
                            }elseif ($month == '09') {
                                $cibleP = $CobCible->cibleT_Trimestre;
                            }

                            if ($cibleP == '') {
                                $EP = '0';
                                $eTP = '/';
                            }else {
                                $eP = ((($Result / $cibleP)-1)*100);
                                $EP = number_format($eP, 4, '.', '');
                                if ($eP >= '0') {
                                    $tP = 'positif';
                                }else {
                                    $tP = 'négatif';
                                }

                                if ($ind->type_p == $tP) {
                                    $eTP = 'positif';
                                }else {
                                    $eTP = 'négatif';
                                }
                            }

                            if ($cible == '') {
                                $E = '0';
                                $eT = '/';
                            }else {
                                $e = ((($Result / $cible)-1)*100);
                                $E = number_format($e, 4, '.', '');

                                if ($e >= '0') {
                                    $t = 'positif';
                                }else {
                                    $t = 'négatif';
                                }

                                if ($ind->type_p == $t) {
                                    $eT = 'positif';
                                }else {
                                    $eT = 'négatif';
                                }
                            }

                            CopValeur::create([
                                'id_ind' => $ind->id_ind,
                                'num' => $num,
                                'denom' => $denom,
                                'result' => $Result,
                                'periode' => $year.'-'.$month.'-'.'1',
                                'id_cop_cible' => $CobCible->id_cop_cible,
                                'ecart' => $E,
                                'ecartType' => $eT,
                                'ecartP' => $EP,
                                'ecartTypeP' => $eTP,
                            ]);
                        }

                }else {
                    $chiffre = $request->input('chmp'.$ind->id_chiffre);

                    $CobValeur = CopValeur::whereYear('periode', '=', $year)->whereMonth('periode', '=', $month)->firstOrNew(['id_ind' => $ind->id_ind]);
                        if ($CobValeur->exists)
                        {
                            $CobCible = CopCible::where('id_ind', $ind->id_ind)->where('annee', $year)->first();
                            $cible = $CobCible->cible;

                            if ($month == '03') {
                                $cibleP = $CobCible->cibleTrimestre;
                            }elseif ($month == '06') {
                                $cibleP = $CobCible->cibleSemestre;
                            }elseif ($month == '09') {
                                $cibleP = $CobCible->cibleT_Trimestre;
                            }


                            if ($cibleP == '') {
                                $EP = '0';
                                $eTP = '/';
                            }else {
                                $eP = ((($chiffre / $cibleP)-1)*100);
                                $EP = number_format($eP, 4, '.', '');

                                if ($eP >= '0') {
                                    $tP = 'positif';
                                }else {
                                    $tP = 'négatif';
                                }

                                if ($ind->type_p == $tP) {
                                    $eTP = 'positif';
                                }else {
                                    $eTP = 'négatif';
                                }
                            }


                            if ($cible == '') {
                                $E = '0';
                                $eT = '/';
                            }else {
                                $e = ((($chiffre / $cible)-1)*100);
                                $E = number_format($e, 4, '.', '');

                                if ($e >= '0') {
                                    $t = 'positif';
                                }else {
                                    $t = 'négatif';
                                }

                                if ($ind->type_p == $t) {
                                    $eT = 'positif';
                                }else {
                                    $eT = 'négatif';
                                }
                            }

                            $CobValeur->update([
                                'id_ind' => $ind->id_ind,

                                'result' => $chiffre,
                                'periode' => $year.'-'.$month.'-'.'1',
                                'ecart' => $E,
                                'ecartType' => $eT,
                                'ecartP' => $EP,
                                'ecartTypeP' => $eTP,
                            ]);
                        }else
                        {
                            $CobCible = CopCible::where('id_ind', $ind->id_ind)->where('annee', $year)->first();
                            $cible = $CobCible->cible;

                            if ($month == '03') {
                                $cibleP = $CobCible->cibleTrimestre;
                            }elseif ($month == '06') {
                                $cibleP = $CobCible->cibleSemestre;
                            }elseif ($month == '09') {
                                $cibleP = $CobCible->cibleT_Trimestre;
                            }

                            if ($cibleP == '') {
                                $EP = '0';
                                $eTP = '/';
                            }else {
                                $eP = ((($chiffre / $cibleP)-1)*100);
                                $EP = number_format($eP, 4, '.', '');

                                if ($eP >= '0') {
                                    $tP = 'positif';
                                }else {
                                    $tP = 'négatif';
                                }

                                if ($ind->type_p == $tP) {
                                    $eTP = 'positif';
                                }else {
                                    $eTP = 'négatif';
                                }
                            }

                            if ($cible == '') {
                                $E = '0';
                                $eT = '/';
                            }else {
                                $e = ((($chiffre / $cible)-1)*100);
                                $E = number_format($e, 4, '.', '');

                                if ($e >= '0') {
                                    $t = 'positif';
                                }else {
                                    $t = 'négatif';
                                }

                                if ($ind->type_p == $t) {
                                    $eT = 'positif';
                                }else {
                                    $eT = 'négatif';
                                }
                            }

                            CopValeur::create([
                                'id_ind' => $ind->id_ind,

                                'result' => $chiffre,
                                'periode' => $year.'-'.$month.'-'.'1',
                                'id_cop_cible' => $CobCible->id_cop_cible,
                                'ecart' => $E,
                                'ecartType' => $eT,
                                'ecartP' => $EP,
                                'ecartTypeP' => $eTP,
                            ]);
                        }
                }
        }
        return redirect()->route('directeur.pageCalculate')->with('success', 'Les calculs ajoutés');

    }













    public function DirecteurActionsPrio()
    {
        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;
        $code = $direction->code;

        $prioritaires = prioritaires::orderBy('id_p')->get();
        $nmbr_act_p= $prioritaires->count();

        $directionsDc = Direction::where('type_dir', 'dc')->orderBy('ordre')->get();
        $id_dirDc = $directionsDc->pluck('id_dir');

        $id_actDc= Vda::whereIn('id_dc', $id_dirDc)->pluck('id_act');
        $actionsDc = Action::whereIn('id_act', $id_actDc)->orderBy('id_act')->get();
        $numActDc = $actionsDc->count();

        $act_p = Action::whereNotNull('id_p')->orderBy('id_act')->get();
        $nmbr_act_p_ = $act_p->count();

        $prioritaires = prioritaires::orderBy('id_p')->get();
        $nmbr_act_p= $prioritaires->count();
        $id_p = $prioritaires->pluck('id_p');

        $directionsDc = Direction::where('type_dir', 'dc')->orderBy('ordre')->get();
        $currentDate = date('Y-m');
        $act_p = Action::whereNotNull('id_p')->orderBy('id_act')->get();
        $id_act_p = $act_p->pluck('id_act');
        $descriptions = Description::whereIn('id_act', $id_act_p)->orderByDesc('mois')->get();

        $NumDenom = NumDenom::orderBy('id_num_denom')->get();

        return view('directeur.directeur_actionsPrio', compact('dir', 'code','nmbr_act_p','numActDc','nmbr_act_p_','prioritaires','act_p','directionsDc','currentDate','descriptions','NumDenom'));
    }


    public function DirecteurActionsCop()
    {
        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;
        $code = $direction->code;
        $NbActCop = ActionsCop::select('id_act_cop')->count();

        $user = auth()->user();

        $objectifs = Objectif::orderBy('id_obj')->with([
            'sousObjectifs.actionsCop.actions.direction' => function ($query) use ($user) {
                $query->where('id_dir', $user->id_dir);
            },
            'sousObjectifs.actionsCop.actCopInd'
        ])->get();


        $object= $objectifs->pluck('id_obj');
        $NumDenom = NumDenom::orderBy('id_num_denom')->get();

        return view('directeur.directeur_actionsCop', compact('dir', 'code', 'NbActCop', 'objectifs','object','NumDenom'));
    }

    public function subAction($id_act)
    {
        $info = Description::where('id_act', $id_act)->orderByDesc('mois')->get();

        return response()->json([ 'infos' => $info ]);
    }

    public function DrCop()
    {
        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;
        $code = $direction->code;
        $NumDenom = NumDenom::orderBy('id_num_denom')->get();

        $month = date('m');
        $year = date('Y');
        $JSdate = now();

        $SousObjectif = SousObjectif::orderBy('id_sous_obj')->get();
        $objectifs = Objectif::orderBy('id_obj')->get();


        $currentDate = Carbon::now();
        $currentDateD = date('Y-m-d');
        $ActionsCopDr = ActionsCopDr::orderBy('id_act_cop_dr')->where('id_dr', auth()->user()->id_dir)->get();

        $descriptions = DescriptionCop::orderBy('id_desc')->orderByDesc('mois')->get();


        $actionIds = $ActionsCopDr->pluck('id_act_cop_dr')->toArray();
        //$descriptions = Description::whereIn('id_act', $actionIds)->orderBy('id_desc')->get();
        $desc_idAct_date = DescriptionCop::whereIn('id_act_cop_dr', $actionIds)->select('id_act_cop_dr','date','mois')->orderByDesc('mois')->get();

        $monthInt = intval($month);
        $descriptionCounts = [];
        foreach ($ActionsCopDr as $action)
        {
            $descriptionCounts[$action->id_act_cop_dr] = DescriptionCop::where('id_act_cop_dr', $action->id_act_cop_dr)->where('mois', $monthInt)->whereYear('date', $year)->count();
            // ->where('currentDateD','>', $action->df)

        }



        return view('directeur.directeur_cop', compact('month','objectifs','SousObjectif','JSdate', 'year','dir','code','NumDenom','currentDate','currentDateD','ActionsCopDr','descriptions','descriptionCounts','desc_idAct_date'));
    }



    public function add_desc_cop(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');
        $month = date('m');
        $monthInt = intval($month);

        $id_act_cop_dr = $request->input('id_act_cop_dr');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = ActionsCopDr::where('id_act_cop_dr', $id_act_cop_dr)->first();
        if ($action->etat  != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        $etat_mois = ($rangeValue - $etatT);

        DescriptionCop::create([
            'id_act_cop_dr'=> $id_act_cop_dr,
            'faite'=> $faite,
            'a_faire' =>$a_faire,
            'probleme' =>$probleme,
            'date' =>$currentDate,
            'etat' =>$rangeValue,
            'mois' => $monthInt,
            'etat_mois' => $etat_mois,
        ]);

        $maxEtat = DescriptionCop::where('id_act_cop_dr', $id_act_cop_dr)->max('etat');



        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }


    public function add_desc_pre_cop(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');
        $month = date('m');
        $monthInt = intval($month);

        $id_act_cop_dr = $request->input('id_act_cop_dr');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = ActionsCopDr::where('id_act_cop_dr', $id_act_cop_dr)->first();
        if ($action->etat  != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        $etat_mois = ($rangeValue - $etatT);

        DescriptionCop::create([
            'id_act_cop_dr'=> $id_act_cop_dr,
            'faite'=> $faite,
            'a_faire' =>$a_faire,
            'probleme' =>$probleme,
            'date' =>$currentDate,
            'etat' =>$rangeValue,
            'mois' => $monthInt -1,
            'etat_mois' => $etat_mois,
        ]);

        $maxEtat = DescriptionCop::where('id_act_cop_dr', $id_act_cop_dr)->max('etat');

        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }


    public function add_desc_pre2_cop(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');
        $month = date('m');
        $monthInt = intval($month);

        $id_act_cop_dr = $request->input('id_act_cop_dr');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = ActionsCopDr::where('id_act_cop_dr', $id_act_cop_dr)->first();
        if ($action->etat  != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        $etat_mois = ($rangeValue - $etatT);

        DescriptionCop::create([
            'id_act_cop_dr'=> $id_act_cop_dr,
            'faite'=> $faite,
            'a_faire' =>$a_faire,
            'probleme' =>$probleme,
            'date' =>$currentDate,
            'etat' =>$rangeValue,
            'mois' => $monthInt -2,
            'etat_mois' => $etat_mois,
        ]);

        $maxEtat = DescriptionCop::where('id_act_cop_dr', $id_act_cop_dr)->max('etat');

        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }




    public function update_desc_cop(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');

        $id_act = $request->input('id_act_cop_dr');
        $id_desc = $request->input('id_desc');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = ActionsCopDr::where('id_act_cop_dr', $id_act)->first();
        if ($action->etat  != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        if ($rangeValue > $etatT) {

        }else {

        }

        $description = DescriptionCop::find($id_desc);
        if ($description) {
            $description->faite= $faite;
            $description->a_faire = $a_faire;
            $description->probleme = $probleme;
            $description->date_update = $currentDate;
            $description->etat = $rangeValue;

            if ($rangeValue > $etatT) {
                $etat_mois2 = ($rangeValue - $etatT);
                $SS = $description->etat_mois;
                $Z = $etat_mois2 + $SS;
            }else {
                $etat_mois2 = ($etatT - $rangeValue);
                $SS = $description->etat_mois;
                $Z = $SS - $etat_mois2;
            }

            $description->etat_mois = $Z;
            $description->save();
        }else {
            return back()->with('error', 'Not changed');
        };

        $maxEtat = DescriptionCop::where('id_act_cop_dr', $id_act)->max('etat');


        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }




    public function getDescriptions($actionId)
        {
        $descriptions = DescriptionCop::where('id_act_cop_dr', $actionId)->orderByDesc('mois')->get();
        return response()->json($descriptions);
        }


}
