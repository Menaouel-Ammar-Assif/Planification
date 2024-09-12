<?php

namespace App\Http\Controllers;
// namespace App\Http\Controllers\stdClass;
use App\Models\Description;
use App\Models\DescriptionCop;
use App\Models\NumDenom;
use App\Models\NumDenomVals;
use App\Models\User;
use App\Models\Role;
use App\Models\Direction;
use App\Models\Volet;
use App\Models\Vda;
use App\Models\Corre;
use App\Models\Action;
use App\Models\prioritaires;
use App\Models\SousDirection;
use App\Models\copValeur;
use App\Models\CopCible;
use App\Models\Cause;


use App\Models\Objectif;
use App\Models\ActionsCop;
use App\Models\ActCopInd;
use App\Models\SousObjectif;
use App\Models\Indicateur;
use App\Models\ActionsPro;
use App\Models\ActionsProDr;
use App\Models\Bureau;
use App\Models\Chart;

///////////////////////////////  add ///////////////////////////
use App\Models\ActCopDrInd;
use App\Models\ActionsCopDr;
///////////////////////////////  add ///////////////////////////

/////////////////////////// Report ////////////////////////////////
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActionsExport;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
////////////////////////////////////////////////////////////////////

use Illuminate\Http\Request;
use Carbon\Carbon;


////////////////////////// pdf Download ////////////////////////////
use Dompdf\Dompdf;
////////////////////////////////////////////////////////////////////

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
        // dd($id_actDc);

        if ($numActDc > 0 || $numActDr > 0) {
            $AvancementDc = ($etatDcSum / $numActDc) ;
            if ($numActDr > 0) {
                $AvancementDr = ($etatDrSum / $numActDr);
            } else {
                $AvancementDr = 0;
            }
    
                    $AvancementD = ($AvancementDc + $AvancementDr)/2 ;
                    $AvancementDc = number_format($AvancementDc, 2, '.', '');
                    $AvancementDr = number_format($AvancementDr, 2, '.', '');
                    $AvancementD = number_format($AvancementD, 2, '.', '');
            }else{
              
            }
        $actIdDc = $actionsDc->pluck('id_act')->toArray();
        $actIdDr = $actionsDr->pluck('id_act')->toArray();

        $descDc = Description::whereIn('id_act', $actIdDc)->orderByDesc('mois')->get();
        $descDr = Description::whereIn('id_act', $actIdDr)->orderByDesc('mois')->get();

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

        $descriptions = Description::whereIn('id_act', $id_act_p)->orderByDesc('mois')->get();

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

        //**************************************** COP *******************************************/
        $datacop = Objectif::with('SousObjectif.ActionsCop.ActCopInd.Indicateur')->get();
        $NbActCop = ActionsCop::select('id_act_cop')->count();
        $objectifs= Objectif::orderBy('id_obj')->get();
        $object= $objectifs->pluck('id_obj');

        //**************************************** ACTIONS PROPOSEES *******************************************/

        $actpro = [];

        $actionsPro = ActionsPro::get();
        $actionsProDr = ActionsProDr::get();

        if ($actionsPro->count() > 0 && $actionsProDr->count() > 0) 
        {
            foreach ($actionsPro as $actproItem) 
            {
                foreach ($actionsProDr as $actprolib) 
                {
                    if ($actproItem->id_act_pro == $actprolib->id_act_pro) 
                    {
                        $actpro[] = 
                        [
                            'structure' => $actprolib->lib_created_by,
                            'action' => $actproItem->lib_act_pro,
                            'dd' => $actproItem->dd,
                            'df' => $actproItem->df,
                            'dr' => $actprolib->lib_dir,
                        ];
                    }
                }
            }
        }

        ///////////////Charts//////////////

        $year = date('Y');
        $month = date('m');
        $date = date('Y-m');
        // if () {
            
        // }
            $previousMonth = date('Y-m', strtotime('-1 month', strtotime($date)));

            $D = Chart::where('date',$previousMonth)->first();
            if ($D || $month == '01') {
                $bol = '0';
            }else {
                $bol = '1';
            }
            
            if ($bol == '1'){
                $Chart = new Chart();
                $Chart->date = $previousMonth;
                $Chart->avncT = $AvancementD;
                $Chart->avncdc = $AvancementDc;
                $Chart->avncdr = $AvancementDr;
                $Chart->save();

                $bol = '0';
            }

        $Charts = Chart::where('date', 'LIKE', $year.'%')->get();

        $JSdate = now();
        /////////////// END Charts//////////////

            return view("consult.consult_dashboard")->with([
                'Charts'=>$Charts,
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
                'data' => $data,

                'currentDate' =>$currentDate,
                'descDc' =>$descDc,
                'descDr' =>$descDr,
                'actionsDc' => $actionsDc,
                'actionsDr' => $actionsDr,

                'datacop' => $datacop,
                'NbActCop' => $NbActCop,
                'objectifs'=> $objectifs,
                'object'=> $object,
                'actions'=> $actions,
                'actpro'=> $actpro,
                'JSdate'=> $JSdate,
                'year' => $year,

        ]);
    }

    public function ConsultCop()
    {
        $month = date('m');
        $year = date('Y');
        $JSdate = now();

        $SousObjectif = SousObjectif::orderBy('id_sous_obj')->get();
        $Objectif = Objectif::orderBy('id_obj')->get();


        return view('consult.cop', compact('month','Objectif','SousObjectif','JSdate', 'year'));
    }

    public function ajaxObj($id_obj){
        $sousObjectif = SousObjectif::where('id_obj', $id_obj)->get();
        return json_encode($sousObjectif);
    }

    public function ajaxSouObj($id_sous_obj){
        $actionCop = ActionsCop::where('id_sous_obj', $id_sous_obj)->select('id_act_cop')->get();
        $id_ind = ActCopInd::whereIn('id_act_cop', $actionCop)->select('id_ind')->get();
        $indicateur = Indicateur::whereIn('id_ind', $id_ind)->get();
        return json_encode($indicateur);
    }

    public function ajaxInd($id_ind, Request $request){
        $year = date('Y');
        $response = [];
        $month = $request->input('month');

        $id_act_cops = ActCopInd::where('id_ind', $id_ind)->select('id_act_cop')->get();
        $id_act = ActionsCop::whereIn('id_act_cop', $id_act_cops)->select('id_act')->get();
        $act_cops = ActionsCop::whereIn('id_act_cop', $id_act_cops)->select('lib_act_cop', 'id_act', 'lib_dc')->get();
        $actionsDc = Action::whereIn('id_act', $id_act)->orderBy('id_act')->get();
        $directionsDc = Direction::where('type_dir', 'dc')->orderBy('id_dir')->get();


        $id_act_cop_drs = ActCopDrInd::where('id_ind', $id_ind)->select('id_act_cop_dr')->get();
        $actionsDr = ActionsCopDr::whereIn('id_act_cop_dr', $id_act_cop_drs)->orderBy('id_act_cop_dr')->get();
        $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();

        $indicateur = Indicateur::where('id_ind', $id_ind)->first();

        $copcible = CopCible::where('id_ind', $id_ind)->where('annee', $year)->first();

        if (!$indicateur) {
            return response()->json(['error' => 'Indicateur not found'], 404);
        }

        
        $causes = Cause::where('id_ind', $id_ind)->with('direction')->get();

        if (is_null($indicateur->id_chiffre)) {
            $type = 'nd';

            $num = NumDenom::where('id_num_denom', $indicateur->id_num)->first();
            $denom = NumDenom::where('id_num_denom', $indicateur->id_denom)->first();
    
            $numVal = NumDenomVals::where('id_num_denom', $indicateur->id_num)->whereMonth('date', $month)->whereYear('date', $year)->first();
            $denomVal = NumDenomVals::where('id_num_denom', $indicateur->id_denom)->whereMonth('date', $month)->whereYear('date', $year)->first();

            $valNumM = number_format($numVal->val, 2);
            $valDenomM = number_format($denomVal->val, 2);


            $CV = copValeur::where('id_ind', $id_ind)->whereMonth('periode', $month)->whereYear('periode', $year)->select('result', 'ecart','ecartType','ecartP','ecartTypeP')->first();

            $R = number_format($CV->result, 2);
            $E = number_format($CV->ecart, 2);
            $E2 = number_format($CV->ecartP, 2);

            if ($month =='03') {
                $cible2 = $copcible ?  $copcible->cibleTrimestre : null;
            }elseif ($month =='06') {
                $cible2 = $copcible ?  $copcible->cibleSemestre : null;
            }elseif ($month =='09') {
                $cible2 = $copcible ?  $copcible->cibleT_Trimestre : null;
            }


            $causesDc = Cause::where('id_ind', $id_ind)
            ->whereMonth('periode', '=', $month)
            ->where('id_dir', '<', 15)
            ->with('direction')
            ->get();

            $causesDr = Cause::where('id_ind', $id_ind)
            ->whereMonth('periode', '=', $month)
            ->where('id_dir', '>=', 15)
            ->with('direction')
            ->get();


            $response = [
                'type' => $type,
                'uniteNum' => $num->unite,
                'uniteDenom' => $denom->unite,
                'libNum' => $num ? $num->lib_num_denom : null,
                'libDenom' => $denom ? $denom->lib_num_denom : null,
                'valNum' => $valNumM ? $valNumM : null,
                'valDenom' => $valDenomM ? $valDenomM : null,
                'valNumType' => $numVal ? $numVal->unite : null,
                'valDenomType' => $denomVal ? $denomVal->unite : null,
                'formule' => $indicateur ?  $indicateur->formule : null,
                'R' => $R,
                'actionsDc' => $actionsDc,
                'directionsDc' => $directionsDc,
                'actionsDr' => $actionsDr,
                'directionsDr' => $directionsDr,
                'act_cops' => $act_cops,
                'cible' => $copcible ?  $copcible->cible : null,

                'cible2' => $cible2,

                'cibleUnite' => $copcible ?  $copcible->unite : null,
                'ecart' => $E,
                'ecartType' => $CV->ecartType,

                'ecart2' => $E2,
                'ecartType2' => $CV->ecartTypeP,

                // 'id_ind' => $id_ind,

                'causesDc' => $causesDc->map(function($cause) {
                    return [
                        'lib_cause' => $cause->lib_cause,
                        'lib_correct' => $cause->lib_correct,
                        'id_dir' => $cause->id_dir,
                        'lib_dir' => $cause->direction ? $cause->direction->lib_dir : null,
                    ];
                }),
                'causesDr' => $causesDr->map(function($cause) {
                    return [
                        'lib_cause' => $cause->lib_cause,
                        'lib_correct' => $cause->lib_correct,
                        'id_dir' => $cause->id_dir,
                        'lib_dir' => $cause->direction ? $cause->direction->lib_dir : null,
                    ];
                }),
          
                
            ];
        } 
        else 
        {
            $type = 'c';

            $chiffre = NumDenom::where('id_num_denom', $indicateur->id_chiffre)->first();
            $chiffreVal = NumDenomVals::where('id_num_denom', $indicateur->id_chiffre)->whereMonth('date', $month)->whereYear('date', $year)->first();

            $chiffreValL = number_format( $chiffreVal->val, 2);

            $e = copValeur::where('id_ind', $id_ind)->whereMonth('periode', $month)->whereYear('periode', $year)->select('ecart','ecartType','ecartP','ecartTypeP')->first();

            $copcibleE = number_format($copcible->cible, 2);
            $E = number_format($e->ecart, 2);
            $E2 = number_format($e->ecartP, 2);

            if ($month =='03') {
                $cible2 = $copcible ? number_format($copcible->cibleTrimestre, 2)  : null;
            }elseif ($month =='06') {
                $cible2 = $copcible ? number_format($copcible->cibleSemestre, 2)  : null;
            }elseif ($month =='09') {
                $cible2 = $copcible ? number_format($copcible->cibleT_Trimestre, 2)  : null;
            }

            $causesDc = Cause::where('id_ind', $id_ind)
            ->whereMonth('periode', '=', $month)
            ->where('id_dir', '<', 15)
            ->with('direction')
            ->get();

            $causesDr = Cause::where('id_ind', $id_ind)
            ->whereMonth('periode', '=', $month)
            ->where('id_dir', '>=', 15)
            ->with('direction')
            ->get();

            $response = [
                'type' => $type,
                'uniteC' => $chiffre->unite,
                'libChiffre' => $chiffre ? $chiffre->lib_num_denom : null,
                'valChiffre' => $chiffreValL ? $chiffreValL : null,
                'valChiffreType' => $chiffreVal ? $chiffreVal->unite : null,
                'formule' => $indicateur ?  $indicateur->formule : null,
                'actionsDc' => $actionsDc,
                'directionsDc' => $directionsDc,
                'actionsDr' => $actionsDr,
                'directionsDr' => $directionsDr,
                'act_cops' => $act_cops,

                'cible' => $copcibleE ?  $copcibleE : null,
                'cible2' => $cible2,

                'cibleUnite' => $copcible ?  $copcible->unite : null,
                'ecart' => $E,
                'ecartType' => $e->ecartType,

                'ecart2' => $E2,
                'ecartType2' => $e->ecartTypeP,

                'causesDc' => $causesDc->map(function($cause) {
                    return [
                        'lib_cause' => $cause->lib_cause,
                        'lib_correct' => $cause->lib_correct,
                        'id_dir' => $cause->id_dir,
                        'lib_dir' => $cause->direction ? $cause->direction->lib_dir : null,
                    ];
                }),
                'causesDr' => $causesDr->map(function($cause) {
                    return [
                        'lib_cause' => $cause->lib_cause,
                        'lib_correct' => $cause->lib_correct,
                        'id_dir' => $cause->id_dir,
                        'lib_dir' => $cause->direction ? $cause->direction->lib_dir : null,
                    ];
                }),
                
            ];
        }
        return response()->json($response);
    }

    public function subTable($id_act)
    {
        $info = Description::where('id_act', $id_act)->orderByDesc('mois')->get();

        return response()->json([ 'infos' => $info ]);
    }

    public function subTableDr($id_act_)
    {
        $info = DescriptionCop::where('id_act_cop_dr', $id_act_)->orderByDesc('mois')->get();

        return response()->json([ 'infoss' => $info ]);
    }

    // public function DirectionRegionale()
    // {
    //     $dr = Direction::where('type_dir', 'dr')->get();

    //     return view('consult.Dr', compact('dr'));
    // }
    // public function DirectionCentrale()
    // {

    //     $vdaDc = Vda::whereBetween('id_dc', [1, 14])->get();
    //     $action = Action::all();

    //     $SousDirection = SousDirection::all();
    //     $corre = Corre::all();
    //     $dc = Direction::where('type_dir', 'dc')->get();
    //     return view('consult.Dc', compact('dc',  'corre', 'SousDirection', 'action', 'vdaDc'));
    // }


    public function Liaison()
    {
        // $SousDirections = SousDirection::orderBy('id_sous_dir')->get();

        // $corres = Corre::orderBy('id_dc')->get();
        // $directionsDc = Direction::where('type_dir', 'dc')->orderBy('id_dir')->get();

        //$directions = Direction::with('DirSousDirBureaux.SousDirection', 'DirSousDirBureaux.Bureau')->get();

        $directionsDc = Direction::where('type_dir', 'dc')->orderBy('id_dir')->get();
    $directions = $directionsDc->load('DirSousDirBureaux.Bureau', 'DirSousDirBureaux.SousDirection');

    // Sort the bureaus for each DirSousDirBureau by id_bureau
    $directions->each(function ($direction) {
        $direction->DirSousDirBureaux = $direction->DirSousDirBureaux->sortBy('Bureau.id_bureau');
    });

    $directions->each(function ($direction) {
        $direction->DirSousDirBureaux->each(function ($dirSousDirBureau) {
            if (!$dirSousDirBureau->Bureau) {
                $dirSousDirBureau->Bureau = new Bureau(); // Create a new instance of Bureau if it's null
            }
        });
    });
        return view('consult.Liaison', compact('directions'));

    }

    public function charts()
    {
        $year = date('Y');
        $Charts = Chart::where('date', 'LIKE', $year.'%')->get();

        return view('consult.charts', compact('Charts'));
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

        $currentDate = Carbon::now();
        $startOfYear = Carbon::createFromFormat('Y-m-d H:i:s', $currentDate->format('Y') . '-01-01 00:00:00');
        $totalDaysInYear = $startOfYear->diffInDays($startOfYear->copy()->endOfYear());
        $daysElapsed = $startOfYear->diffInDays($currentDate);
        $datePercentageDc = ($daysElapsed / $totalDaysInYear) * 100;
        $datePercentageDc = number_format($datePercentageDc, 2, '.', '');

        
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
                    ->orWhere('etat', '!=', '100')->where('df', '>', $curDate);
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

    public function DownDC($IdSelect, $Name)
    {

        $curDate = date('Y-m-d');
        $directionId = $IdSelect;
        $idbtn = $Name;


        if ($directionId == 'all')
        {
            $id_act = Vda::whereNotNull('id_dc')->pluck('id_act');
            $directionName = Direction::where('type_dir', 'dc')->get();
            $array = true;
        }
        else
        {
            $id_act = Vda::where('id_dc', $directionId)->pluck('id_act');
            $directionName = Direction::where('id_dir', $directionId)->get();
            $array = false;
        }

        $actions = Action::whereIn('id_act', $id_act);

        if($idbtn=='DE')
        {
            $actionsFiltre = $actions->where(function ($query) use ($curDate){
                $query->whereNull('etat')->where('df', '>', $curDate)
                    ->orWhere('etat', '!=', '100')->where('df', '>', $curDate);
            })->orderBy('id_act')->get();

            $etat = 'Actions_En_cours';
        }
        elseif($idbtn=='DT')
        {
            $actionsFiltre = $actions->where('etat', '100')->orderBy('id_act')->get();

            $etat = 'Actions_Finalisée';
        }
        elseif($idbtn=='DR')
        {
            $actionsFiltre = $actions->where(function ($query) use ($curDate){
                $query->whereNull('etat')->where('df', '<', $curDate)
                    ->orWhere('etat', '!=', '100')->where('df', '<', $curDate);
            })->orderBy('id_act')->get();

            $etat = 'Actions_Echues';

        }
        else
        {
            $actionsFiltre = $actions->orderBy('id_act')->get();
            $etat = 'Toutes_Les_Actions';
        }


        if ($array)
        {
            $fileName = $etat.'_Structure_Centrales.xlsx';
        }
        else
        {
            $fileName = $etat.'_'.$directionName->pluck('lib_dir')->first().'.xlsx';
        }

        Excel::store(new ActionsExport($actionsFiltre, $directionName), $fileName, 'public');

        return response()->download(Storage::disk('public')->path($fileName), $fileName,
        [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    public function collection()
    {
        return Action::get();
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
        
        //    $currentDate = Carbon::now();
        //    $startOfAct = $actionsDr->dd;
        //    $totalDaysInAct = $startOfAct->diffInDays($actionsDr->df);
        //    $daysElapsed = $startOfAct->diffInDays($currentDate);
        //    $datePercentageDr = ($daysElapsed / $totalDaysInAct) * 100;
        //    $datePercentageDr = number_format($datePercentageDr, 2, '.', '');

        
        ///////////////////////// END TEMP ECOLE //////////////////////////////////

        $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();



        return response()->json([
                    'actionsDr' => $actionsDr,
                    'etatTermDr' => $etatTermDr,
                    'etatRetDr' => $etatRetDr,
                    'etatEncDr' => $etatEncDr,
                    'numActionsDr'=> $numActionsDr,
                    'AvncmDr' =>  $AvncmDr,
                    //    'datePercentageDr'=>$datePercentageDr,
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
                    ->orWhere('etat', '!=', '100')->where('df', '>=', $curDate);
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

        $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();



            return response()->json([
                'actionsFiltre' => $actionsFiltre,
                'directionsDr'=>$directionsDr,

            ]);
    }

    public function DownDR($IdSelect, $Name)
    {

        $curDate = date('Y-m-d');
        $directionId = $IdSelect;
        $idbtn = $Name;


        if ($directionId == 'all')
        {
            $id_act = Vda::whereNotNull('id_dr')->pluck('id_act');
            $directionName = Direction::where('type_dir', 'dr')->get();
            $array = true;
        }
        else
        {
            $id_act = Vda::where('id_dr', $directionId)->pluck('id_act');
            $directionName = Direction::where('id_dir', $directionId)->get();
            $array = false;
        }

        $actions = Action::whereIn('id_act', $id_act);

        if($idbtn=='DE')
        {
            $actionsFiltre = $actions->where(function ($query) use ($curDate){
                $query->whereNull('etat')->where('df', '>', $curDate)
                    ->orWhere('etat', '!=', '100')->where('df', '>', $curDate);
            })->orderBy('id_act')->get();

            $etat = 'Actions_Encours';
        }
        elseif($idbtn=='DT')
        {
            $actionsFiltre = $actions->where('etat', '100')->orderBy('id_act')->get();

            $etat = 'Actions_Terminées';
        }
        elseif($idbtn=='DR')
        {
            $actionsFiltre = $actions->where(function ($query) use ($curDate){
                $query->whereNull('etat')->where('df', '<', $curDate)
                    ->orWhere('etat', '!=', '100')->where('df', '<', $curDate);
            })->orderBy('id_act')->get();

            $etat = 'Actions_Retardées';

        }
        else
        {
            $actionsFiltre = $actions->orderBy('id_act')->get();
            $etat = 'Toutes_Les_Actions';
        }


        if ($array)
        {
            $fileName = $etat.'_Directions_Régionales.xlsx';
        }
        else
        {
            $fileName = $etat.'_'.$directionName->pluck('lib_dir')->first().'.xlsx';
        }

        Excel::store(new ActionsExport($actionsFiltre, $directionName), $fileName, 'public');

        return response()->download(Storage::disk('public')->path($fileName), $fileName,
        [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }
////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////// Model Fiche ////////////////////////////////
    public function downloadPDF()
    {
        $pdfPath = storage_path('app\public\Modèle_fiche_indicateur.pdf');
        return response()->download($pdfPath, 'Modèle_fiche_indicateur.pdf');
    }

    public function downloadPDFT1()
    {
        $pdfPath = storage_path('app\public\LISTE_DES_INFORMATIONS_T1.pdf');
        return response()->download($pdfPath, 'LISTE_DES_INFORMATIONS_T1.pdf');
    }

    public function downloadPDFS1()
    {
        $pdfPath = storage_path('app\public\LISTE_DES_INFORMATIONS_S1.pdf');
        return response()->download($pdfPath, 'LISTE_DES_INFORMATIONS_S1.pdf');
    }
////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////// SUB ACTION PART  //////////////////////////////
    public function subAction($id_act)
    {
        $info = Description::where('id_act', $id_act)->orderByDesc('mois')->get();

        return response()->json([ 'infos' => $info ]);

    }


    public function subActionCopDr($id_act)
    {
        $info = DescriptionCop::where('id_act_cop_dr', $id_act)->orderByDesc('mois')->get();

        return response()->json([ 'infos' => $info ]);

    }
////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////ACTIONS PROPOSEES///////////////////////////////////
    // public function AjaxCopDr($directionId)
    // {
    //     if($directionId == 'all'){
    //         $id_act_cop_dr = ActCopDrInd::pluck('id_act_cop_dr');

    //     }
    //     else{
    //         $id_act_cop_dr = ActCopDrInd::where('created_by', $directionId)->pluck('id_act_cop_dr');

    //     }
    
    //     $objectifs = Objectif::orderBy('id_obj')->get();
    //     $sousobjectifs = SousObjectif::orderBy('id_sous_obj')->get();
    //     $indicateursSelect = Indicateur::orderBy('id_ind')->get();
    //     $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();


    //     $data = [];

    //     foreach ($objectifs as $objectif)
    //     {
    //         $sousObjectifs = SousObjectif::where('id_obj', $objectif->id_obj)->get();

    //         foreach ($sousObjectifs as $sousObjectif) {
    //             $actions = ActionsCopDr::where('id_sous_obj', $sousObjectif->id_sous_obj)->whereIn('id_act_cop_dr', $id_act_cop_dr)->get();

    //             foreach ($actions as $action) {
    //                 $indicateurs = $action->indicateurs;

    //                 if ($indicateurs->count() > 1) {
    //                     $indicateursText = $indicateurs->pluck('lib_ind')->unique()->implode(', ');
    //                 } else {
    //                     $indicateursText = $indicateurs->first()->lib_ind;
    //                 }

    //                 $data[] =
    //                 [
    //                     'objectif' => $objectif->lib_obj,
    //                     'sous_objectif' => $sousObjectif->lib_sous_obj,
    //                     'action' => $action->lib_act_cop_dr,
    //                     'date_debut' => $action->dd,
    //                     'date_fin' => $action->df,
    //                     'indicateurs' => $indicateursText,
    //                     'id_act' => $action->id_act_cop_dr,
    //                 ];
    //             }
    //         }



    //     }

    //     return response()->json([
    //         'data' => $data,
    //     ]);

    // }


    public function AjaxCopDr($directionId)
    {
        if($directionId == 'all'){
            $id_act_cop_dr = ActCopDrInd::pluck('id_act_cop_dr');

        }
        else{
            $id_act_cop_dr = ActCopDrInd::where('created_by', $directionId)->pluck('id_act_cop_dr');

        }
    
        $objectifs = Objectif::orderBy('id_obj')->get();
        $sousobjectifs = SousObjectif::orderBy('id_sous_obj')->get();
        $indicateursSelect = Indicateur::orderBy('id_ind')->get();
        $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();


        $data = [];

        foreach ($objectifs as $objectif)
        {
            $sousObjectifs = SousObjectif::where('id_obj', $objectif->id_obj)->get();

            foreach ($sousObjectifs as $sousObjectif) {
                $actions = ActionsCopDr::where('id_sous_obj', $sousObjectif->id_sous_obj)->whereIn('id_act_cop_dr', $id_act_cop_dr)->get();

                foreach ($actions as $action) {
                    $indicateurs = $action->indicateurs;

                    if ($indicateurs->isNotEmpty()) {
                        $indicateursText = '';
                        $formules = [];
                
                        foreach ($indicateurs as $indicateur) {
                            // Append the indicator's name to the text
                            $indicateursText .= $indicateur->lib_ind . ', ';
                            
                            // Store the formula in an array
                            $formules[] = $indicateur->formule;
                        }
                
                        // Remove the trailing comma and space
                        $indicateursText = rtrim($indicateursText, ', ');
                
                        // Join the formulas with a separator
                        $formulesText = implode(', ', $formules);
                    } else {
                        $indicateursText = '-';
                        $formulesText = '-';
                    }
                
                    $data[] = [
                        'objectif' => $objectif->lib_obj,
                        'sous_objectif' => $sousObjectif->lib_sous_obj,
                        'action' => $action->lib_act_cop_dr,
                        'date_debut' => $action->dd,
                        'date_fin' => $action->df,
                        'indicateurs' => $indicateursText,
                        'formules' => $formulesText, // Add formules to the data array
                        'id_act' => $action->id_act_cop_dr,
                    ];
                }
            }



        }

        return response()->json([
            'data' => $data,
        ]);

    }
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////// function select ajust //////////////////////////////
    public function ajaxDrAjust($directionDrId)
    {
        $actpro = [];
        $actionsPro = ActionsPro::get();

        if ($directionDrId=='all')
        {
            $actionsProDr = ActionsProDr::get();
        }
        else
        {
            $actionsProDr = ActionsProDr::where('id_dir', $directionDrId)->get();
        }
        

        if ($actionsPro->count() > 0 && $actionsProDr->count() > 0) 
        {
            foreach ($actionsPro as $actproItem) 
            {
                foreach ($actionsProDr as $actprolib) 
                {
                    if ($actproItem->id_act_pro == $actprolib->id_act_pro) 
                    {
                        $actpro[] = 
                        [
                            'structure' => $actprolib->lib_created_by,
                            'action' => $actproItem->lib_act_pro,
                            'dd' => $actproItem->dd,
                            'df' => $actproItem->df,
                            'dr' => $actprolib->lib_dir,
                        ];
                    }
                }
            }
        }

        return response()->json([
            'actpro' => $actpro,
            ]);
    }
////////////////////////////////////////////////////////////////////////////////////

}
