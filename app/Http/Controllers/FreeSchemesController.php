<?php

namespace App\Http\Controllers;
use Excel;
// use Log;
use File;
use Response;
use Exception;
use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Chemist;
use App\Models\Product;
use App\Models\Activity;
use App\Models\Employee;
use App\Models\Stockist;
use App\Exports\FSExport;
use App\Models\FreeScheme;
use Illuminate\Http\Request;
use App\Models\FreeSchemeDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Mail;
use SendGrid;
use SendGrid\Mail\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FreeSchemeRequest;
use App\Mail\FreeSchemeApprovalNotification;
use App\Mail\FreeSchemeApprovalNotificationForAM;
use App\Mail\FreeSchemeApprovalNotificationForZM;
use App\Mail\FreeSchemeApprovalNotificationForRoot;

class FreeSchemesController extends Controller
{
    public function index(Request $request)
    {
        $currentPage = $request->input('page', 1);
        $data = $request->session()->get('search','');
        $status = $request->session()->get('status','');
        // $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])->orderBy('id', 'DESC')->paginate(12);
        // start
        $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
        // $grant_approvals = GrantApproval::with(['Manager.ZonalManager', 'Manager.AreaManager', 'Doctor', 'Activity'])
        ->where(function ($query) use ($data) {
         $query->whereHas('Manager', function ($query) use ($data) {
             $query->where('name', 'like', "%$data%");
         })
         ->orWhereHas('Manager.AreaManager', function ($query) use ($data) {
             $query->where('name', 'like', "%$data%");
         })
         ->orWhereHas('Manager.ZonalManager', function ($query) use ($data) {
             $query->where('name', 'like', "%$data%");
         })
         ->orWhereHas('Stockist', function ($query) use ($data) {
            $query->where('stockist', 'like', "%$data%");
        })
        ->orWhereHas('Doctor', function ($query) use ($data) {
            $query->where('doctor_name', 'like', "%$data%");
        });
        })
        ->where('status', 'like', "%$status%")
        ->orderBy('updated_at', 'DESC')
        ->paginate(12);
        // end
        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Marketing Executive'){
            // $manager = auth()->user()->id;
            // $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            // ->where('employee_id', $manager)
            // ->orderBy('id', 'DESC')->paginate(12);

            // start
            $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            // $grant_approvals = GrantApproval::with(['Manager.ZonalManager', 'Manager.AreaManager', 'Doctor', 'Activity'])
            ->where(function ($query) use ($data) {
             $query->whereHas('Manager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.AreaManager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.ZonalManager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Stockist', function ($query) use ($data) {
                $query->where('stockist', 'like', "%$data%");
            })
            ->orWhereHas('Doctor', function ($query) use ($data) {
                $query->where('doctor_name', 'like', "%$data%");
            });
            })
            ->where('status', 'like', "%$status%")
            ->where('employee_id', auth()->user()->id)
            ->orderBy('updated_at', 'DESC')
            ->paginate(12);
            // end

        } elseif($authUser == 'Area Manager'){
            // $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            // ->whereRelation('Manager', 'reporting_office_2', auth()->user()->id)
            // ->orderBy('id', 'DESC')->paginate(12);

            // start
            $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            // $grant_approvals = GrantApproval::with(['Manager.ZonalManager', 'Manager.AreaManager', 'Doctor', 'Activity'])
            ->where(function ($query) use ($data) {
             $query->whereHas('Manager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.AreaManager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.ZonalManager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Stockist', function ($query) use ($data) {
                $query->where('stockist', 'like', "%$data%");
            })
            ->orWhereHas('Doctor', function ($query) use ($data) {
                $query->where('doctor_name', 'like', "%$data%");
            });
            })
            ->where('status', 'like', "%$status%")
            ->whereRelation('Manager', 'reporting_office_2', auth()->user()->id)
            ->orderBy('updated_at', 'DESC')
            ->paginate(12);
            // end

        } elseif($authUser == 'Zonal Manager'){
            // $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            // ->whereRelation('Manager', 'reporting_office_1', auth()->user()->id)
            // ->orderBy('id', 'DESC')->paginate(12);

            // start
            $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            // $grant_approvals = GrantApproval::with(['Manager.ZonalManager', 'Manager.AreaManager', 'Doctor', 'Activity'])
            ->where(function ($query) use ($data) {
             $query->whereHas('Manager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.AreaManager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.ZonalManager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Stockist', function ($query) use ($data) {
                $query->where('stockist', 'like', "%$data%");
            })
            ->orWhereHas('Doctor', function ($query) use ($data) {
                $query->where('doctor_name', 'like', "%$data%");
            });
            })
            ->where('status', 'like', "%$status%")
            ->whereRelation('Manager', 'reporting_office_1', auth()->user()->id)
            ->orderBy('updated_at', 'DESC')
            ->paginate(12);
            // end
        }
        $request->session()->put('current_page', $currentPage);


        return view('free_schemes.index', ['free_schemes' => $free_schemes]);
    }

    public function create()
    {
        $authUser = auth()->user()->roles->pluck('name')->first();
        $doctors = Doctor::pluck('doctor_name', 'id');
        $stockists = Stockist::pluck('stockist', 'id');
        $chemists = Chemist::pluck('chemist', 'id');
        $employees = Employee::where('designation', 'Marketing Executive')->pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        if($authUser == 'Marketing Executive'){
            $employees = Employee::where('id', auth()->user()->id)
                                    ->pluck('name', 'id');

            $doctors = Doctor::where('reporting_office_3', auth()->user()->id)->pluck('doctor_name', 'id');
            $stockists = Stockist::where('employee_id_3', auth()->user()->id)->pluck('stockist', 'id');
            $chemists = Chemist::where('employee_id', auth()->user()->id)->pluck('chemist', 'id');

        }
        return view('free_schemes.create')->with(['employees'=>$employees, 'stockists'=>$stockists,'chemists'=>$chemists, 'doctors'=>$doctors, 'products'=>$products]);
    }

    public function store(FreeScheme $free_scheme, FreeSchemeRequest $request)
    {
        $input = $request->all();
        if($request->hasFile('proof_of_order')){
            $poffileNameWithExt = $request->file('proof_of_order')->getClientOriginalName();
            $poffilename = pathinfo($poffileNameWithExt, PATHINFO_FILENAME);
            $pofExtention = $request->file('proof_of_order')->getClientOriginalExtension();
            $pofFileNameToStore = $poffilename.'_'.time().'.'.$pofExtention;
            $pofPath = $request->file('proof_of_order')->storeAs('public/FreeScheme/proof_of_order', $pofFileNameToStore);
            $input['proof_of_order'] = $pofFileNameToStore;
        }

        if($request->hasFile('proof_of_delivery')){
            $podfileNameWithExt = $request->file('proof_of_delivery')->getClientOriginalName();
            $podfilename = pathinfo($podfileNameWithExt, PATHINFO_FILENAME);
            $podExtention = $request->file('proof_of_delivery')->getClientOriginalExtension();
            $podFileNameToStore = $podfilename.'_'.time().'.'.$podExtention;
            $podPath = $request->file('proof_of_delivery')->storeAs('public/FreeScheme/proof_of_delivery', $podFileNameToStore);
            $input['proof_of_delivery'] = $podFileNameToStore;
        }

        $input['status'] = 'Open';
        $free_scheme = FreeScheme::create($input);
        $data = $request->collect('free_scheme_details');
        foreach($data as $record){
            FreeSchemeDetail::create([
                'free_scheme_id' => $free_scheme->id,
                'product_id' => $record['product_id'],
                'nrv' => $record['nrv'],
                'qty' => $record['qty'],
                'free' => $record['free'],
                'val' => $record['val'],
                'free_qty' => $record['free_qty'],
            ]);
        }

        if(auth()->user()->roles->pluck('name')->first() == 'Marketing Executive'){
            $condition[] = ['id', '=', $free_scheme->id];
            $print = FreeSchemeDetail::with(['Product', 'FreeScheme'=>[ 'Manager' => ['AreaManager', 'ZonalManager'],'Stockist','Chemist','Doctor']])->whereRelation('FreeScheme', $condition)->get();
               $cEmail =$print[0]->FreeScheme->Manager->AreaManager->communication_email ?? null;
               if(!$cEmail){
                return redirect()->route('free_schemes.index');
               }
            //    Mail::to($print[0]->FreeScheme->Manager->AreaManager->communication_email)
            //    ->send(new FreeSchemeApprovalNotificationForAM($print));
        // start
            $content = view('free_schemes.email_for_am', ['print' => $print])->render();
            $email = new Mail();
            $email->setFrom("webmaster@ehpl.net.in", "Encore");
            $email->setSubject('Free Scheme Notification - ' . $print[0]->FreeScheme->Manager->name);
            $email->addTo($cEmail);
            $email->addContent("text/html",$content);

            $sendgrid = new SendGrid(env('SENDGRID_API_KEY'));

            try {
                $response = $sendgrid->send($email);
            //     Log::info('SendGrid Response:', [
            //         'statusCode' => $response->statusCode(),
            //         'headers' => $response->headers(),
            //         'body' => $response->body(),
            //     ]);
            //   Log::info('email is send to '. $cEmail);
            } catch (\Exception $e) {
                // return 'Caught exception: ' . $e->getMessage();
                $request->session()->flash('error', 'Error while sending email.');
                return redirect()->route('free_schemes.index');
            }
        // end
        }

        $request->session()->flash('success', 'Free Schemes saved successfully!');
        return redirect()->route('free_schemes.index');
    }

    public function report()
    {
        $doctors = Doctor::select('id', 'doctor_name')->OrderBy('doctor_name', 'ASC')->get();
        $zonalManagers = Employee::select('e1.*')->from('employees as e1')->join('employees as e2','e1.id', '=', 'e2.reporting_office_1')->distinct()->get();
        return view('free_schemes.report',compact('doctors','zonalManagers'));
    }

    public function reportFS(Request $request)
    {
        // $condition = [];
        // $fromDate = '';
        // $toDate = '';
        // if(isset($request->from_date)){
        //     $fromDate = Carbon::createFromFormat('Y-m-d', $request->from_date);
        //     $condition[] = ['date_of_issue', '>=' , $fromDate];
        // }

        // if(isset($request->to_date)){
        //     $toDate = Carbon::createFromFormat('Y-m-d', $request->to_date);
        //     $condition[] = ['date_of_issue', '<=' , $toDate];
        // }

        // $doctor = Doctor::all();
        // $grant_approval= GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])->where($condition)->get();
        // $pdf = PDF::loadView('grant_approvals.print', compact('grant_approval','doctor','fromDate','toDate'));
        // $pdf->setPaper('A4', 'landscape');
        // $pdf->render();
        // return $pdf->stream("GAF -" . date("dmY") .".pdf");

        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $doctor = $request->doctor;
        $zonalManager = $request->zonalManager;
        return Excel::download(new FSExport($from_date, $to_date,$doctor,$zonalManager), 'FreeScheme_report.xlsx');
    }


    public function show(FreeScheme $free_scheme)
    {
        //
    }

    public function edit(FreeScheme $free_scheme,Request $request)
    {
        $page = $request->session()->get('current_page', 1);

        $doctors = Doctor::pluck('doctor_name', 'id');
        $stockists = Stockist::pluck('stockist', 'id');
        $chemists = Chemist::pluck('chemist', 'id');
        $employees = Employee::where('designation', 'Marketing Executive')->pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        $free_scheme->load(['FreeSchemeDetail']);
        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Marketing Executive'){
            $employees = Employee::where('id', auth()->user()->id)
                                    ->pluck('name', 'id');

            $doctors = Doctor::where('reporting_office_3', auth()->user()->id)->pluck('doctor_name', 'id');
            $stockists = Stockist::where('employee_id_3', auth()->user()->id)->pluck('stockist', 'id');
            $chemists = Chemist::where('employee_id', auth()->user()->id)->pluck('chemist', 'id');
        }
        return view('free_schemes.edit', ['free_scheme' => $free_scheme, 'employees'=>$employees, 'doctors'=>$doctors, 'stockists'=>$stockists, 'chemists'=>$chemists, 'products'=>$products,'page'=>$page]);
    }

    public function update(FreeScheme $free_scheme, FreeSchemeRequest $request)
    {
        $page = $request->session()->get('current_page', 1);

        $input = $request->all();
        if($request->hasFile('proof_of_order')){
            if ($free_scheme->proof_of_order) {
                Storage::delete('public/FreeScheme/proof_of_order/' . $free_scheme->proof_of_order);
            }
            $poffileNameWithExt = $request->file('proof_of_order')->getClientOriginalName();
            $poffilename = pathinfo($poffileNameWithExt, PATHINFO_FILENAME);
            $pofExtention = $request->file('proof_of_order')->getClientOriginalExtension();
            $pofFileNameToStore = $poffilename.'_'.time().'.'.$pofExtention;
            $pofPath = $request->file('proof_of_order')->storeAs('public/FreeScheme/proof_of_order', $pofFileNameToStore);
            $input['proof_of_order'] = $pofFileNameToStore;
        }

        if($request->hasFile('proof_of_delivery')){

            if ($free_scheme->proof_of_order) {
                Storage::delete('public/FreeScheme/proof_of_delivery/' . $free_scheme->proof_of_order);
            }
            $podfileNameWithExt = $request->file('proof_of_delivery')->getClientOriginalName();
            $podfilename = pathinfo($podfileNameWithExt, PATHINFO_FILENAME);
            $podExtention = $request->file('proof_of_delivery')->getClientOriginalExtension();
            $podFileNameToStore = $podfilename.'_'.time().'.'.$podExtention;
            $podPath = $request->file('proof_of_delivery')->storeAs('public/FreeScheme/proof_of_delivery', $podFileNameToStore);
            $input['proof_of_delivery'] = $podFileNameToStore;
        }


        $free_scheme->update($input);
        $data = $request->collect('free_scheme_details');
        foreach($data as $record){
            FreeSchemeDetail::updateOrCreate([
                'free_scheme_id' => $free_scheme->id,
                'product_id' => $record['product_id'],
                'nrv' => $record['nrv'],
                'qty' => $record['qty'],
                'free_qty' => $record['free_qty'],
                'free' => $record['free'],
                'val' => $record['val'],
            ],[
                'id'
            ]);
        }
        $request->session()->flash('success', 'Free Scheme updated successfully!');
        return redirect()->route('free_schemes.index',['page'=>$page]);
    }

    public function destroy(Request $request, FreeScheme $free_scheme)
    {
        $page = $request->session()->get('current_page', 1);

        if (!empty($free_scheme->proof_of_order) && Storage::exists('public/FreeScheme/proof_of_order/'.$free_scheme->proof_of_order)) {
            Storage::delete('public/FreeScheme/proof_of_order/'.$free_scheme->proof_of_order);
           }

           if (!empty($free_scheme->proof_of_delivery) && Storage::exists('public/FreeScheme/proof_of_delivery/'.$free_scheme->proof_of_delivery)) {
            Storage::delete('public/FreeScheme/proof_of_delivery/'.$free_scheme->proof_of_delivery);
           }

        $free_scheme->delete();
        $request->session()->flash('success', 'Free Scheme deleted successfully!');
        return redirect()->route('free_schemes.index',['page'=>$page]);
    }

    public function rejected(FreeScheme $free_scheme, Request $request)
    {
        $page = $request->session()->get('current_page', 1);

        if(auth()->user()->roles->pluck('name')->first() == 'Root'){
            $free_scheme->status = 'Level 3 Rejected';
            $free_scheme->approval_level_3 = false;
        }
        elseif(auth()->user()->roles->pluck('name')->first() == 'Zonal Manager'){
            $free_scheme->status = 'Level 2 Rejected';
            $free_scheme->approval_level_2 = false;
        } elseif(auth()->user()->roles->pluck('name')->first() == 'Area Manager') {
            $free_scheme->status = 'Level 1 Rejected';
            $free_scheme->approval_level_1 = false;
        } else{
            if($free_scheme->approval_level_1 == false){
                $free_scheme->status = 'Level 2 Rejected';
                $free_scheme->approval_level_2 = false;
            } else {
                $free_scheme->status = 'Level 1 Rejected';
                $free_scheme->approval_level_1 = false;

            }
        }
        $free_scheme->update();
        // $input = [];
        // $input['status'] =  $free_scheme->status;
        // $input['free_scheme_id'] = $free_scheme->id;
        // FreeSchemeDetail::create($input);
        return redirect()->route('free_schemes.index',['page'=>$page]);
    }


    public function approval(FreeScheme $free_scheme, Request $request)
    {
        $page = $request->session()->get('current_page', 1);

       // $free_scheme = GrantApproval::find($request->id);
        $input = [];
        if(auth()->user()->roles->pluck('name')->first() == 'Root'){
            $free_scheme->status = 'Level 3 Approved';
            $free_scheme->approval_level_3 = true;
            $free_scheme->approval_level_2 = true;
            $free_scheme->approval_level_1 = true;
        }
        elseif(auth()->user()->roles->pluck('name')->first() == 'Zonal Manager'){
            $free_scheme->status = 'Level 2 Approved';
            $free_scheme->approval_level_2 = true;
            $free_scheme->approval_level_1 = true;
        } elseif(auth()->user()->roles->pluck('name')->first() == 'Area Manager') {
            $free_scheme->status = 'Level 1 Approved';
            $free_scheme->approval_level_1 = true;
        } else{
            if($free_scheme->approval_level_1 == true){
                $free_scheme->status = 'Level 2 Approved';
                $free_scheme->approval_level_2 = true;

            } else {
                $free_scheme->status = 'Level 1 Approved';
                $free_scheme->approval_level_1 = true;
            }
        }

        $free_scheme->approved_on = Carbon::now();
        $free_scheme->update();

        if(auth()->user()->roles->pluck('name')->first() == 'Root'){
            $condition[] = ['id', '=', $free_scheme->id];
            $print = FreeSchemeDetail::with(['Product', 'FreeScheme'=>[ 'Manager' => ['AreaManager', 'ZonalManager'],'Stockist','Chemist','Doctor']])->whereRelation('FreeScheme', $condition)->get();
            $recipients = null;
            $stockistEmail = $print[0]->FreeScheme->Stockist->cfa_email;
            $zonalManagerEmail = $print[0]->FreeScheme->Manager->ZonalManager->communication_email;
            if (filter_var($stockistEmail, FILTER_VALIDATE_EMAIL)) {
                $recipients = $stockistEmail;
            }
            // if (filter_var($zonalManagerEmail, FILTER_VALIDATE_EMAIL)) {
            //     $recipients[] = $zonalManagerEmail;
            // }
            //    Mail::to($recipients)
            //    ->cc("ssingh@encoregroup.net")
            // //    ->bcc($print[0]->FreeScheme->Manager->ZonalManager->communication_email)
            //    ->send(new FreeSchemeApprovalNotification($print));

             // start
             $content = view('free_schemes.approval_mail', ['print' => $print])->render();
             $email = new Mail();
             $email->setFrom("webmaster@ehpl.net.in", "Encore");

             $stockist = $print[0]->FreeScheme->Stockist->stockist ?? null;
             $chemist = $print[0]->FreeScheme->Chemist->chemist ?? null;
            
            if(!$stockist){
                $email->setSubject('Free Scheme Approval - '. $chemist);
            }elseif(!$chemist){
                $email->setSubject('Free Scheme Approval - '. $stockist);
            }
            else{
                $email->setSubject('Free Scheme Approval - '. $stockist . ', ' . $chemist);
            }
             $email->addTo($recipients);
             $email->addCc('ssingh@encoregroup.net'); //sunil
             if(@$print[0]->FreeScheme->Manager->ZonalManager->communication_email){
                $email->addBcc($print[0]->FreeScheme->Manager->ZonalManager->communication_email);
             }
             $email->addContent("text/html",$content);
 
             $sendgrid = new SendGrid(env('SENDGRID_API_KEY'));
 
             try {
                 $response = $sendgrid->send($email);
                //  Log::info('SendGrid Response:', [
                //      'statusCode' => $response->statusCode(),
                //      'headers' => $response->headers(),
                //      'body' => $response->body(),
                //  ]);
            //    Log::info('email is send to '. $recipients);
             } catch (\Exception $e) {
                 // return 'Caught exception: ' . $e->getMessage();
                 $request->session()->flash('error', 'Error while sending email.');
                 return redirect()->route('free_schemes.index');
                }
         // end
        }

    
        if(auth()->user()->roles->pluck('name')->first() == 'Area Manager'){
            $condition[] = ['id', '=', $free_scheme->id];
            $print = FreeSchemeDetail::with(['Product', 'FreeScheme'=>[ 'Manager' => ['AreaManager', 'ZonalManager'],'Stockist','Chemist','Doctor']])->whereRelation('FreeScheme', $condition)->get();
               $cEmail = $print[0]->FreeScheme->Manager->ZonalManager->communication_email;
               if(!$cEmail){
                return redirect()->route('free_schemes.index');
               }
            //    Mail::to($email)
            //    ->send(new FreeSchemeApprovalNotificationForZM($print));
             // start
             $content = view('free_schemes.email_for_zm', ['print' => $print])->render();
             $email = new Mail();
             $email->setFrom("webmaster@ehpl.net.in", "Encore");
             $email->setSubject('Free Scheme Notification - '. $print[0]->FreeScheme->Manager->AreaManager->name);
             $email->addTo($cEmail);
             $email->addContent("text/html",$content);
 
             $sendgrid = new SendGrid(env('SENDGRID_API_KEY'));
 
             try {
                 $response = $sendgrid->send($email);
                //  Log::info('SendGrid Response:', [
                //      'statusCode' => $response->statusCode(),
                //      'headers' => $response->headers(),
                //      'body' => $response->body(),
                //  ]);
            //    Log::info('email is send to '. $cEmail);
             } catch (\Exception $e) {
                 // return 'Caught exception: ' . $e->getMessage();
                 $request->session()->flash('error', 'Error while sending email.');
                 return redirect()->route('free_schemes.index');
                }
         // end
            
        }

        if(auth()->user()->roles->pluck('name')->first() == 'Zonal Manager'){
            $condition[] = ['id', '=', $free_scheme->id];
            $print = FreeSchemeDetail::with(['Product', 'FreeScheme'=>[ 'Manager' => ['AreaManager', 'ZonalManager'],'Stockist','Chemist','Doctor']])->whereRelation('FreeScheme', $condition)->get();
               $cEmail = $print[0]->FreeScheme->Manager->ZonalManager->communication_email ?? null;
               if(!$cEmail){
                return redirect()->route('free_schemes.index');
               }
            //    Mail::to($cEmail)
            //    ->cc("ssingh@encoregroup.net")
            //    ->send(new FreeSchemeApprovalNotificationForRoot($print));
             // start
             $content = view('free_schemes.email_for_root', ['print' => $print])->render();
             $email = new Mail();
             $email->setFrom("webmaster@ehpl.net.in", "Encore");
             $email->setSubject('Free Scheme Notification - ' .$print[0]->FreeScheme->Manager->ZonalManager->name);
             $email->addTo($cEmail);
             $email->addCc('ssingh@encoregroup.net');
             $email->addContent("text/html",$content);
 
             $sendgrid = new SendGrid(env('SENDGRID_API_KEY'));
 
             try {
                 $response = $sendgrid->send($email);
                //  Log::info('SendGrid Response:', [
                //      'statusCode' => $response->statusCode(),
                //      'headers' => $response->headers(),
                //      'body' => $response->body(),
                //  ]);
            //    Log::info('email is send to '. $cEmail);
             } catch (\Exception $e) {
                 // return 'Caught exception: ' . $e->getMessage();
                 $request->session()->flash('error', 'Error while sending email.');
                 return redirect()->route('free_schemes.index',['page'=>$page]);
             }
         // end
            
        }

        return redirect()->route('free_schemes.index',['page'=>$page]);
    }



     public function approval_form(FreeScheme $free_scheme,Request $request)
    {
        $page = $request->session()->get('current_page', 1);

        $doctors = Doctor::pluck('doctor_name', 'id');
        $stockists = Stockist::pluck('stockist', 'id');
        $chemists = Chemist::pluck('chemist', 'id');
        $employees = Employee::where('designation', 'Marketing Executive')->pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        $free_scheme->load(['FreeSchemeDetail']);
        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Marketing Executive'){
            $employees = Employee::where('id', auth()->user()->id)
                                    ->pluck('name', 'id');

            $doctors = Doctor::where('reporting_office_3', auth()->user()->id)->pluck('doctor_name', 'id');
            $stockists = Stockist::where('employee_id_3', auth()->user()->id)->pluck('stockist', 'id');
            $chemists = Chemist::where('employee_id', auth()->user()->id)->pluck('chemist', 'id');
        }
        return view('free_schemes.approval_form', ['free_scheme' => $free_scheme, 'employees'=>$employees, 'doctors'=>$doctors, 'stockists'=>$stockists, 'chemists'=>$chemists, 'products'=>$products,'page'=>$page]);
    }

    public function search(Request $request){
        $data = $request->input('search');
        $status = $request->input('status');

        $page = $request->input('page', 1);
        $request->session()->put('current_page', $page);
        
        $request->session()->put('search', $data);
        $request->session()->put('status', $status);

        $authUser = auth()->user()->roles->pluck('name')->first();

        if($authUser == 'Marketing Executive'){
            $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            // $grant_approvals = GrantApproval::with(['Manager.ZonalManager', 'Manager.AreaManager', 'Doctor', 'Activity'])
            ->where(function ($query) use ($data) {
             $query->whereHas('Manager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.AreaManager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.ZonalManager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Stockist', function ($query) use ($data) {
                $query->where('stockist', 'like', "%$data%");
            })
            ->orWhereHas('Doctor', function ($query) use ($data) {
                $query->where('doctor_name', 'like', "%$data%");
            });
            })
            ->where('status', 'like', "%$status%")
            ->where('employee_id', auth()->user()->id)
            ->paginate(12);

        }elseif($authUser == 'Area Manager'){
            $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            // $grant_approvals = GrantApproval::with(['Manager.ZonalManager', 'Manager.AreaManager', 'Doctor', 'Activity'])
            ->where(function ($query) use ($data) {
             $query->whereHas('Manager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.AreaManager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.ZonalManager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Stockist', function ($query) use ($data) {
                $query->where('stockist', 'like', "%$data%");
            })
            ->orWhereHas('Doctor', function ($query) use ($data) {
                $query->where('doctor_name', 'like', "%$data%");
            });
            })
            ->where('status', 'like', "%$status%")
            ->whereRelation('Manager', 'reporting_office_2', auth()->user()->id)
            ->paginate(12);

        } elseif($authUser == 'Zonal Manager'){
            $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            // $grant_approvals = GrantApproval::with(['Manager.ZonalManager', 'Manager.AreaManager', 'Doctor', 'Activity'])
            ->where(function ($query) use ($data) {
             $query->whereHas('Manager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.AreaManager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.ZonalManager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Stockist', function ($query) use ($data) {
                $query->where('stockist', 'like', "%$data%");
            })
            ->orWhereHas('Doctor', function ($query) use ($data) {
                $query->where('doctor_name', 'like', "%$data%");
            });
            })
            ->where('status', 'like', "%$status%")
            ->whereRelation('Manager', 'reporting_office_1', auth()->user()->id)
            ->paginate(12);

        }else{
            $free_schemes = FreeScheme::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Stockist', 'Chemist'])
            // $grant_approvals = GrantApproval::with(['Manager.ZonalManager', 'Manager.AreaManager', 'Doctor', 'Activity'])
            ->where(function ($query) use ($data) {
             $query->whereHas('Manager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.AreaManager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.ZonalManager', function ($query) use ($data) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Stockist', function ($query) use ($data) {
                $query->where('stockist', 'like', "%$data%");
            })
            ->orWhereHas('Doctor', function ($query) use ($data) {
                $query->where('doctor_name', 'like', "%$data%");
            });
            })
            ->where('status', 'like', "%$status%")
            ->paginate(12);
        }

        $free_schemes = $free_schemes->appends([
            'search' => $data,
            'status' => $status,
        ]);


        return view('free_schemes.index', ['free_schemes'=>$free_schemes,'search'=>$data,'status'=>$status]);

    }


    public function showPOOfiles(string $files){
        $path = storage_path('app/public/FreeScheme/proof_of_order/'.$files);

        if(!file_exists($path)){
           abort(404);
        }

        $file = File::get($path);
        $type = \File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        $response->header('Content-Disposition', 'inline; filename="' . $files . '"');

        return $response;
       // return response()->json(['url'=> url('api/storage/'.$files)]);
   }

   public function showPODfiles(string $files){
    $path = storage_path('app/public/FreeScheme/proof_of_delivery/'.$files);

    if(!file_exists($path)){
       abort(404);
    }

    $file = File::get($path);
    $type = \File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    $response->header('Content-Disposition', 'inline; filename="' . $files . '"');

    return $response;
   // return response()->json(['url'=> url('api/storage/'.$files)]);
}


    public function resendEmail(FreeScheme $free_scheme){
       
        if(auth()->user()->roles->pluck('name')->first() == 'Root'){
            $condition[] = ['id', '=', $free_scheme->id];
            $print = FreeSchemeDetail::with(['Product', 'FreeScheme'=>[ 'Manager' => ['AreaManager', 'ZonalManager'],'Stockist','Chemist','Doctor']])->whereRelation('FreeScheme', $condition)->get();
            $recipients = null;
            $stockistEmail = $print[0]->FreeScheme->Stockist->cfa_email;
            $zonalManagerEmail = $print[0]->FreeScheme->Manager->ZonalManager->communication_email;
            if (filter_var($stockistEmail, FILTER_VALIDATE_EMAIL)) {
                $recipients = $stockistEmail;
            }
            // if (filter_var($zonalManagerEmail, FILTER_VALIDATE_EMAIL)) {
            //     $recipients[] = $zonalManagerEmail;
            // }
            //    Mail::to($recipients)
            //    ->cc("ssingh@encoregroup.net")
            // //    ->bcc($print[0]->FreeScheme->Manager->ZonalManager->communication_email)
            //    ->send(new FreeSchemeApprovalNotification($print));



            
             // start
             $content = view('free_schemes.approval_mail', ['print' => $print])->render();
             $email = new Mail();
             $email->setFrom("webmaster@ehpl.net.in", "Encore");

             $stockist = $print[0]->FreeScheme->Stockist->stockist ?? null;
             $chemist = $print[0]->FreeScheme->Chemist->chemist ?? null;
            
            if(!$stockist){
                $email->setSubject('Free Scheme Approval - '. $chemist);
            }elseif(!$chemist){
                $email->setSubject('Free Scheme Approval - '. $stockist);
            }
            else{
                $email->setSubject('Free Scheme Approval - '. $stockist . ', ' . $chemist);
            }
             $email->addTo($recipients);
             $email->addCc('ssingh@encoregroup.net'); //sunil
             if(@$print[0]->FreeScheme->Manager->ZonalManager->communication_email){
                $email->addBcc($print[0]->FreeScheme->Manager->ZonalManager->communication_email);
             }
             $email->addContent("text/html",$content);
 
             $sendgrid = new SendGrid(env('SENDGRID_API_KEY'));
 
             try {
                 $response = $sendgrid->send($email);
                //  Log::info('SendGrid Response:', [
                //      'statusCode' => $response->statusCode(),
                //      'headers' => $response->headers(),
                //      'body' => $response->body(),
                //  ]);
            //    Log::info('email is send to '. $recipients);
             } catch (\Exception $e) {
                 // return 'Caught exception: ' . $e->getMessage();
                 $request->session()->flash('error', 'Error while sending email.');
                 return redirect()->route('free_schemes.index');
                }
         // end
              return redirect()->back()->with('emailSuccess', 'email sent sucessfully');
        }

    }



}

// }