<?php

namespace App\Http\Controllers;
use PDF;
use Excel;
use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Activity;
use App\Models\Employee;
use App\Exports\GAFExport;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GrantApproval;
use App\Models\GrantApprovalDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Mail;
use SendGrid;
use SendGrid\Mail\Mail;
use App\Models\GrantApproval\codeGenerate;
use App\Http\Requests\GrantApprovalRequest;
use App\Mail\GrantApprovalNotificationForAM;
use App\Mail\GrantApprovalNotificationForZM;
use App\Mail\GrantApprovalNotificationForRoot;


class GrantApprovalsController extends Controller
{
    public function index(Request $request)
    {
        $currentPage = $request->input('page', 1);
        $request->session()->put('current_page', $currentPage);

        $data = $request->session()->get('search','');
        $status = $request->session()->get('status','');
        $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])->orderBy('updated_at', 'DESC')->paginate(12);
        
        // start
        $grant_approvals = GrantApproval::with(['Manager.ZonalManager', 'Manager.AreaManager', 'Doctor', 'Activity'])
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
         ->orWhereHas('Doctor', function ($query) use ($data) {
            $query->where('doctor_name', 'like', "%$data%");
        })
         ->orWhere('code', 'like', "%$data%");
        })
        ->where('status', 'like', "%$status%")
        ->orderBy('updated_at', 'DESC')
        ->paginate(12);
        // end
        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Marketing Executive'){
            // $manager = auth()->user()->id;
            // $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])
            // ->where('employee_id', $manager)
            // ->orderBy('code', 'DESC')->paginate(12);

            //  start
            $grant_approvals = GrantApproval::with(['Manager.ZonalManager', 'Manager.AreaManager', 'Doctor', 'Activity'])
            ->where(function ($query) use ($data,$status) {
             $query->whereHas('Manager', function ($query) use ($data, $status) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.AreaManager', function ($query) use ($data,$status) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.ZonalManager', function ($query) use ($data, $status) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Doctor', function ($query) use ($data) {
                $query->where('doctor_name', 'like', "%$data%");
            })
             ->orWhere('code', 'like', "%$data%");
            })
            ->where('status', 'like', "%$status%")
            ->where('employee_id', auth()->user()->id)
            ->orderBy('updated_at', 'DESC')
            ->paginate(12);
            
            //  end
          
        } elseif($authUser == 'Area Manager'){
            // $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])
            //     ->whereRelation('Manager', 'reporting_office_2', auth()->user()->id)
            //     ->orderBy('code', 'DESC')->paginate(12);

            // start
            $grant_approvals = GrantApproval::with(['Manager.ZonalManager', 'Manager.AreaManager', 'Doctor', 'Activity'])
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
             ->orWhereHas('Doctor', function ($query) use ($data) {
                $query->where('doctor_name', 'like', "%$data%");
            })
             ->orWhere('code', 'like', "%$data%");
            })
            ->where('status', 'like', "%$status%")
            ->whereRelation('Manager', 'reporting_office_2', auth()->user()->id)
            ->orderBy('updated_at', 'DESC')
            ->paginate(12);
            // end
           
        } elseif($authUser == 'Zonal Manager'){
            // $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])
            // ->whereRelation('Manager', 'reporting_office_1', auth()->user()->id)
            // // ->where('approval_level_1', true) //already comented
            // // ->where('status','Level 2 Approved')  //already comented
            // ->orderBy('code', 'DESC')->paginate(12);      

            
            //  start
            $grant_approvals = GrantApproval::with(['Manager.ZonalManager', 'Manager.AreaManager', 'Doctor', 'Activity'])
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
             ->orWhereHas('Doctor', function ($query) use ($data) {
                $query->where('doctor_name', 'like', "%$data%");
            })
             ->orWhere('code', 'like', "%$data%");
            })
            ->where('status', 'like', "%$status%")
            ->whereRelation('Manager', 'reporting_office_1', auth()->user()->id)
            ->orderBy('updated_at', 'DESC')
            ->paginate(12);
            // end
        }       
        
    
            // $request->session()->put('current_page', $currentPage);
    
        
        return view('grant_approvals.index', ['grant_approvals' => $grant_approvals,'data'=>$data,'status'=>$status]);
    }

    public function create()
    {
        $authUser = auth()->user()->roles->pluck('name')->first();       
        $doctors = Doctor::pluck('doctor_name', 'id');
        $activities = Activity::pluck('name', 'id');
        $employees = Employee::where('designation', 'Marketing Executive')->pluck('name', 'id');
        if($authUser == 'Marketing Executive'){
            $employees = Employee::where('id', auth()->user()->id)
                                    ->pluck('name', 'id');   
                                    
            $doctors = Doctor::where('reporting_office_3', auth()->user()->id)->pluck('doctor_name', 'id');
            
        }
        return view('grant_approvals.create')->with(['employees'=>$employees, 'activities'=>$activities, 'doctors'=>$doctors]);
    }

    public function store(GrantApproval $grant_approval, GrantApprovalRequest $request) 
    {
        $input = $request->all();      
        $input['status'] = 'Open';
        $grant_approval = GrantApproval::create($input); 

        if(auth()->user()->roles->pluck('name')->first() == 'Marketing Executive'){
            $print = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])->where('id', $grant_approval->id)->get();
            // $print = FreeSchemeDetail::with(['Product', 'FreeScheme'=>[ 'Manager' => ['AreaManager', 'ZonalManager'],'Stockist','Chemist','Doctor']])->whereRelation('FreeScheme', $condition)->get();
               $cEmail = $print[0]->Manager->AreaManager->communication_email;
               if(!$cEmail){
                return redirect()->route('grant_approvals.index');
               }
            //    Mail::to($print[0]->Manager->AreaManager->communication_email)
            //    ->send(new GrantApprovalNotificationForAM($print));


             // start
             $content = view('grant_approvals.email_for_am', ['print' => $print])->render();
             $email = new Mail();
             $email->setFrom("webmaster@ehpl.net.in", "Encore");
             $email->setSubject('Grant Approval Notification - ' . $print[0]->Manager->name);
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
                 return redirect()->route('grant_approvals.index'); 
             }
         // end
            
        }
        
        $request->session()->flash('success', 'Grant Approval saved successfully!');
        return redirect()->route('grant_approvals.index'); 
    }
  
    public function show(GrantApproval $grant_approval)
    {
        $grant_approval->load(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor']);
        return $grant_approval;
    }

    public function edit(GrantApproval $grant_approval, Request $request)
    {
        $page = $request->session()->get('current_page', 1);
        $doctors = Doctor::pluck('doctor_name', 'id');
        $activities = Activity::pluck('name', 'id');
        $employees = Employee::where('designation', 'Marketing Executive')->pluck('name', 'id');
        $grant_approval->load(['GrantApprovalDetail'=>['Employee']]);

        $authUser = auth()->user()->roles->pluck('name')->first();   
        if($authUser == 'Marketing Executive'){
            $employees = Employee::where('id', auth()->user()->id)
                                    ->pluck('name', 'id');   
                                    
            $doctors = Doctor::where('reporting_office_3', auth()->user()->id)->pluck('doctor_name', 'id');
            // dd($doctors);
        }
        return view('grant_approvals.edit', ['grant_approval' => $grant_approval, 'employees'=>$employees, 'doctors'=>$doctors, 'activities'=>$activities, 'page'=>$page]);
    }

    public function update(GrantApproval $grant_approval, GrantApprovalRequest $request) 
    {
        $page = $request->session()->get('current_page', 1);

        if(empty($grant_approval->code)){
            $code = new GrantApproval();  
            $grant_approval->code = $code->codeGenerate();
        }
        $grant_approval->update($request->all());
        $request->session()->flash('success', 'Grant Approval updated successfully!');
        return redirect()->route('grant_approvals.index',['page'=>$page]);
    }

    

    public function rejected(GrantApproval $grant_approval) 
    {
       

        if(auth()->user()->roles->pluck('name')->first() == 'Zonal Manager'){
            $grant_approval->status = 'Level 2 Rejected';
            $grant_approval->approval_level_2 = false;
        } elseif(auth()->user()->roles->pluck('name')->first() == 'Area Manager') {
            $grant_approval->status = 'Level 1 Rejected';
            $grant_approval->approval_level_1 = false;
        } else{
            if($grant_approval->approval_level_1 == false){
                $grant_approval->status = 'Level 2 Rejected';
                $grant_approval->approval_level_2 = false;
            } else {
                $grant_approval->status = 'Level 1 Rejected';
                $grant_approval->approval_level_1 = false;

            }
        }     
        $grant_approval->update();
        $input = [];
        $input['status'] =  $grant_approval->status;
        $input['amount'] = $grant_approval->amount;
        $input['grant_approval_id'] = $grant_approval->id;
        GrantApprovalDetail::create($input);
        return redirect()->route('grant_approvals.index');
    }

    public function approvalSecond(GrantApproval $grant_approval) 
    {
        $grant_approval->status = 'Approved';
        $grant_approval->update();
        $input = [];
        $input['status'] = 'Zonal Manager Approved';
        $input['amount'] = $grant_approval->amount;
        $input['grant_approval_id'] = $grant_approval->id;
        GrantApprovalDetail::create($input);
        return redirect()->route('grant_approvals.index');
    }

    public function rejectedSecond(GrantApproval $grant_approval) 
    {
        $grant_approval->status = 'Zonal Manager Rejected';
        $grant_approval->update();
        $input = [];

        $input['status'] = 'Rejected';
        $input['amount'] = $grant_approval->amount;
        $input['grant_approval_id'] = $grant_approval->id;
        GrantApprovalDetail::create($input);

        return redirect()->route('grant_approvals.index');
    }
  
    public function destroy(Request $request, GrantApproval $grant_approval)
    {
        $grant_approval->delete();
        $request->session()->flash('success', 'Grant Approval deleted successfully!');
        return redirect()->route('grant_approvals.index');
    }

    public function report()
    {
        $activities = Activity::all();
        $doctors = Doctor::select('id', 'doctor_name')->OrderBy('doctor_name', 'ASC')->get();
        // $zonalManagers = Employee::select('id','name')->distinct('reporting_office_1')->get();
        //$zonalManagers = GrantApproval::with(['Manager'=> ['ZonalManager']])->get();
      
         $zonalManagers = Employee::select('e1.*')->from('employees as e1')->join('employees as e2','e1.id', '=', 'e2.reporting_office_1')->distinct()->get();
        return view('grant_approvals.report',compact('activities','doctors', 'zonalManagers'));
    }

    public function reportPDF(Request $request)
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
        $activity = $request->activity;
        $doctor = $request->doctor;
        $zonalManager = $request->zonalManager;

        // Log::info("working");
        return Excel::download(new GAFExport($from_date, $to_date, $activity,$doctor, $zonalManager), 'GAF_report.xlsx');
    }

    public function approval_form(GrantApproval $grant_approval, Request $request)
    {        
        $page = $request->session()->get('current_page', 1);

        $doctors = Doctor::pluck('doctor_name', 'id');
        $activities = Activity::pluck('name', 'id');
        $employees = Employee::where('designation', 'Marketing Executive')->pluck('name', 'id');
        $grant_approval->load(['GrantApprovalDetail'=>['Employee']]);

        $authUser = auth()->user()->roles->pluck('name')->first();   
        if($authUser == 'Marketing Executive'){
            $employees = Employee::where('id', auth()->user()->id)
                                    ->pluck('name', 'id');   
                                    
            $doctors = Doctor::where('reporting_office_2', auth()->user()->id)->pluck('doctor_name', 'id');
            // dd($doctors);
        }
        return view('grant_approvals.approval_form', ['grant_approval' => $grant_approval, 'employees'=>$employees, 'doctors'=>$doctors, 'activities'=>$activities,'page'=>$page]);
    }

    public function approval(GrantApproval $grant_approval, Request $request) 
    {
        $page = $request->session()->get('current_page', 1);

        $grant_approval = GrantApproval::find($request->id);
        $input = [];
        if(auth()->user()->roles->pluck('name')->first() == 'Zonal Manager'){
            $grant_approval->status = 'Level 2 Approved';
            $grant_approval->approval_level_2 = true;
            $grant_approval->approval_level_1 = true;
        } elseif(auth()->user()->roles->pluck('name')->first() == 'Area Manager') {
            $grant_approval->status = 'Level 1 Approved';
            $grant_approval->approval_level_1 = true;
        } else{
            if($grant_approval->approval_level_1 == true){
                $grant_approval->status = 'Level 2 Approved';
                $grant_approval->approval_level_2 = true;
            } else {
                $grant_approval->status = 'Level 1 Approved';
                $grant_approval->approval_level_1 = true;
            }
        }     
        $grant_approval->approval_amount = $request->amount;    
        $grant_approval->approved_on = Carbon::now();
        $grant_approval->update();
        $input = [];
        $input['status'] =  $grant_approval->status;
        $input['amount'] = $grant_approval->approval_amount;
        $input['grant_approval_id'] = $grant_approval->id;
        GrantApprovalDetail::create($input);

        if(auth()->user()->roles->pluck('name')->first() == 'Area Manager'){
            $print = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])->where('id', $grant_approval->id)->get();
               $cEmail = $print[0]->Manager->ZonalManager->communication_email;
               if(!$cEmail){
                return redirect()->route('grant_approvals.index');
               }
            //    Mail::to($print[0]->Manager->ZonalManager->communication_email)
            //    ->send(new GrantApprovalNotificationForZM($print));
             // start
             $content = view('grant_approvals.email_for_zm', ['print' => $print])->render();
             $email = new Mail();
             $email->setFrom("webmaster@ehpl.net.in", "Encore");
             $email->setSubject('Grant Approval Notification - ' .$print[0]->Manager->AreaManager->name);
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
                 return redirect()->route('grant_approvals.index'); 
             }
         // end
            
        }

        if(auth()->user()->roles->pluck('name')->first() == 'Zonal Manager'){
            $print = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])->where('id', $grant_approval->id)->get();
               $cEmail = $print[0]->Manager->ZonalManager->communication_email;
               if(!$cEmail){
                return redirect()->route('grant_approvals.index');
               }
            //    Mail::to($email)
            //    ->cc("ssingh@encoregroup.net")
            //    ->send(new GrantApprovalNotificationForRoot($print));

              // start
              $content = view('grant_approvals.email_for_root', ['print' => $print])->render();
              $email = new Mail();
              $email->setFrom("webmaster@ehpl.net.in", "Encore");
              $email->setSubject('Grant Approval Notification - ' .$print[0]->Manager->ZonalManager->name);
              $email->addTo($cEmail);
              $email->addCc('ssingh@encoregroup.net'); //sunil
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
                  return redirect()->route('grant_approvals.index'); 
              }
          // end
            
        }


        return redirect()->route('grant_approvals.index',['page'=>$page]);
    }

    public function getGrantApprovalData($id)
    {
        $authUser = auth()->user()->roles->pluck('name')->first();
        if($authUser == 'Area Manager'){
            $grant_approvals = GrantApproval::with(['Manager'=>['ZonalManager', 'AreaManager'], 'Doctor', 'Activity'])
                ->whereRelation('Manager', 'reporting_office_2', auth()->user()->id)
                ->where('id', $id)
                ->orderBy('code', 'DESC')
                ->get();
        } 
        return $grant_approvals;
    }

    public function reject_form(GrantApproval $grant_approval, Request $request)
    {        
        $page = $request->session()->get('current_page', 1);

        $doctors = Doctor::pluck('doctor_name', 'id');
        $activities = Activity::pluck('name', 'id');
        $employees = Employee::where('designation', 'Marketing Executive')->pluck('name', 'id');
        $grant_approval->load(['GrantApprovalDetail'=>['Employee']]);

        $authUser = auth()->user()->roles->pluck('name')->first();   
        if($authUser == 'Marketing Executive'){
            $employees = Employee::where('id', auth()->user()->id)
                                    ->pluck('name', 'id');   
                                    
            $doctors = Doctor::where('reporting_office_2', auth()->user()->id)->pluck('doctor_name', 'id');
            // dd($doctors);
        }
        return view('grant_approvals.reject_form', ['grant_approval' => $grant_approval, 'employees'=>$employees, 'doctors'=>$doctors, 'activities'=>$activities,'page'=>$page]);
    }

    public function rejection(Request $request, GrantApproval $grant_approval) 
    {
        $page = $request->session()->get('current_page', 1);


        if(auth()->user()->roles->pluck('name')->first() == 'Zonal Manager'){
            $grant_approval->status = 'Level 2 Rejected';
            $grant_approval->approval_level_2 = false;
            $grant_approval->remark = $request->input('remark');
        } elseif(auth()->user()->roles->pluck('name')->first() == 'Area Manager') {
            $grant_approval->status = 'Level 1 Rejected';
            $grant_approval->approval_level_1 = false;
            $grant_approval->remark = $request->input('remark');
        } else{
            if($grant_approval->approval_level_1 == false){
                $grant_approval->status = 'Level 2 Rejected';
                $grant_approval->approval_level_2 = false;
                $grant_approval->remark = $request->input('remark');
            } else {
                $grant_approval->status = 'Level 1 Rejected';
                $grant_approval->approval_level_1 = false;
                $grant_approval->remark = $request->input('remark');
            }
        }     
        $grant_approval->update();
        $input = [];
        $input['status'] =  $grant_approval->status;
        $input['amount'] = $grant_approval->amount;
        $input['grant_approval_id'] = $grant_approval->id;
        GrantApprovalDetail::create($input);
        return redirect()->route('grant_approvals.index',['page'=>$page]);
    }

    public function search(Request $request){
        $data = $request->input('search');
        $status = $request->input('status');
        // $page = $request->session()->get('current_page', 1);
        $page = $request->input('page', 1);
        $request->session()->put('current_page', $page);
        $authUser = auth()->user()->roles->pluck('name')->first();

        // if(!$data){
        //     $data = $request->session()->get('search', '');
        //   }
  
        //   if(!$status){
        //       $status = $request->session()->get('status', '');
        //     }
  
          $request->session()->put('search', $data);
          $request->session()->put('status', $status);
          
        if($authUser == 'Marketing Executive'){
            $grant_approvals = GrantApproval::with(['Manager.ZonalManager', 'Manager.AreaManager', 'Doctor', 'Activity'])
            ->where(function ($query) use ($data,$status) {
             $query->whereHas('Manager', function ($query) use ($data, $status) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.AreaManager', function ($query) use ($data,$status) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Manager.ZonalManager', function ($query) use ($data, $status) {
                 $query->where('name', 'like', "%$data%");
             })
             ->orWhereHas('Doctor', function ($query) use ($data) {
                $query->where('doctor_name', 'like', "%$data%");
            })
             ->orWhere('code', 'like', "%$data%");
            })
            ->where('status', 'like', "%$status%")
            ->where('employee_id', auth()->user()->id)
            ->paginate(12);
          
        }elseif($authUser == 'Area Manager'){

            $grant_approvals = GrantApproval::with(['Manager.ZonalManager', 'Manager.AreaManager', 'Doctor', 'Activity'])
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
             ->orWhereHas('Doctor', function ($query) use ($data) {
                $query->where('doctor_name', 'like', "%$data%");
            })
             ->orWhere('code', 'like', "%$data%");
            })
            ->where('status', 'like', "%$status%")
            ->whereRelation('Manager', 'reporting_office_2', auth()->user()->id)
            ->paginate(12);

        } elseif($authUser == 'Zonal Manager'){

            $grant_approvals = GrantApproval::with(['Manager.ZonalManager', 'Manager.AreaManager', 'Doctor', 'Activity'])
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
             ->orWhereHas('Doctor', function ($query) use ($data) {
                $query->where('doctor_name', 'like', "%$data%");
            })
             ->orWhere('code', 'like', "%$data%");
            })
            ->where('status', 'like', "%$status%")
            ->whereRelation('Manager', 'reporting_office_1', auth()->user()->id)
            ->paginate(12);

        }else{
            $grant_approvals = GrantApproval::with(['Manager.ZonalManager', 'Manager.AreaManager', 'Doctor', 'Activity'])
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
             ->orWhereHas('Doctor', function ($query) use ($data) {
                $query->where('doctor_name', 'like', "%$data%");
            })
             ->orWhere('code', 'like', "%$data%");
            })
            ->where('status', 'like', "%$status%")
            ->paginate(12);
        }
   
        $grant_approvals = $grant_approvals->appends([
            'search' => $data,
            'status' => $status,
            'page'=>$page,
        ]);

        return view('grant_approvals.index', ['grant_approvals'=>$grant_approvals, 'data'=> $data, 'status'=> $status,'page'=>$page]);

    }

   
    
}