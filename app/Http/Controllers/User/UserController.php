<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Client;

class UserController extends Controller
{
    protected $columns = [
        'nip',
        'fullname',
        'email',
        'office_name',
        'mobile_phone',
        'role_name',
        'is_actived',
        'action',
    ];

    public function getUser(){
     /* GET UserLogin Data */
        $users = session()->get('user');
            foreach ($users as $user) {
                $data = $user;
            }
        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->getUser();
        return view('internals.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->getUser();

        return view('internals.users.create', compact('data'));
    }

    // uses regex that accepts any word character or hyphen in last name
    function split_name($request) {
        $name = trim($request->full_name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
        return array($first_name, $last_name);
    }

    /**
     * List of request needed for input to customer
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function userRequest($request)
    {
        $first_name = $this->split_name($request)['0'];
        $last_name = $this->split_name($request)['1'];
        $image_path = $request->images->getPathname();
        $image_mime = $request->images->getmimeType();
        $image_name = $request->images->getClientOriginalName();

        //get Requests
        $req = [
                'first_name'    => $first_name,
                'last_name'     => $last_name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'mobile_phone'  => $request->mobile_phone,
                'gender'        => $request->gender,
                'office_id'     => $request->office_id,
                'nip'           => $request->nip,
                'position'      => $request->position,
                'role_id'       => $request->role_id,
               ];

        $newUser = array(
                [
                  'name'     => 'data',
                  'contents' => json_encode($req),
                ],
                [
                  'name'     => 'image',
                  'filename' => $image_name,
                  'Mime-Type'=> $image_mime,
                  'contents' => fopen( $image_path, 'r' ),
                ]
              );

        return $newUser;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->getUser();

        $newUser = $this->userRequest($request);

        $client = Client::setEndpoint('user')
           ->setHeaders(['Authorization' => $data['token']])
           ->setBody($newUser)
           ->post('multipart');
        
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->getUser();

         /* GET User Data */
        $userData = Client::setEndpoint('customer/'.$id)->setQuery(['limit' => 100])->setHeaders(['Authorization' => $data['token']])->get();
        
        $dataUser = $userData['data'];

        return view('internals.users.detail', compact('data', 'dataUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->getUser();

         /* GET User Data */
        $userData = Client::setEndpoint('customer/'.$id)->setQuery(['limit' => 100])->setHeaders(['Authorization' => $data['token']])->get();
        
        $dataUser = $userData['data'];

        return view('internals.users.edit', compact('data', 'dataUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->getUser();

        $newUser = $this->userRequest($request);

        $client = Client::setEndpoint('user/'.$id)
           ->setHeaders(['Authorization' => $data['token']])
           ->setBody($newUser)
           ->put();

       dd($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function actived(Request $request, $id)
    {

        $users = Client::setEndpoint("user/{$id}/actived")
                ->setHeaders(['Authorization' => session('user.data.token')])
                ->setBody(['is_actived' => filter_var($request->input('is_actived'), FILTER_VALIDATE_BOOLEAN)])
                ->put();

        return response()->json($users['status']['message']);
    }

    public function datatables(Request $request)
    {
        $sort = $request->input('order.0');
        $user = session('user.data');
        $users = Client::setEndpoint('user')
                ->setHeaders(['Authorization' => $user['token']])
                ->setQuery([
                    'limit'     => $request->input('length'),
                    'search'    => $request->input('search.value'),
                    'sort'      => $this->columns[$sort['column']] .'|'. $sort['dir'],
                    'office_id' => $request->input('office_id')
                ])->get();

        foreach ($users['users']['data'] as $key => $user) {
            $user['role_slug'] = strtoupper($user['role_slug']);
            $user['action'] = view('internals.layouts.actions', [
                'edit' => route('users.edit', $user['id']),
                'show' => route('users.show', $user['id']),
            ])->render();
            $users['users']['data'][$key] = $user;
        }

        $users['users']['draw'] = $request->input('draw');
        $users['users']['recordsTotal'] = $users['users']['total'];
        $users['users']['recordsFiltered'] = $users['users']['to'];

        return response()->json($users['users']);
    }
}
