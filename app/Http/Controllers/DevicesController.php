<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;

class DevicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('device');
    }

    public function list()
    {
        $devices = Device::all();

        return view('home', ['devices' => $devices]);
    }

    public function store()
    {
        $this->validate(request(), [
            'serialNum' => 'required',
            'brandName' => 'required',
            ]);

        $dev = new Device();

        $dev->serialNum = request()->input('serialNum');
        $dev->brandName = request()->input('brandName');
        $dev->model = request()->input('model');
        $dev->purchaseDate = request()->input('purchase');

        $dev->save();

        return redirect('home');
    }

    public function destroy($id)
    {
        $dev = Device::find($id);
        $dev->delete();

        return redirect('home');
    }

    public function show($id)
    {
        $dev = Device::find($id);
        $dev->load('application');

        return response($dev);
    }

    public function edit(Request $request, $id)
    {
        $this->validate(request(), [
                'serialNum' => 'required',
                'brandName' => 'required',
                'model' => 'required',
                'purchaseDev' => 'required',
                ]);

        $dev = Device::find($id);

        $dev->serialNum = request()->input('serialNum');
        $dev->brandName = request()->input('brandName');
        $dev->model = request()->input('model');
        $dev->purchaseDate = request()->input('purchaseDev');

        $dev->save();
    }
}
