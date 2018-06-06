<?php

namespace App\Http\Controllers\EForm;

use App\Http\Controllers\Controller;
use App\Http\Requests\EForm\LKNRequest;
use Carbon\Carbon;
use Client;
use Illuminate\Http\Request;

class AOController extends Controller
{

    protected $columns = [
        'ref_number',
        'customer_name',
        'request_amount',
        'created_at',
        'mobile_phone',
        'prescreening_status',
        'status',
        'created_at',
        'action',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->getUser();

        return view('internals.eform.index-ao', compact('data'));
    }

    public function getUser()
    {
        /* GET UserLogin Data */
        $users = session()->get('user');
        foreach ($users as $user) {
            $data = $user;
        }
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLKN($id)
    {
        $data = $this->getUser();

        $eforms = Client::setEndpoint('eforms/' . $id)
            ->setHeaders([
                'Authorization' => $data['token']
                , 'pn' => $data['pn'],
            ])->get();
        $eformData = $eforms['contents'];

        $client = new \GuzzleHttp\Client();
        try {
            $res = $client->request('GET', 'http://freegeoip.net/json/');

            $getIP = json_decode('[' . $res->getBody()->getContents() . ']')[0];
            $eformData['longitude'] = $getIP->longitude;
            $eformData['latitude'] = $getIP->latitude;

        } catch (\Exception $e) {
        }

        $recontest = 1;

        return view('internals.eform.lkn.index', compact('data', 'id', 'eformData', 'recontest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLKN(Request $request, $id)
    {
        $data = $this->getUser();
        $newForm = $this->lknRequest($request);

        $client = Client::setEndpoint('eforms/' . $id . '/visit-reports')
            ->setHeaders([
                'Authorization' => $data['token']
                , 'pn' => $data['pn']
                , 'auditaction' => 'Simpan Form LKN'
                , 'long' => $request['hidden-long']
                , 'lat' => $request['hidden-lat'],
            ])
            ->setBody($newForm)
            ->post('multipart');

        if ($client['code'] == 201) {
            \Session::flash('success', $client['descriptions']);
            return redirect()->route('eform.index');
        } else {
            $error = reset($client['contents']);
            \Session::flash('error', $client['descriptions'] . ' ' . $error);
            return redirect()->back()->withInput($request->input());
        }

        return view('internals.eform.lkn', compact('data'));
    }

    public function renderMutation(Request $request)
    {

        $view = (String) view('internals.eform.lkn._render-mutation')
            ->render();
        return response()->json(['view' => $view]);
    }

    /**
     * Reformat image request
     *
     * @param  \Illuminate\Http\Request  $image
     * @param  String  $name
     */
    public function reformatImage($name, $image)
    {
        return [
            'name' => $name
            , 'contents' => fopen($image->getRealPath(), 'r')
            , 'filename' => $image->getClientOriginalName()
            , 'Mime-Type' => $image->getmimeType(),
        ];
    }

    /**
     * Reformat content request
     *
     * @param  \Illuminate\Http\Request  $value
     * @param  String  $name
     */
    public function reformatContent($name, $value)
    {
        return [
            'name' => $name
            , 'contents' => $value,
        ];
    }

    /**
     * Get return content
     *
     * @param  \Illuminate\Http\Request  $value
     * @param  String  $name
     */
    public function returnContent($field, $values, $baseName)
    {
        $excludeNumber = ['amount', 'npwp_number', 'income', 'income_salary', 'income_allowance', 'number', 'couple_salary', 'couple_other_salary', 'salary', 'other_salary'];
        $excludeImage = ['file', 'npwp', 'salary_slip', 'family_card', 'marrital_certificate', 'divorce_certificate', 'photo_with_customer', 'offering_letter', 'proprietary', 'building_permit', 'down_payment', 'building_tax', 'legal_bussiness_document', 'work_letter', 'license_of_practice', 'other_document'];

        if (in_array($baseName, $excludeNumber)) {
            $values = str_replace(',', '', $values);
        }

        if (in_array($baseName, $excludeImage)) {
            if ($values != "") {
                $return = $this->reformatImage($field, $values);
            } else {
                $return = null;
            }
        } else {
            $return = $this->reformatContent($field, $values);
        }

        return $return;
    }

    /**
     * List of request needed for input to customer
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function lknRequest($request)
    {
        $application = [];
        foreach ($request->except('status_property') as $field => $values) {
            if ($field == 'mutations') {
                foreach ($values as $mutationIndex => $mutations) {
                    foreach ($mutations as $key => $value) {
                        $baseName = $field . '[' . $mutationIndex . '][' . $key . ']';
                        if ($key == 'tables') {
                            foreach ($value as $tablesIndex => $tables) {
                                foreach ($tables as $tableKey => $data) {
                                    $name = $baseName . '[' . $tablesIndex . '][' . $tableKey . ']';

                                    $return = $this->returnContent($name, $data, $tableKey);
                                    if ($return != null) {
                                        $application[] = $this->returnContent($name, $data, $tableKey);
                                    }
                                }
                            }
                        } else {
                            $return = $this->returnContent($baseName, $value, $key);
                            if ($return != null) {
                                $application[] = $this->returnContent($baseName, $value, $key);
                            }
                        }
                    }
                }

            } else {
                $return = $this->returnContent($field, $values, $field);
                if ($return != null) {
                    $application[] = $this->returnContent($field, $values, $field);
                }
            }
        }
        return $application;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getVerification($id)
    {
        $data = $this->getUser();
        /* GET Role Data */
        $customerData = Client::setEndpoint('eforms/' . $id . '/verification/show')
            ->setQuery(['limit' => 100])
            ->setHeaders([
                'Authorization' => $data['token']
                , 'pn' => $data['pn'],
            ])
            ->post();

        $dataCustomer = $customerData['contents'];

        if (count($dataCustomer) == 0) {
            \Session::flash('danger', 'Data verification tidak ditemukan!');
            return redirect()->route('eform.index');
        }

        $type = 'fill';

        return view('internals.eform.verification.index', compact('data', 'id', 'dataCustomer', 'type'));
    }

    /**
     * Search NIK depedencies.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchNik(Request $request)
    {
        $data = $this->getUser();

        $response = Client::setEndpoint('verification/search-nik')
            ->setHeaders([
                'Authorization' => $data['token']
                , 'pn' => $data['pn']
                , 'long' => number_format($request->get('long', env('DEF_LONG', '106.81350')), 5)
                , 'lat' => number_format($request->get('lat', env('DEF_LAT', '-6.21670')), 5),
            ])
            ->setBody([
                'nik' => $request->input('new_nik'),
            ])
            ->post();

        $data = $response['contents'];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function completeData($eform_id, $customer_id)
    {
        $data = $this->getUser();

        /* GET Role Data */
        $customerData = Client::setEndpoint('customer/' . $customer_id)
            ->setQuery(['limit' => 100])
            ->setHeaders([
                'Authorization' => $data['token']
                , 'pn' => $data['pn'],
            ])
            ->get();

        $dataCustomer = $customerData['contents'];

        return view('internals.eform.complete', compact('data', 'eform_id', 'dataCustomer', 'customer_id'));
    }

    // uses regex that accepts any word character or hyphen in last name
    public function split_name($request)
    {
        $name = trim($request->full_name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim(preg_replace('#' . $last_name . '#', '', $name));
        return array($first_name, $last_name);
    }

    /**
     * List of request needed for input to customer
     *
     * @param  \Illuminate\Http\Request  $requestImage
     * @param  String $attribute
     */
    public function parseImage($requestImage, $attribute)
    {
        if (isset($requestImage)) {
            $image[] = [
                'name' => $attribute,
                'filename' => $requestImage->getClientOriginalName(),
                'Mime-Type' => $requestImage->getmimeType(),
                'contents' => fopen($requestImage->getPathname(), 'r'),
            ];
            return $image;
        };

        return [];
    }

    /**
     * List of request needed for input to customer
     *
     * @param  \Illuminate\Http\Request  $requestNumber
     * @param  String $attribute
     */
    public function parseNumber($requestNumber, $attribute)
    {
        if (isset($requestNumber)) {
            $number[] = [
                'name' => $attribute,
                'contents' => str_replace(',', '', $requestNumber),
            ];
            return $number;
        };

        return [];
    }

    /**
     * List of request needed for input to customer
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function dataRequest($request)
    {
        $first_name = $this->split_name($request)['0'];
        $last_name = $this->split_name($request)['1'];

        $verifyStatus[] = [
            'name' => 'verify_status',
            'contents' => 'verify',
        ];

        $name = array(
            [
                'name' => 'first_name',
                'contents' => $first_name,
            ],
            [
                'name' => 'last_name',
                'contents' => $last_name,
            ],
        );

        $allReq = $request->except(['full_name', '_token', 'salary', 'other_salary', 'loan_installment', 'couple_other_salary', 'couple_salary', 'couple_loan_installment', 'identity', 'couple_identity', 'price', 'request_amount', 'hidden-long', 'hidden-lat']);
        foreach ($allReq as $index => $req) {
            $inputData[] = [
                'name' => $index,
                'contents' => $req,
            ];
        }

        return array_merge(
            $inputData
            , $name
            , $verifyStatus
            , $this->parseImage($request->identity, 'identity')
            , $this->parseImage($request->couple_identity, 'couple_identity')
            , $this->parseNumber($request->salary, 'salary')
            , $this->parseNumber($request->other_salary, 'other_salary')
            , $this->parseNumber($request->loan_installment, 'loan_installment')
            , $this->parseNumber($request->couple_salary, 'couple_salary')
            , $this->parseNumber($request->couple_other_salary, 'couple_other_salary')
            , $this->parseNumber($request->couple_loan_installment, 'couple_loan_installment')
            , $this->parseNumber($request->price, 'price')
            , $this->parseNumber($request->request_amount, 'request_amount')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifyData(Request $request, $customer_id)
    {
        $data = $this->getUser();

        $newData = $this->dataRequest($request);

        $client = Client::setEndpoint('customers/' . $customer_id . '/verify')
            ->setHeaders([
                'Authorization' => $data['token']
                , 'pn' => $data['pn']
                , 'auditaction' => 'Verifikasi Data Nasabah'
                , 'long' => $request['hidden-long']
                , 'lat' => $request['hidden-lat'],
            ])
            ->setBody($newData)
            ->put('multipart');

        if ($client['code'] == 200) {
            \Session::flash('success', $client['descriptions']);
            return redirect()->route('eform.index');
        } else {
            $error = reset($client['contents']);
            \Session::flash('error', $client['descriptions'] . ' ' . $error);
            return redirect()->back()->withInput($request->input());
        }
    }

    //datatable
    public function datatables(Request $request)
    {
        $sort = $request->input('order.0');
        $data = $this->getUser();
        $eforms = Client::setEndpoint('eforms')
            ->setHeaders([
                'Authorization' => $data['token']
                , 'pn' => $data['pn']
                , 'long' => number_format($request->get('long', env('DEF_LONG', '106.81350')), 5)
                , 'lat' => number_format($request->get('lat', env('DEF_LAT', '-6.21670')), 5),
            ])
            ->setQuery([
                'limit' => $request->input('length'),
                'sort' => $this->columns[$sort['column']] . '|' . $sort['dir'],
                'search' => $request->input('search.value'),
                'page' => (int) $request->input('page') + 1,
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'status' => $request->input('status'),
                'ref_number' => $request->input('ref_number'),
                'customer_name' => $request->input('customer_name'),
                'branch_id' => $data['branch'],
                'prescreening' => $request->input('prescreening'),
                'product' => $request->input('product'),
            ])->get();
            // \Log::info($eforms['contents']['data'][0]['status']);
        foreach ($eforms['contents']['data'] as $key => $form) {
            $form['ref_number'] = strtoupper($form['ref_number']);
            $form['customer_name'] = strtoupper($form['customer_name']);
            $form['created_at'] = date_format(date_create($form['created_at']), "Y-m-d");
            $form['request_amount'] = 'Rp ' . number_format($form['nominal'], 2, ",", ".");
            $form['created_at'] = $form['created_at'];

            $verify = $form['response_status'] == 'approve' ? true : false;
            $visit = $form['is_visited'];
            $status = $form['response_status'];

            $form['prescreening_status'] = view('internals.layouts.actions', [
                'prescreening_result' => $form['prescreening_status'],
            ])->render();

            $recontest = [];
            if (!empty($form['recontest'])) {
                $now = Carbon::now();
                $end = Carbon::parse($form['recontest']['expired_date']);

                if ($now->diffInDays($end) <= 30 && $form['status_eform'] != 'Approval2' && !isset($form['recontest']['ao_recommended'])) {
                    $recontest = route('getRecontest', $form['id']);
                }

            }

            $form['action'] = view('internals.layouts.actions', [
                'verified' => $verify,
                'visited' => $visit,
                'response_status' => $status,
                'verification' => route('getVerification', $form['id']),
                'approval' => $form['is_approved'],
                'eform_id' => $form['id'],
                'preview' => route('getDetail', $form['id']),
                'lkn' => route('getLKN', $form['id']),
                'recontest' => $recontest,
                'reverification' => route('resend_verifyData', $form['id']),
                'screening_result' => route('getPrescreening', $form['id']),
                'is_verified' => $form['customer']['is_verified'],
                'is_screening' => $form['is_screening'],
                'delay_prescreening' => $form['delay_prescreening'],
                'vip_sent' => $form['vip_sent'],
                'use_reason_name' => $form['visit_report']['use_reason_name'],
                'vip' => route('resendVIP', $form['id']),
                'status_efrm' => $form['status'],
                'refnumber' => $form['ref_number'], 
                'delete_efrm' => route('delete_eform')
            ])->render();
            $eforms['contents']['data'][$key] = $form;
        }

        $eforms['contents']['draw'] = $request->input('draw');
        $eforms['contents']['recordsTotal'] = $eforms['contents']['total'];
        $eforms['contents']['recordsFiltered'] = $eforms['contents']['total'];

        return response()->json($eforms['contents']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPreview($id)
    {
        $data = $this->getUser();
        /* GET Role Data */
        $customerData = Client::setEndpoint('eforms/' . $id . '/verification/show')
            ->setQuery(['limit' => 100])
            ->setHeaders([
                'Authorization' => $data['token']
                , 'pn' => $data['pn'],
            ])
            ->post();

        $dataCustomer = $customerData['contents'];

        if (count($dataCustomer) == 0) {
            \Session::flash('danger', 'Data verification tidak ditemukan!');
            return redirect()->route('eform.index');
        }

        $type = 'preview';

        return view('internals.eform.verification.index', compact('data', 'id', 'dataCustomer', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPrint($id)
    {
        $data = $this->getUser();
        /* GET Role Data */
        $customerData = Client::setEndpoint('eforms/' . $id . '/verification/show')
            ->setQuery(['limit' => 100])
            ->setHeaders([
                'Authorization' => $data['token']
                , 'pn' => $data['pn'],
            ])
            ->post();

        $dataCustomer = $customerData['contents'];
        if (($customerData['code']) == 200) {
            $view = (String) view('internals.eform.verification._print-verification')
                ->with('dataCustomer', $dataCustomer)
                ->render();

            return response()->json(['view' => $view]);
        }

    }

    /*
     * This function for resend verification to nasabah
     *
     */

    public function resendVerification($eform_id)
    {
        $data = $this->getUser();
        $resend_verification = Client::setEndpoint('eforms/' . $eform_id . '/verification/resend')
            ->setHeaders([
                'Authorization' => $data['token']
                , 'pn' => $data['pn'],

            ])->get();

        if ($resend_verification['code'] == 200) {
            \Session::flash('success', $resend_verification['descriptions']);
            return redirect()->route('eform.index');
        }
        \Session::flash('error', $resend_verification['descriptions']);
        return redirect()->route('eform.index');

    }

    /**
     * Get prescreening data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getPrescreening(Request $request, $id)
    {
        $data = $this->getUser();

        $client = Client::setEndpoint('prescreening')
            ->setHeaders([
                'Authorization' => $data['token']
                , 'pn' => $data['pn']
                , 'auditaction' => 'Generate Prescreening'
                , 'long' => number_format($request->get('long', env('DEF_LONG', '106.81350')), 5)
                , 'lat' => number_format($request->get('lat', env('DEF_LAT', '-6.21670')), 5),
            ])
            ->setBody([
                'eform' => $id,
            ])
            ->post();

        $eform = $client['contents']['eform'];

        return view('internals.eform.prescreening.index', compact('data', 'eform', 'id'));
    }

    /**
     * Post prescreening data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPrescreening(Request $request, $eform)
    {
        $data = $this->getUser();

        $client = Client::setEndpoint('prescreening/' . $eform)
            ->setHeaders([
                'Authorization' => $data['token']
                , 'pn' => $data['pn']
                , 'auditaction' => 'Submit Prescreening'
                , 'long' => number_format($request->get('long', env('DEF_LONG', '106.81350')), 5)
                , 'lat' => number_format($request->get('lat', env('DEF_LAT', '-6.21670')), 5),
            ])
            ->setBody($request->all())
            ->put();

        if ($client['code'] == 200) {
            \Session::flash('success', $client['descriptions']);
            return redirect()->route('eform.index');
        }
    }

    /**
     * Resend VIP function
     *
     * @param  \App\Http\Requests\API\v1\VisitReportRequest  $request
     * @param integer $eform
     * @return \Illuminate\Http\Response
     **/
    public function resendVIP(Request $request, $eform)
    {
        $data = $this->getUser();

        $client = Client::setEndpoint('eforms/' . $eform . '/resend-vip')
            ->setHeaders([
                'Authorization' => $data['token']
                , 'pn' => $data['pn']
                , 'auditaction' => 'Resend LKN VIP'
                , 'long' => number_format($request->get('long', env('DEF_LONG', '106.81350')), 5)
                , 'lat' => number_format($request->get('lat', env('DEF_LAT', '-6.21670')), 5),
            ])
            ->post();

        \Session::flash(
            $client['code'] == 200 ? 'success' : 'error'
            , $client['descriptions']
        );
        return redirect()->route('eform.index');
    }

}
