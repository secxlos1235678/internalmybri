<?php

namespace App\Http\Controllers\AuditRail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Client;

class ActionDetailController extends Controller
{
    public function getUser()
	{
		/* GET UserLogin Data */
		$users = session()->get('user');

		foreach ($users as $user) {
			$data = $user;
		}

		return $data;
	}

	// Pengajuan Kredit
    public function pengajuan_kredit(Request $request)
    {
        $data = $this->getUser();

        $pengajuan_kredit = Client::setEndpoint('auditrail/pengajuan_kredit')
        	->setHeaders([
	        	'Authorization' => $data['token']
	        	, 'pn' => $data['pn']
                // , 'auditaction' => 'action name'
                , 'long' => number_format($request->get('long', env('DEF_LONG', '106.81350')), 5)
                , 'lat' => number_format($request->get('lat', env('DEF_LAT', '-6.21670')), 5)
        	])
            ->setQuery([
                'search' => $request->input('name'),
                'page'   => $request->input('page')
            ])
            ->get();
            // dd($pengajuan_kredit);
        $contents = array();
        if (count($pengajuan_kredit['contents'])>0) {
            foreach ($pengajuan_kredit['contents']['data'] as $key => $detail) {
                $detail['text'] = $detail['modul_name'];
                $detail['id'] = $detail['modul_name'];
                $pengajuan_kredit['contents']['data'][$key] = $detail;
            }
            $contents = $pengajuan_kredit['contents'];
        }

        return response()->json(['pengajuan_kredit' => $contents ]);
    }

    // Admin Dev
    public function admindev(Request $request)
    {
        $data = $this->getUser();

        $admindev = Client::setEndpoint('auditrail/admindev')
        	->setHeaders([
	        	'Authorization' => $data['token']
	        	, 'pn' => $data['pn']
                // , 'auditaction' => 'action name'
                , 'long' => number_format($request->get('long', env('DEF_LONG', '106.81350')), 5)
                , 'lat' => number_format($request->get('lat', env('DEF_LAT', '-6.21670')), 5)
        	])
            ->setQuery([
                'search' => $request->input('name'),
                'page'   => $request->input('page')
            ])
            ->get();
            // dd($admindev);
        $contents = array();
        if (count($admindev['contents'])>0) {
            foreach ($admindev['contents']['data'] as $key => $detail) {
                $detail['text'] = $detail['modul_name'];
                $detail['id'] = $detail['modul_name'];
                $admindev['contents']['data'][$key] = $detail;
            }
            $contents = $admindev['contents'];
        }

        return response()->json(['admindev' => $contents ]);
    }

    // Schedule
    public function appointment(Request $request)
    {
        $data = $this->getUser();

        $appointment = Client::setEndpoint('auditrail/appointment')
        	->setHeaders([
	        	'Authorization' => $data['token']
	        	, 'pn' => $data['pn']
                // , 'auditaction' => 'action name'
                , 'long' => number_format($request->get('long', env('DEF_LONG', '106.81350')), 5)
                , 'lat' => number_format($request->get('lat', env('DEF_LAT', '-6.21670')), 5)
        	])
            ->setQuery([
                'search' => $request->input('name'),
                'page'   => $request->input('page')
            ])
            ->get();
            // dd($appointment);
        $contents = array();
        if (count($appointment['contents'])>0) {
            foreach ($appointment['contents']['data'] as $key => $detail) {
                $detail['text'] = $detail['modul_name'];
                $detail['id'] = $detail['modul_name'];
                $appointment['contents']['data'][$key] = $detail;
            }
            $contents = $appointment['contents'];
        }

        return response()->json(['appointment' => $contents ]);
    }

    // Collateral
    public function collateral(Request $request)
    {
        $data = $this->getUser();

        $collateral = Client::setEndpoint('auditrail/collateral')
        	->setHeaders([
	        	'Authorization' => $data['token']
	        	, 'pn' => $data['pn']
                // , 'auditaction' => 'action name'
                , 'long' => number_format($request->get('long', env('DEF_LONG', '106.81350')), 5)
                , 'lat' => number_format($request->get('lat', env('DEF_LAT', '-6.21670')), 5)
        	])
            ->setQuery([
                'search' => $request->input('name'),
                'page'   => $request->input('page')
            ])
            ->get();
            // dd($collateral);
        $contents = array();
        if (count($collateral['contents'])>0) {
            foreach ($collateral['contents']['data'] as $key => $detail) {
                $detail['text'] = $detail['modul_name'];
                $detail['id'] = $detail['modul_name'];
                $collateral['contents']['data'][$key] = $detail;
            }
            $contents = $collateral['contents'];
        }

        return response()->json(['collateral' => $contents ]);
    }

    // Agen Dev
    public function agendev(Request $request)
    {
        $data = $this->getUser();

        $agendev = Client::setEndpoint('auditrail/agendev')
        	->setHeaders([
	        	'Authorization' => $data['token']
	        	, 'pn' => $data['pn']
                // , 'auditaction' => 'action name'
                , 'long' => number_format($request->get('long', env('DEF_LONG', '106.81350')), 5)
                , 'lat' => number_format($request->get('lat', env('DEF_LAT', '-6.21670')), 5)
        	])
            ->setQuery([
                'search' => $request->input('name'),
                'page'   => $request->input('page')
            ])
            ->get();
            // dd($agendev);
        $contents = array();
        if (count($agendev['contents'])>0) {
            foreach ($agendev['contents']['data'] as $key => $detail) {
                $detail['text'] = $detail['modul_name'];
                $detail['id'] = $detail['modul_name'];
                $agendev['contents']['data'][$key] = $detail;
            }
            $contents = $agendev['contents'];
        }

        return response()->json(['agendev' => $contents ]);
    }

    // Property
    public function property(Request $request)
    {
        $data = $this->getUser();

        $property = Client::setEndpoint('auditrail/property')
        	->setHeaders([
	        	'Authorization' => $data['token']
	        	, 'pn' => $data['pn']
                // , 'auditaction' => 'action name'
                , 'long' => number_format($request->get('long', env('DEF_LONG', '106.81350')), 5)
                , 'lat' => number_format($request->get('lat', env('DEF_LAT', '-6.21670')), 5)
        	])
            ->setQuery([
                'search' => $request->input('name'),
                'page'   => $request->input('page')
            ])
            ->get();
            // dd($property);
        $contents = array();
        if (count($property['contents'])>0) {
            foreach ($property['contents']['data'] as $key => $detail) {
                $detail['text'] = $detail['modul_name'];
                $detail['id'] = $detail['modul_name'];
                $property['contents']['data'][$key] = $detail;
            }
            $contents = $property['contents'];
        }

        return response()->json(['property' => $contents ]);
    }

    // Property
    public function document(Request $request)
    {
        $data = $this->getUser();

        $document = Client::setEndpoint('auditrail/getnik')
        	->setHeaders([
	        	'Authorization' => $data['token']
	        	, 'pn' => $data['pn']
                // , 'auditaction' => 'action name'
                , 'long' => number_format($request->get('long', env('DEF_LONG', '106.81350')), 5)
                , 'lat' => number_format($request->get('lat', env('DEF_LAT', '-6.21670')), 5)
        	])
            ->setQuery([
                'search' => $request->input('name'),
                'page'   => $request->input('page')
            ])
            ->get();
            // dd($document);
        $contents = array();
        if (count($document['contents'])>0) {
            foreach ($document['contents']['data'] as $key => $detail) {
                $detail['text'] = $detail['nik'].' - '.$detail['nama_pemohon'];
                $detail['id'] = $detail['nik'];
                $document['contents']['data'][$key] = $detail;
            }
            $contents = $document['contents'];
        }

        return response()->json(['document' => $contents ]);
    }
}
