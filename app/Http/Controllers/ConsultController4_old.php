<?php

namespace App\Http\Controllers;
use App\Models\Description;
use App\Models\User;
use App\Models\Role;
use App\Models\Direction;
use App\Models\Volet;
use App\Models\Vda;
use App\Models\Corre;
use App\Models\Action;
use App\Models\prioritaires;
use App\Models\SousDirection;

use App\Models\Objectif;
use App\Models\ActionsCop;
use App\Models\SousObjectif;
use App\Models\Indicateur;
use App\Models\ActionsPro;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ConsultController extends Controller
{

    public function ConsultDashboard(Request $request)
    {
        $DateY = date('Y');
        $DateM = date('m'); 
        $currentDate = date('Y-m');
        $curDate = date('Y-m-d');

        $directionsDc = Direction::where('type_dir', 'dc')->orderBy('ordre')->get();
        $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();
        $request->validate([
            'direction' => 'nullable|exists:directions,id_dir',
        ]);

        // $acts = Vda::where('id_dc', $selectedDirectionId)->pluck('id_act');

        $id_dirDc = $directionsDc->pluck('id_dir');
        $id_dirDr = $directionsDr->pluck('id_dir');

        $id_actDc= Vda::whereIn('id_dc', $id_dirDc)->pluck('id_act');
        $id_actDr= Vda::whereIn('id_dr', $id_dirDr)->pluck('id_act');

        // $act = prioritaires::find(1)->Action()->get();
        // $act->pluck('etat');




        $actionsDc = Action::whereIn('id_act', $id_actDc)->orderBy('id_act')->get();
        $actionsDr = Action::whereIn('id_act', $id_actDr)->orderBy('id_act')->get();

        $numActDc = $actionsDc->count();
        
        $numActDr = $actionsDr->count();

        $etatDc = $actionsDc->pluck('etat');
        $etatDr = $actionsDr->pluck('etat');

        $etatDcSum = $actionsDc->sum('etat');
        $etatDrSum = $actionsDr->sum('etat');

        if ($numActDc > 0 || $numActDr > 0) {
                $AvancementDc = ($etatDcSum / $numActDc) ;
                $AvancementDr = ($etatDrSum / $numActDr) ;
                $AvancementD = ($AvancementDc + $AvancementDr)/2 ;
                $AvancementDc = number_format($AvancementDc, 2, '.', '');
                $AvancementDr = number_format($AvancementDr, 2, '.', '');
                $AvancementD = number_format($AvancementD, 2, '.', '');
        }else{
        }
        $actIdDc = $actionsDc->pluck('id_act')->toArray();
        $actIdDr = $actionsDr->pluck('id_act')->toArray();

        $descDc = Description::whereIn('id_act', $actIdDc)->get();
        $descDr = Description::whereIn('id_act', $actIdDr)->get();

        $actions = Action::orderBy('id_act')->get();

        $numActions = $actions->count();
        // actions terminnes
        $etatTerm = $actions->where('etat', '100')->count();
        $etatTermDC = $actionsDc->where('etat', '100')->count();
        $etatTermDR = $actionsDr->where('etat', '100')->count();
        // actions retardées
        $etatRet = $actions->filter(function($action) use ($curDate) {
            $actionDate = date('Y-m-d', strtotime($action->df));
            return $action->etat !== 100 && $actionDate < $curDate;
            })->count();

        $etatRetDC = $actionsDc->filter(function($action) use ($curDate) {
            $actionDate = date('Y-m-d', strtotime($action->df));
            return $action->etat !== 100 && $actionDate < $curDate;
        })->count();

        $etatRetDR = $actionsDr->filter(function($action) use ($curDate) {
            $actionDate = date('Y-m-d', strtotime($action->df));
            return $action->etat !== 100 && $actionDate < $curDate;
        })->count();
        
        // actions en cours
        $etatEnc = $numActions - ($etatTerm + $etatRet);
        $etatEncDC = $numActDc - ($etatTermDC + $etatRetDC);
        $etatEncDR = $numActDr - ($etatTermDR + $etatRetDR);

        $totalEtatDc = $actions->sum('etat');


        $prioritaires = prioritaires::orderBy('id_p')->get();
        $nmbr_act_p= $prioritaires->count();
        $id_p = $prioritaires->pluck('id_p');


        $act_p = Action::whereNotNull('id_p')->orderBy('id_act')->get();
        $id_act_p = $act_p->pluck('id_act');
    
        $descriptions = Description::whereIn('id_act', $id_act_p)->orderBy('id_act')->get();

        $nmbr_act_p_ = $act_p->count();
        $etat_act_p_sum = $act_p->sum('etat');
        if ($nmbr_act_p > 0) {
                $avncmt_act_p = ($etat_act_p_sum / $nmbr_act_p_) ;
                $avncmt_act_p = number_format($avncmt_act_p, 2, '.', '');

        }else{
            $avncmt_act_p = "0";
        }

        $act_p_term = $act_p->where('etat', '100')->count();
        $act_p_ret = $act_p->filter(function($action) use ($curDate) {
            $actionDate = date('Y-m-d', strtotime($action->df));
            return $action->etat !== 100 && $actionDate < $curDate;
        })->count();
        $act_p_enc = $nmbr_act_p_ - ($act_p_term + $act_p_ret);

        // Temps écoulé année
        $currentDate = Carbon::now();
        $startOfYear = Carbon::createFromFormat('Y-m-d H:i:s', $currentDate->format('Y') . '-01-01 00:00:00');
        $totalDaysInYear = $startOfYear->diffInDays($startOfYear->copy()->endOfYear());
        $daysElapsed = $startOfYear->diffInDays($currentDate);
        $percentageElapsed = ($daysElapsed / $totalDaysInYear) * 100;
        $percentageElapsed = number_format($percentageElapsed, 2, '.', '');


        $data = [];
        foreach ($id_p as $prioritairesId) {
            $actions = prioritaires::find($prioritairesId)->Action()->get();
            $etat = $actions->sum('etat');
            $act = $actions->count();
            $m = $act > 0 ? $etat / $act : 0;
            $data[] = [
                'y' => $prioritairesId,
                'a' => $m,
                'b' => $percentageElapsed, 
            ];
        }

        $dataJson = json_encode($data);

//**************************************** COP ******************************************* */
    $datacop = Objectif::with('SousObjectif.ActionsCop.ActCopInd.Indicateur')->get();
    $NbActCop = ActionsCop::select('id_act_cop')->count();
    $objectifs= Objectif::orderBy('id_obj')->get();
    $object= $objectifs->pluck('id_obj');

//**************************************** Actions Proposées ******************************************* */
    // $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
    // // $dir = $direction->lib_dir;
    // $code = $direction->code;
    // $id_dir = $direction->id_dir;

    // // $objectifs = Objectif::orderBy('id_obj')->get();
    // $sousobjectifs = SousObjectif::orderBy('id_sous_obj')->get();
    // $indicateurs = Indicateur::orderBy('id_ind')->get();
    // $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();

    //**************************************** Actions Proposées ******************************************* */

    // Fetch only the actions created by the authenticated user
        if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14) {
            $actions = ActionsPro::whereHas('actionsProInds', function ($query) {
                $query->where('created_by', auth()->user()->id_dir);
            })->with(['Objectif', 'SousObjectif', 'actionsProInds'])->get();
        }else{
            $actions = ActionsPro::whereHas('actionsProInds', function ($query) {
                $query->where('id_dir', auth()->user()->id_dir);
            })->with(['Objectif', 'SousObjectif', 'actionsProInds'])->get();
        }

    
        return view("consult.consult_dashboard")->with([
            'directionsDc' => $directionsDc,
            'directionsDr' => $directionsDr,
            'AvancementDc' => $AvancementDc,
            'AvancementDr' => $AvancementDr,
            'AvancementD' => $AvancementD,
            'numActDc' => $numActDc,

            'descriptions' => $descriptions,
            'prioritaires' => $prioritaires,
            'nmbr_act_p' => $nmbr_act_p,
            'nmbr_act_p_' => $nmbr_act_p_,
            'id_p' => $id_p,
            'act_p' => $act_p,
            'datePercentage' => $percentageElapsed,
            'avncmt_act_p' => $avncmt_act_p,

            'act_p_term' => $act_p_term,
            'act_p_ret' => $act_p_ret,
            'act_p_enc' => $act_p_enc,

            'numActDr' => $numActDr,
            'numActions' => $numActions,
            'etatTerm' => $etatTerm,
            'etatTermDC' => $etatTermDC,
            'etatTermDR' => $etatTermDR,
            'etatRet' => $etatRet,
            'etatRetDC' => $etatRetDC,
            'etatRetDR' => $etatRetDR,
            'etatEnc' => $etatEnc,
            'etatEncDC' => $etatEncDC,
            'etatEncDR' => $etatEncDR,
            'dataJson' => $dataJson,

            'currentDate' =>$currentDate,
            'descDc' =>$descDc,
            'descDr' =>$descDr,
            'actionsDc' => $actionsDc,
            'actionsDr' => $actionsDr,
            
            'datacop' => $datacop,
            'NbActCop' => $NbActCop,
            'objectifs'=> $objectifs,
            'object'=> $object,

            //**************************************** Actions proposées ******************************************* */

            // 'dir'=> $dir, 
            // 'code'=> $code, 
            // 'objectifs'=> $objectifs, 
            // 'sousobjectifs'=> $sousobjectifs, 
            // 'indicateurs'=> $indicateurs, 
            // 'directionsDr'=> $directionsDr, 
            // 'actions'=> $actions,


        ]);
    }

    public function DirectionRegionale()
    {
        $dr = Direction::where('type_dir', 'dr')->get();

        return view('consult.Dr', compact('dr'));
    }

    public function DirectionCentrale()
    {

        $vdaDc = Vda::whereBetween('id_dc', [1, 14])->get();
        $action = Action::all();

        $SousDirection = SousDirection::all();
        $corre = Corre::all();
        $dc = Direction::where('type_dir', 'dc')->get();
        return view('consult.Dc', compact('dc',  'corre', 'SousDirection', 'action', 'vdaDc'));
    }


    public function Liaison()
    {
        $SousDirections = SousDirection::orderBy('id_sous_dir')->get();
        
        $corres = Corre::orderBy('id_dc')->get();
        $directionsDc = Direction::where('type_dir', 'dc')->orderBy('id_dir')->get();

        return view('consult.Liaison', compact('corres','directionsDc','SousDirections'));
    }



   /////////////////////////////////////DC part///////////////////////////////////////
   public function ajaxDc($directionId) 
   {
       $curDate = date('Y-m-d');

       if ($directionId == 'all'){ $id_act = Vda::whereNotNull('id_dc')->pluck('id_act');}
       else { $id_act = Vda::where('id_dc', $directionId)->pluck('id_act');}
       
       $actionsDc = Action::whereIn('id_act', $id_act)->orderBy('id_act')->get();

       

       $numActionsDc = $actionsDc->count();

       // actions terminnes ///////////////////////////////////////////////
       $etatTermDc = $actionsDc->where('etat', '100')->count();

       // actions retardées ///////////////////////////////////////////////
       $etatRetDc = $actionsDc->filter(function($action) use ($curDate) {
           $actionDate = date('Y-m-d', strtotime($action->df));
           return $action->etat !== 100 && $actionDate < $curDate;
       })->count();
       
       // actions en cours ///////////////////////////////////////////////
       $etatEncDc = $numActionsDc - ($etatTermDc + $etatRetDc);

       //totale des avancement des direction Centrale ////////////////////
       $totalEtatDc = $actionsDc->sum('etat');
       $AvncmDc = $totalEtatDc / $numActionsDc;

       // TEMP ECOLE /////////////////////////////////////////////////////
       // if ($actionsDc->df > $actionsDc->dd) 
       // {
       //     $dateStart = $actionsDc->dd;
       //     $dateEnd = $actionsDc->df; // Corrected to df instead of dd
       
       //     $totalDuration = strtotime($dateEnd) - strtotime($dateStart); // Calculate difference in seconds
       //     $currentDuration = strtotime($curDate) - strtotime($dateStart);
       //     $datePercentageDC = ($currentDuration / $totalDuration) * 100;
       
       // } else {
       //     $datePercentageDC = 100;
       // }

       ///////////////////////// START TEMP ECOLE ////////////////////////////////
       $dateStart = strtotime('2024-01-01');
       $dateEnd = strtotime('2024-12-31');

       $totalDuration = $dateEnd - $dateStart;
       $currentDuration = strtotime($curDate) - $dateStart;
       $datePercentageDc = ($currentDuration / $totalDuration) * 100;
       ///////////////////////// END TEMP ECOLE //////////////////////////////////

       // directions dc for lib
       $directionsDc = Direction::where('type_dir', 'dc')->orderBy('id_dir')->get();

       

       return response()->json([
                   'actionsDc' => $actionsDc,
                   'etatTermDc' => $etatTermDc,
                   'etatRetDc' => $etatRetDc,
                   'etatEncDc' => $etatEncDc,
                   'numActionsDc'=> $numActionsDc,
                   'AvncmDc' =>  $AvncmDc, 
                   'datePercentageDc'=>$datePercentageDc,
                   'directionsDc'=>$directionsDc,
               ]);
   }

   public function btnDC($directionId,$idbtn) 
   {
       $curDate = date('Y-m-d');
       $DateY = date('Y');
       $DateM = date('m');

       if ($directionId == 'all'){ $id_act = Vda::whereNotNull('id_dc')->pluck('id_act');}
       else { $id_act = Vda::where('id_dc', $directionId)->pluck('id_act');}

       $actions = Action::whereIn('id_act', $id_act);

       if($idbtn=='E')
       {
           $actionsFiltre = $actions->where(function ($query) use ($curDate){
               $query->whereNull('etat')->where('df', '>', $curDate)
                   ->orWhere('etat', '!=', '100');
           })->orderBy('id_act')->get();
       }
       elseif($idbtn=='T')
       {
           $actionsFiltre = $actions->where('etat', '100')->orderBy('id_act')->get();
       }
       elseif($idbtn=='R')
       {
           $actionsFiltre = $actions->where(function ($query) use ($curDate){
               $query->whereNull('etat')->where('df', '<', $curDate)
                   ->orWhere('etat', '!=', '100')->where('df', '<', $curDate);
           })->orderBy('id_act')->get();

       }
       else
       {
           $actionsFiltre = $actions->orderBy('id_act')->get();
       }
       
       $directionsDc = Direction::where('type_dir', 'dc')->orderBy('id_dir')->get();
       
  
       return response()->json([
           'actionsFiltre' => $actionsFiltre,
           'directionsDc'=>$directionsDc,
           
       ]);
   }

////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////DR part///////////////////////////////////////
   public function ajaxDr($directionId) 
   {
       $curDate = date('Y-m-d');

       if ($directionId == 'all'){ $id_act = Vda::whereNotNull('id_dr')->pluck('id_act');}
       else { $id_act = Vda::where('id_dr', $directionId)->pluck('id_act');}
       
       $actionsDr = Action::whereIn('id_act', $id_act)->orderBy('id_act')->get();

       $numActionsDr = $actionsDr->count();

       // actions terminnes ///////////////////////////////////////////////
       $etatTermDr = $actionsDr->where('etat', '100')->count();

       // actions retardées ///////////////////////////////////////////////
       $etatRetDr = $actionsDr->filter(function($action) use ($curDate) {
           $actionDate = date('Y-m-d', strtotime($action->df));
           return $action->etat !== 100 && $actionDate < $curDate;
       })->count();
       
       // actions en cours ///////////////////////////////////////////////
       $etatEncDr = $numActionsDr - ($etatTermDr + $etatRetDr);

       //totale des avancement des direction Centrale ////////////////////
       $totalEtatDr = $actionsDr->sum('etat');
       $AvncmDr = $totalEtatDr / $numActionsDr;

       ///////////////////////// START TEMP ECOLE ////////////////////////////////
       $dateStart = strtotime('2024-01-01');
       $dateEnd = strtotime('2024-12-31');

       $totalDuration = $dateEnd - $dateStart;
       $currentDuration = strtotime($curDate) - $dateStart;
       $datePercentageDr = ($currentDuration / $totalDuration) * 100;
       ///////////////////////// END TEMP ECOLE //////////////////////////////////

       $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();

       

       return response()->json([
                   'actionsDr' => $actionsDr,
                   'etatTermDr' => $etatTermDr,
                   'etatRetDr' => $etatRetDr,
                   'etatEncDr' => $etatEncDr,
                   'numActionsDr'=> $numActionsDr,
                   'AvncmDr' =>  $AvncmDr, 
                   'datePercentageDr'=>$datePercentageDr,
                   'directionsDr'=>$directionsDr,
               ]);
   }

   public function btnDR($directionId,$idbtn) 
   {
       $curDate = date('Y-m-d');

       if ($directionId == 'all'){ $id_act = Vda::whereNotNull('id_dr')->pluck('id_act');}
       else { $id_act = Vda::where('id_dr', $directionId)->pluck('id_act');}

       $actions = Action::whereIn('id_act', $id_act);

       if($idbtn=='E')
       {
           $actionsFiltre = $actions->where(function ($query) use ($curDate){
               $query->whereNull('etat')->where('df', '>', $curDate)
                   ->orWhere('etat', '!=', '100');
           })->orderBy('id_act')->get();
       }
       elseif($idbtn=='T')
       {
           $actionsFiltre = $actions->where('etat', '100')->orderBy('id_act')->get();
       }
       elseif($idbtn=='R')
       {
           $actionsFiltre = $actions->where(function ($query) use ($curDate){
               $query->whereNull('etat')->where('df', '<', $curDate)
                   ->orWhere('etat', '!=', '100');
           })->orderBy('id_act')->get();
       }
       else
       {
           $actionsFiltre = $actions->orderBy('id_act')->get();
       }

       $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();
       
       

           return response()->json([
               'actionsFiltre' => $actionsFiltre,
               'directionsDr'=>$directionsDr,
               
           ]);
   }
////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////// SUB ACTION PART  //////////////////////////////
   public function subAction($id_act)
   {
       $info = Description::where('id_act', $id_act)->get();

       return response()->json([ 'infos' => $info ]);

   } 
////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////ACTIONS PROPOSEES///////////////////////////////////


}
