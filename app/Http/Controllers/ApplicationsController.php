<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Validator;
use File;
use App\Application;
use App\Device;
use App\User;

class ApplicationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('application')
        ->with('Device', Device::all());
    }

    // public function store()
    // {
    //     $this->validate(request(), [
    //         'name' => 'required',
    //         'description' => 'required',
    //         ]);

    //     $app = new Application();

    //     $app->name = request()->input('name');
    //     $app->description = request()->input('description');
    //     $app->startDate = request()->input('startD');

    //     $app->save();
    //     $app->device()->attach(request()->input('appDevice'));
    //     $app->user()->attach(request()->input('appUser'));
    // }


    public function store(Request $request)
    {

        $validation = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
        ]);
      
        if($validation->passes())
        {
        
            $app = new Application();

            $app->name = $request->input('name');
            $app->description = $request->input('description');
            $app->startDate = $request->input('startD');
            $new_name = null;

            if($request->file('document')){
            $file = $request->file('document');
            $new_name = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('files'), $new_name);
            }
            $app->document = $new_name;
            

            $app->save();
            $app->device()->attach($request->input('appDevice'));
            $app->user()->attach($request->input('appUser'));

            return response()->json([
                
                                    'message' => 'Application Added Successfully'
                                ]);
        }
        else {

            return response()->json([

                    'message' => $validation->errors()->all(),

                ]);
        }
    }

    public function destroy($id)
    {
        $app = Application::find($id);
        $app->device()->detach(Device::all());
        $app->user()->detach(User::all());
        $app->delete();

        Session::put('key', $id);

        return redirect('home');
    }

    public function show($id)
    {
        $app = Application::find($id);
        $app->load('device');
        $app->load('user');

        return response($app);
    }

    // public function edit(Request $request, $id)
    // {
    //     // $this->validate(request(), [
    //     //     'name' => 'required',
    //     //     'description' => 'required',
    //     //     ]);

    //     $app = Application::find($id);
    //     $app->device()->detach(Device::all());
    //     $app->user()->detach(User::all());

    //     $app->name = request()->input('name');
    //     $app->description = request()->input('description');
    //     $app->startDate = request()->input('startDate');

    //     $app->device()->attach(request()->input('appDevice'));
    //     $app->user()->attach(request()->input('appUser'));

    //     $app->save();
    // }

    public function edit(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'nameEdit' => 'required',
            'descriptionEdit' => 'required',
        ]);
      
        if($validation->passes())
        {

            $app = Application::find($id);
            $app->device()->detach(Device::all());
            $app->user()->detach(User::all());

            $app->name = $request->input('nameEdit');
            $app->description = $request->input('descriptionEdit');
            $app->startDate = $request->input('startDate');
            $new_name = $request->input('appLinkEdit1');

            if ($request->file('documentEdit'))
            {

                $path = public_path("files/" . $request->input('appLinkEdit1'));
                  if (File::exists($path)) {
                      
                    File::delete($path);
                }
                    $file = $request->file('documentEdit');
                     $new_name = rand() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('files'), $new_name);
                 
            }

            $app->document = $new_name;
                

            $app->device()->attach($request->input('appDevice'));
            $app->user()->attach($request->input('appUser'));
            $app->save();

            return response()->json([
                
                                    'message' => 'Application Updated Successfully'
                                ]);
        }

        else {
            return response()->json([
            
                'message' => $validation->errors()->all(),
            ]);
        }

    }
}
