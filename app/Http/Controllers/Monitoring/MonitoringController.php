<?php

namespace App\Http\Controllers\Monitoring;

use Illuminate\Http\Request;
use Request as AjaxRequest;
use App\Http\Controllers\Controller;
use PDF;
use Client;
use Validator;


class MonitoringController extends Controller
{

    /**
     * Display a listing of the resource. //sfsdjfg fsdfu sdfjsdf fu
     *
     * @return \Illuminate\Http\Response
     */
    protected $columns = [
        'ref_number',
        'request_amount',
        'created_at',
        'branch_id',
        'prescreening_status',
        'status',
        'waktu_aging',
    ];
    
    public function getUser(){

      /* GET UserLogin Data */
         $users = session()->get('user');
             foreach ($users as $user) {
                 $data = $user;
             }
         return $data;
     }

    public function index()
    {
        $data = $this->getUser();

	   return view('internals.monitoring.index',compact('data'));
    }

   //datatable
//datatable
public function datatables(Request $request)
{
    $sort = $request->input('order.0');
    $data = $this->getUser();
            
    $eforms = Client::setEndpoint('monitoring')
            ->setHeaders([
              'Authorization' => $data['token']
              , 'pn' => $data['pn']
              , 'long' => number_format($request->get('long', env('DEF_LONG', '106.81350')), 5)
              , 'lat' => number_format($request->get('lat', env('DEF_LAT', '-6.21670')), 5)
            ])
            ->setQuery([
              'limit'     => $request->input('length'),
              'product_type'     => $request->input('product_type'),
              'source'     => $request->input('source'),
              'dev_id'     => $request->input('dev_id'),
              'kanwil_id'     => $request->input('kanwil_id'),
              'branch_id'     => $request->input('branch_id'),
              'sort'      => $this->columns[$sort['column']] .'|'. $sort['dir'],
              'search'    => $request->input('search.value'),
              'page'      => (int) $request->input('page') + 1,
              'is_screening' => $request->input('is_screening'),
            ])->get();
    
//    dd($eforms);die();
// print_r($eforms);die();
        
    foreach ($eforms['contents']['data'] as $key => $form) {
        if($form['ref_number']!=null || $form['ref_number']!=''){
            $form['product_type'] = strtoupper($form['product_type']);
            $form['request_amount'] = 'Rp ' . number_format($form['request_amount'], 2, ",", ".");
            $form['aging'] = '<b>'.$form['aging']['waktu_aging'].'</b>';
            // if ($form['ref_number']=="TES17121") 
            // { 
            //     $form['list_aging'] = $form['aging']['aging']['x0']['data_action'];
            // }else{
            $form['list_aging'] = '-';
            // }
            // else{
            //     $form['list_aging'] = '-';
            // }
            if(!empty($form['catatan_analis'])){
                $sizeCatatanAnalis = count($form['catatan_analis']);
                $form['catatan_analis'] = $form['catatan_analis'][$sizeCatatanAnalis-1];
            }
            $form['detail'] = $form['catatan_analis'].'<br>'." lihat ";
            $form['catatan_reviewer'] = $form['catatan_reviewer'];
            $form['penilaian_agunan'] = $form['penilaian_agunan'];
            $form['catatan_tolak'] = $form['catatan_tolak'];
            
            $usulan = "";
            if(gettype($form['plafond_usulan'])!='string'){
                $sizePlafond = count($form['plafond_usulan']);
                $usulan = $usulan.'Rp. '.number_format($form['plafond_usulan'][$sizePlafond-1], 2, ",", ".");
            }
            $form['plafond_usulan'] = $usulan;
            $form['status_sekarang'] = $form['status'];

            $form['ao'] = $form['ao_id'].'<br>'.$form['ao_name'];
            //     $disbushr = array();
            //     $y=0;
            //     if(count($form['disbushr']>0)){
            //         foreach ($form['disbushr'] as $key => $value) {
            //             $disbushr = $form['disbushr'][$y];
            //             $y++;
            //     }
            $form['list_disbushr'] = "-";
            // }
                // $form['prescreening_status'] = strtoupper($form['prescreening_status']); //sdhasjd asdjask asdjkas asjkdb k
            $form['ref_click'] = $form['ref_number'].'<br>'.$form['customer']['personal']['name'];
            $form['ref_number'] = '<b>'.strtoupper($form['ref_number']).'</b>';

            $form['customer_name'] = $form['customer']['personal']['name'];
            $form['gender'] = $form['customer']['personal']['gender'];
            $form['phone_mobile'] = $form['customer']['personal']['mobile_phone'];
            $form['email'] = $form['customer']['personal']['email'];
            $form['nik'] = $form['customer']['personal']['nik'];
            $form['status'] = $form['customer']['personal']['status'];

            $form['branch_id'] = $form['branch_id'];
            if ($form['kpr']['developer_name']==null || $form['kpr']['developer_name']=='' ) {
                $form['developer'] = '-';
            }else{
                $form['developer'] = $form['kpr']['developer_name'];
            }
            $form['sales'] = $form['sales_dev_id'];
            $form['kanwils'] = $form['kanwils'];
            if ($form['kpr']['kpr_type_property_name']==null || $form['kpr']['kpr_type_property_name']=='') {
                $form['jenis_kpr'] = '-';
            }else{
                $form['jenis_kpr'] = $form['kpr']['kpr_type_property_name'];
            }
            
            if ($form['sales_dev_id']==null) {
                $form['sales'] = '-';
            }else{
                $form['sales'] = $form['sales_dev_id'];
            }
            
            $ao_recommendation = "";
            $pinca_recommendtaion = "";

            if(!empty($form['recontestdata'])){
                // dd($form['recontestdata']);
                $sizeRecontest = count($form['recontestdata']);
                $form['recomendation'] = '<b>AO Recommendation :</b> '.$form['recontestdata'][$sizeRecontest-1]['ao_recommendation'].' <br> <b>Pinca Recommendation : </b> '.$form['recontestdata'][$sizeRecontest-1]['pinca_recommendation'];
            }else{
                if($form['recommended']==false){$form['recomendation'] = '<b>AO Recomendation :</b> - <br> <b>Pinca Recomendation : </b> -';
                }else if($form['recommended']==true){
                    $form['recomendation'] = $form['recommendation'];
                }else if($form['recomendation']=='yes'){
                    $form['recomendation'] = $form['recommended'];
                }else{

                }
            }

            $form['created_at'] = date_format(date_create($form['created_at']),"Y-m-d");
            $form['prescreening_status'] = view('internals.layouts.actions', [
                'prescreening_result' => $form['prescreening_status'],
            ])->render();

            // $form['branchs'] = '';

            $verify = $form['customer']['is_verified'];
            $visit = $form['is_visited'];
            $status = $form['status'];
        }else{
            $form['branchs'] = '';
            $form['ref_number'] = '';

            $form['nik'] = '';
            $form['customer_name'] = '';
            $form['birth_date'] = '';
            $form['created_at'] = '';
            $form['request_amount'] = '';
            $form['created_at'] = '';
            $form['branch_id'] = '';
            $form['is_screning']='';
            $verify = '';
            $visit = '';
            $status = $form['status'];

            $form['action'] = view('internals.layouts.actions', [
                ])->render();
            }
            $eforms['contents']['data'][$key] = $form;
        }

        $eforms['contents']['draw'] = $request->input('draw');
        $eforms['contents']['recordsTotal'] = $eforms['contents']['total'];
        $eforms['contents']['recordsFiltered'] = $eforms['contents']['total'];

        return response()->json($eforms['contents']);
    }
}
