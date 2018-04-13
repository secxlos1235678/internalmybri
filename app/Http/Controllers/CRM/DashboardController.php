<?php

namespace App\Http\Controllers\CRM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Client;

class DashboardController extends Controller
{

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
    $crmIndex = Client::setEndpoint('crm')
    ->setHeaders([
      'pn' => $data['pn'],
      'branch' => $data['branch'],
      'Authorization' => $data['token'],
      'Content-Type' => 'application/json'
    ])
    ->get();

    $getPemasar = Client::setEndpoint('crm/pemasar')
    ->setHeaders([
      'pn' => $data['pn'],
      'branch' => $data['branch'],
      'Authorization' => $data['token'],
      'Content-Type' => 'application/json'
    ])
    ->post();

    $marketingByBranch = Client::setEndpoint('crm/marketing/by_branch')
    ->setHeaders([
      'pn' => $data['pn'],
      'branch' => $data['branch'],
      'Authorization' => $data['token'],
      'Content-Type' => 'application/json'
    ])
    ->post();

    $marketing = Client::setEndpoint('crm/marketing')
    ->setHeaders([
      'pn' => $data['pn'],
      'branch' => $data['branch'],
      'Authorization' => $data['token'],
      'Content-Type' => 'application/json'
    ])
    ->get();

    $product = $crmIndex['contents']['product_type'];
    $pemasar = $getPemasar['contents'];
    if (($data['role']=='pincapem') || ($data['role']=='ampd') || ($data['role']=='mp') || ($data['role']=='pinca')) {
      $marketings = $marketingByBranch['contents'];
    } elseif ($data['role'] == 'ao' || $data['role'] == 'fo') {
      $marketings = $marketing['contents'];
    }

    $tableMarketings = Client::setEndpoint('crm/marketing_summary')
    ->setQuery(['role' => $data['role']])
    ->setHeaders([
      'Authorization' => $data['token'],
      'pn' => $data['pn'],
      'branch' => $data['branch']
    ])
    ->setBody([
      "product_type"=>"", //filter pruduk
      "month"=>"",//filter bulan
      "pn"=>"" //filter officer
    ])
    ->post();

    $tableMarketing = $tableMarketings['contents'];

    return view('internals.crm.dashboard.index', compact('data', 'product', 'pemasar', 'marketings', 'tableMarketing'));
  }

  public function chartMarketing(Request $request)
  {
    /* GET UserLogin Data */
    $data = $this->getUser();


    $bulan = $request->input('bulan');
    $pemasar = $request->input('pemasar');
    $product = $request->input('product');

    if (($data['role']=='pincapem') || ($data['role']=='ampd') || ($data['role']=='mp') || ($data['role']=='pinca')) {
      $pn = $pemasar;
    } elseif ($data['role'] == 'ao' || $data['role'] == 'fo') {
      $pn = $data['pn'];
    }

    // return $product;

    $chartData = Client::setEndpoint('crm/marketing_summary')
    ->setQuery(['role' => $data['role']])
    ->setHeaders([
      'Authorization' => $data['token'],
      'pn' => $data['pn'],
      'branch' => $data['branch']
    ])
    ->setBody([
      "product_type"=>$product, //filter pruduk
      "month"=>$bulan,//filter bulan
      "pn"=>$pn //filter officer
    ])
    ->post();
    // $chartData;

    return $chartData['contents'];
  }

  public function chartTotal(Request $request)
  {
    /* GET UserLogin Data */
    $data = $this->getUser();

    $bulan = $request->input('bulan');

    // return $product;

    $chartData = Client::setEndpoint('crm/marketing_summary')
    ->setQuery(['role' => $data['role']])
    ->setHeaders([
      'Authorization' => $data['token'],
      'pn' => $data['pn'],
      'branch' => $data['branch']
    ])
    ->setBody([
      "product_type"=>"", //filter pruduk
      "month"=>$bulan,//filter bulan
      "pn"=>"" //filter officer
    ])
    ->post();

    $totalData = array();

    $totalData[0]['Total'] = array_sum(array_column($chartData['contents'], 'Total'));
    $totalData[0]['Prospek'] = array_sum(array_column($chartData['contents'], 'Prospek'));
    $totalData[0]['On Progress'] = array_sum(array_column($chartData['contents'], 'On Progress'));
    $totalData[0]['Done'] = array_sum(array_column($chartData['contents'], 'Done'));
    $totalData[0]['Index'] = 'All';
    // return array_column($chartData['contents'], 'Total');
    // foreach ($chartData['contents'] as $k=>$subArray) {
    //   unset($subArray['Nama']);
    //   unset($subArray['Pemasar']);
    // }

    return $totalData;
  }

  public function pieChart(Request $request)
  {
    /* GET UserLogin Data */
    $data = $this->getUser();

    // return $product;

    $chartData = Client::setEndpoint('crm/marketing_summary_v2')
    ->setQuery(['role' => $data['role']])
    ->setHeaders([
      'Authorization' => $data['token'],
      'pn' => $data['pn'],
      'branch' => $data['branch']
    ])
    ->setBody([
      "product_type"=>"", //filter pruduk
      "month"=>"",//filter bulan
      "pn"=>"" //filter officer
    ])
    ->post();

    // return $chartData;
    $totalData = array();

    $totalData[0]['Total'] = array_sum(array_column($chartData['contents'], 'Total'));
    $totalData[0]['Prospek'] = array_sum(array_column($chartData['contents'], 'Prospek'));
    $totalData[0]['On Progress'] = array_sum(array_column($chartData['contents'], 'On Progress'));
    $totalData[0]['Done'] = array_sum(array_column($chartData['contents'], 'Done'));
    $totalData[0]['Index'] = 'All';
    // return array_column($chartData['contents'], 'Total');
    // foreach ($chartData['contents'] as $k=>$subArray) {
    //   unset($subArray['Nama']);
    //   unset($subArray['Pemasar']);
    // }

    return $totalData;
  }

  public function detailMarketing(Request $request)
  {
    /* GET UserLogin Data */
    $data = $this->getUser();
    // return $request->pn;
    $marketings = Client::setEndpoint('crm/marketing/by_branch')
    ->setHeaders([
      'pn' => $data['pn'],
      'branch' => $data['branch'],
      'Authorization' => $data['token'],
      'Content-Type' => 'application/json'
    ])
    ->post();
    $marketing = $marketings['contents'];
    $mark = array_filter($marketing, function ($var) use($request){
      return ($var['status'] == substr("00000000".$request->pn, -8));
    });

    return $mark;
    $data = [
      'marketings' => $marketing
    ];
    // $kanca = $listKanca['contents']['responseData'];
    return $data;
  }

}
