@extends('layouts.app') @section('content')

<div class="container-fluid">

    <div class="loading">
        <div class="gif">
            <img src="25.gif" alt="">
        </div>
    </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home"
                aria-selected="true">
                <h5>Applications</h5>
            </a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"
                aria-selected="false">
                <h5>Devices</h5>
            </a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact"
                aria-selected="false">
                <h5>Users</h5>
            </a>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">


            <!-- Applications -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card" style="height:580px; ">
                        <div class="card-body overflow-auto">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <div class="table table-responsive">
                                <table id="appTable" class="table table-hover table-dark" style="width:100%">
                                    <thead>

                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Start Date</th>
                                            <td style="display:none;"></td>
                                            <td style="display:none;"></td>

                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    @foreach($Application as $row1 )
                                    <tr class="viewApp btn-dark" id="{{$row1['id']}}">
                                        <td>{{$row1['id']}}</td>
                                        <td>{{$row1['name']}}</td>
                                        <td style="max-width:250px">{{$row1['description']}}</td>
                                        <td style="display:none;">{{$row1['device']}}</td>
                                        <td style="display:none;">{{$row1['document']}}</td>
                                        <td>{{$row1['startDate']}}</td>
                                        <td>
                                            <!-- Button edit app trigger modal -->

                                            <button type="button" class="btn btn-success editbtn">
                                                Edit
                                            </button>

                                            <!-- Button delete app trigger modal -->

                                            <button type="button" id="{{$row1['id']}}" class="deleter btn btn-danger" data-toggle="modal" data-target="#staticBackdrop1">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                        <div class="card-header d-flex justify-content-between ">

                            <h3></h3>
                            <!-- Add a New Application Button trigger modal -->

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop2">
                                Add a New Application
                            </button>
                        </div>


                    </div>
                </div>
                <!-- Add a new Application Modal -->
                {{--start Modal --}}
                <div class="modal fade" id="staticBackdrop2" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-blue">
                                <h5 class="modal-title white" id="staticBackdropLabel1">Add a New Application</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="addAppForm">
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" required name="name" minlength="5" placeholder="Enter name of the application"> @error('fName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" required name="description" minlength="8" placeholder=" Enter description">
                                    </div>
                                    <div class="form-group">
                                        <label>Device Used</label>

                                        <div class="row d-flex justify-content-left ">
                                            <div class="col-md-12">

                                                <select class="applicationDevice form-control" id="device" name="appDevice[]" style="width:100%" multiple="multiple">
                                                    @foreach($Device as $row)
                                                    <option value="{{$row['id']}}">{{$row['brandName']}} {{$row['model']}}</option>
                                                    @endforeach
                                                </select>



                                            </div>
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label>Users</label>

                                        <div class="row d-flex justify-content-left ">
                                            <div class="col-md-12">
                                                <select class="applicationUser form-control" name="appUser[]" style="width:100%" multiple="multiple">
                                                    @foreach($User as $row)
                                                    <option value="{{$row['id']}}">{{$row['fName']}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                    </div>


                                    <div style="width:250px;" class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" class="form-control startD" name="startD">
                                    </div>

                                    <div style="width:250px;" class="form-group">
                                        <label>Documents</label>
                                        <input type="file" id="fileInput" accept=".docx,.pdf " class="form-control" name="document">
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>


                        </div>
                    </div>

                </div>
                {{--end modal--}}


                <!-- Edit Application Modal -->
                {{--start Modal --}}

                <div class="modal fade" id="staticBackdrop5" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-blue bg-blue">
                                <h5 class="modal-title white" id="staticBackdropLabel3">Edit Application Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="editFormID">

                                <div class="modal-body">
                                    <input type="hidden" name="idEdit" id="idEdit">

                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" required name="nameEdit" id="nameEdit">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" required name="descriptionEdit" id="descriptionEdit">
                                    </div>
                                    <div class="form-group">
                                        <label>Device Used</label>
                                        <div class="row d-flex justify-content-center mt-100">
                                            <div class="col-md-12">

                                                <select class="applicationDeviceEdit form-control" id="appDeviceEdit" name="appDevice[]" style="width:100%" multiple="multiple">
                                                    @foreach($Device as $row)
                                                    <option value="{{$row['id']}}">{{$row['brandName']}} {{$row['model']}}</option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Users</label>

                                        <div class="row d-flex justify-content-left ">
                                            <div class="col-md-12">
                                                <select class="applicationUser form-control" id="appUserEdit" name="appUser[]" style="width:100%" multiple="multiple">
                                                    @foreach($User as $row)
                                                    <option value="{{$row['id']}}">{{$row['fName']}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" class="form-control startDate" name="startDate" id="startDate">
                                    </div>

                                    <div style="width:250px;" class="form-group">
                                        <label>Documents</label>

                                        <input type="file" id="fileInput2" accept=".docx,.pdf " class="form-control" name="documentEdit">
                                        <p>Chosen files:
                                            <a id="appLinkEdit" href="" target="_blank">none</a>
                                            <input type="text" form="editFormID" id="appLinkEdit1" name="appLinkEdit1">
                                        </p>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Updates</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
                {{--end modal--}}




                <!-- Delete Application -->

                {{--start Modal --}}
                <div class="modal fade" id="staticBackdrop1" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-blue">
                                <h5 class="modal-title white" id="staticBackdropLabel2">Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this application?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="#" id="delete" class="btn btn-danger">delete</a>
                            </div>
                        </div>

                    </div>
                </div>

                {{--end modal--}}

                <form id="deleteA" action="/a/" method="post" style="display: none;">
                    @csrf
                </form>



                <!-- Application Details -->
                <div class="col-md-4">
                    <div class="card ">
                        <div class="card-header bg-blue">
                            <h4 class="white" align="left ">Application Details</h4>
                        </div>
                        <div class="card-body">
                            <dl class="row">

                                <dt class="col-sm-4" style="min-height: 100px;">Application Name</dt>
                                <dd id="appName" class="col-sm-8"></dd>
                                <br/>

                                <dt class="col-sm-4" style="min-height: 100px;">Description</dt>
                                <dd id="appDesc" class="col-sm-8">
                                    <p></p>
                                </dd>

                                <br/>

                                <dt class="col-sm-4" style="min-height: 50px;">Start Date</dt>
                                <dd id="appStartD" class="col-sm-8">
                                    <p></p>
                                </dd>

                                <br/>

                                <dt class="col-sm-4" style="min-height: 100px;">List of used devices</dt>
                                <dd id="appDev" class="col-sm-8"></dd>

                                <br/>

                                <dt class="col-sm-4 " style="min-height: 100px;">Users</dt>
                                <dd id="appUser" class="col-sm-8"></dd>

                                <br/>

                                <dt class="col-sm-4 ">Related Documents</dt>
                                <dd class="col-sm-8">
                                    <a id="appLink" href="" target="_blank"></a>
                                </dd>

                                <br/>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">



            <!-- DEVICES -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card" style="height: 580px;">

                        <div class="card-body overflow-auto">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <div class="table table-responsive">
                                <table id="devTable" class="table table-hover table-dark" style="width:100%">
                                    <thead>

                                        <tr>
                                            <th>Id</th>
                                            <th>Serial Number</th>
                                            <th>Brand</th>
                                            <th>Model</th>
                                            <th>Date Purchased</th>
                                            <th style="max-wdith:20px">Actions</th>
                                        </tr>
                                    </thead>
                                    @foreach($Device as $row)
                                    <tr class="viewDev btn-dark" id="{{$row['id']}}">

                                        <td>{{$row['id']}}</td>
                                        <td>{{$row['serialNum']}}</td>
                                        <td>{{$row['brandName']}}</td>
                                        <td>{{$row['model']}}</td>
                                        <td>{{$row['purchaseDate']}}</td>


                                        <td>
                                            <!-- device edit Button trigger modal -->
                                            <button type="button" class="btn btn-success editbtn2">
                                                Edit</button>
                                            <!-- device delete Button trigger modal -->

                                            <button type="button" id="{{$row['id']}}" class="deleter2 btn btn-danger" data-toggle="modal" data-target="#staticBackdrop4">
                                                Delete</button>


                                        </td>
                                    </tr>

                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="card-header d-flex justify-content-between">
                            <h3 align="left"></h3>
                            <div>
                                <!-- Button trigger modal -->

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop3">
                                    Add a New Device</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- add new device -->
                {{--start Modal --}}
                <div class="modal fade" id="staticBackdrop3" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-blue">
                                <h5 class=" modal-title white" id="staticBackdropLabel">Add a New Device</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="addDevForm">

                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Serial Number</label>
                                        <input type="text" class="form-control" required minlength="4" name="serialNum">
                                    </div>
                                    <div class="form-group">
                                        <label>Brand Name</label>
                                        <input type="text" class="form-control" required minlength="4" name="brandName">
                                    </div>
                                    <div class="form-group">
                                        <label>Model</label>
                                        <input type="text" class="form-control" minlength="4" name="model">
                                    </div>
                                    <div class="form-group">
                                        <label>Purchase Date</label>
                                        <input type="date" class="form-control" name="purchase">
                                    </div>


                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
                {{--end modal--}}



                <!-- Edit Device Modal -->
                {{--start Modal --}}

                <div class="modal fade" id="staticBackdrop9" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-blue">
                                <h5 class="modal-title white" id="staticBackdropLabel">Edit Device Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="devEditForm">
                                @method('Put') @csrf

                                <div class="modal-body">
                                    <input type="hidden" name="id" id="id2">
                                    <div class="form-group">
                                        <label>Serial Number</label>
                                        <input type="text" class="form-control" name="serialNum" id="serialNum">
                                    </div>
                                    <div class="form-group">
                                        <label>Brand Name</label>
                                        <input type="text" class="form-control" name="brandName" id="brandName">
                                    </div>
                                    <div class="form-group">
                                        <label>Model</label>
                                        <input type="text" class="form-control" name="model" id="model">
                                    </div>
                                    <div class="form-group">
                                        <label>Purchase Date</label>
                                        <input type="date" class="form-control purchaseDev" name="purchaseDev" id="purchaseDev">
                                    </div>


                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Updates</button>
                                </div>
                            </form>


                        </div>
                    </div>

                </div>
                {{--end modal--}}


                <!--delete device modal -->

                {{--start Modal --}}
                <div class="modal fade" id="staticBackdrop4" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-blue">
                                <h5 class="modal-title white" id="staticBackdropLabel4">Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this Device?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="#" id="delete2" class="btn btn-danger">delete</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{--end modal--}}
                <!-- Delete Device -->

                <form id="deleteD" action="/d/" method="post" style="display: none;">
                    @csrf
                </form>

                <!-- Device Info -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-header bg-blue">
                            <h4 align="left" class="white">Device Details</h4>
                        </div>
                        <div class="card-body">
                            <dl class="row">

                                <dt class="col-sm-4" style="min-height: 50px;">Serial Number</dt>
                                <dd id="devSerial" class="devSerial  col-sm-8">
                                </dd>

                                <br/>

                                <dt class="col-sm-4" style="min-height: 50px;">Brand</dt>
                                <dd id="devBrand" class=" col-sm-8"></dd>


                                <dt class="col-sm-4" style="min-height: 50px;">Model</dt>
                                <dd id="devModel" class=" col-sm-8"></dd>

                                <br/>

                                <dt class="col-sm-4 " style="min-height: 50px;">Date Purchased</dt>
                                <dd id="devPurch" class=" col-sm-8"></dd>

                                <br/>

                                <dt class="col-sm-4">Applications</dt>
                                <dd id="devApp" style="max-height: 200px;" class="col-sm-8 overflow-auto"></dd>
                            </dl>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

            <!-- Users -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card h-100" style="height: 580px;">

                        <div class="card-body overflow-auto">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif

                            <table id="userTable" class="table table-hover table-dark" style="width:100%">
                                <thead>
                                    <tr>

                                        <th>Id</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Position</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        @if (Auth::user()->admin ==1)

                                        <th>Action</th>
                                        @endif

                                    </tr>
                                </thead>
                                @foreach($User as $row)
                                <tr class="viewUser" id="{{$row['id']}}">
                                    <td> {{$row['id']}}</td>
                                    <td>{{$row['fName']}}</td>
                                    <td>{{$row['lName']}}</td>
                                    <td>{{$row['position']}}</td>
                                    <td>{{$row['phoneNum']}}</td>
                                    <td>{{$row['email']}}</td>

                                    @if (Auth::user()->admin ==1)
                                    <td>
                                        <button type="button" id="{{$row['id']}}" class="deleterUser btn btn-danger" data-toggle="modal" data-target="#staticBackdrop11">
                                            Delete
                                        </button>
                                    </td>
                                    @endif
                                </tr>

                                @endforeach
                            </table>

                            <div class="card-header d-flex justify-content-between">
                                <h3 align="left"></h3>
                                <!-- Button trigger modal -->

                                @if (Auth::user()->admin ==1)
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdropUser">
                                    Register a New User
                                </button>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-header bg-blue">
                            <h4 align="left" class="white">User Details</h4>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4" style="min-height: 50px;">First Name</dt>
                                <dd id="userFName" class="col-sm-8"></dd>
                                <br/>

                                <dt class="col-sm-4" style="min-height: 50px;">Last Name</dt>
                                <dd id="userLName" class="col-sm-8">

                                </dd>

                                <br/>

                                <dt class="col-sm-4" style="min-height: 50px;">Email</dt>
                                <dd id="emailUser" class="col-sm-8"></dd>

                                <br/>

                                <dt class="col-sm-4 text-truncate" style="min-height: 50px;">Phone Number</dt>
                                <dd id="phone" class="col-sm-8"></dd>

                                <br/>

                                <dt class="col-sm-4" style="min-height: 50px;">Position</dt>
                                <dd id="position" class="col-sm-8"></dd>

                                <dt class="col-sm-4 overflow-auto " style="height: 200px; ">Application involved in:</dt>
                                <dd id="userApp" class="col-sm-8"></dd>

                                <br/>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Delete User -->

        {{--start Modal --}}
        <div class="modal fade" id="staticBackdrop11" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-blue">
                        <h5 class="modal-title white" id="staticBackdropLabel2">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this User?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="#" id="deleteUser" class="btn btn-danger">delete</a>
                    </div>
                </div>

            </div>
        </div>

        {{--end modal--}}
        <!-- Delete User -->

        <form id="deleteU" action="/u/" method="post" style="display: none;">
            @csrf
        </form>


        <!-- Add a new User -->

        {{--start Modal --}}
        <div class="modal fade" id="staticBackdropUser" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-blue">
                        <h5 class="modal-title white" id="staticBackdropLabel">Add a New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addUserForm">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <label for="fName" class="col-md-4 col-form-label text-md-right">First Name</label>

                                <div class="col-md-6">
                                    <input id="fName" type="text" class="form-control @error('fName') is-invalid @enderror" name="fName" minlength="5" value="{{ old('fName') }}"
                                        required autocomplete="fName" autofocus> @error('fName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">


                                <label for="lName" class="col-md-4 col-form-label text-md-right">Last Name</label>

                                <div class="col-md-6">
                                    <input id="lName" type="text" class="form-control @error('lName') is-invalid @enderror" name="lName" minlength="5" value="{{ old('lName') }}"
                                        required autocomplete="lName" autofocus> @error('lName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phoneNum" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                                <div class="col-md-6">
                                    <input id="phoneNum" type="text" class="form-control @error('phoneNum') is-invalid @enderror" name="phoneNum" minlength="6"
                                        value="{{ old('phoneNum') }}" required autocomplete="phoneNum" autofocus> @error('phoneNum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="position" class="col-md-4 col-form-label text-md-right">Position</label>

                                <div class="col-md-6">
                                    <input id="position" type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{ old('position') }}"
                                        required autocomplete="position" autofocus> @error('position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                        required autocomplete="email"> @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" minlength="8"
                                        required autocomplete="new-password"> @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" form="addUserForm" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>



    <script>
        var file = document.getElementById('fileInput');
        var file2 = document.getElementById('fileInput2');

        file.onchange = function (e) {
            var ext = this.value.match(/\.([^\.]+)$/)[1];
            switch (ext) {
                case 'docx':
                case 'pdf':
                case 'png':
                case 'tif':
                    break;
                default:
                    alert('The document type you added is Not allowed');
                    this.value = '';
            }
        };
        file2.onchange = function (e) {
            var ext = this.value.match(/\.([^\.]+)$/)[1];
            switch (ext) {
                case 'docx':
                case 'pdf':
                case 'png':
                case 'tif':
                    break;
                default:
                    alert('The document type you added is Not allowed');
                    this.value = '';
            }
        };





        $(document).ready(function () {

            $('#devTable').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'Todos']
                ]
            });
        })

        $(document).ready(function () {
            $('#userTable').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'Todos']
                ]
            });
        })

        $(document).ready(function () {
            $('#appTable').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'Todos']
                ]
            });
        })

        // edit app



        $('.editbtn').on('click', function () {
            $('#staticBackdrop5').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();


            $('#idEdit').val(data[0]);
            $('#nameEdit').val(data[1]);
            $('#descriptionEdit').val(data[2]);
            $('#appLinkEdit').attr("href", "files/" + data[4])
            $('#appLinkEdit').empty();
            $('#appLinkEdit').append(data[4]);
            $('#appLinkEdit1').empty();
            $('#appLinkEdit1').val(data[4]);
            $('.startDate').val(data[5]);

        });

        $('#editFormID').on('submit', function (e) {
            $('.loading').show();

            e.preventDefault();
            var id = $('#idEdit').val();
            formData = new FormData(this);


            $.ajax({
                type: 'POST',
                url: '/aEdit/' + id,
                data: formData,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    console.log(response)
                    alert(response.message);
                    $('.loading').hide();
                    if (response.message == 'Application Updated Successfully') {
                        location.reload();
                        $('#staticBackdrop5').modal('hide');
                    }

                },
                error: function (error) {
                    console.log(error);
                    alert('Data NOT Updated');
                    $('.loading').hide();

                }
            });
        });



        // edit dev

        $('.editbtn2').on('click', function () {
            $('#staticBackdrop9').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data[4]);

            $('#id2').val(data[0]);
            $('#serialNum').val(data[1]);
            $('#brandName').val(data[2]);
            $('#model').val(data[3]);
            $('.purchaseDev').val(data[4]);
        });
        $('#devEditForm').on('submit', function (e) {
            $('.loading').show();

            e.preventDefault();
            var id = $('#id2').val();

            $.ajax({
                type: "PUT",
                url: "/d/" + id,
                data: $('#devEditForm').serialize(),
                success: function (response) {
                    console.log(response);
                    $('#staticBackdrop9').modal('hide');
                    alert('Data Updated');
                    $('.loading').hide();

                    location.reload();
                },
                error: function (error) {
                    console.log(error);
                    alert('Data NOT Updated');
                    $('.loading').hide();
                }
            });
        });


        // delete app, device, and user
        $(document).on("click", "#delete", function () {
            $('.loading').show();

            $("#deleteA").attr("action", "/a/" + window.ider);
            $("#deleteA").submit();
        })


        $(document).on("click", "#delete2", function () {
            $('.loading').show();

            $("#deleteD").attr("action", "/d/" + window.ider2);
            $("#deleteD").submit();


        })

        $(document).on("click", "#deleteUser", function () {
            $('.loading').show();

            $("#deleteU").attr("action", "/u/" + window.ider3);
            $("#deleteU").submit();


        })

        $(document).on("click", ".deleter", function () {
            window.ider = $(this).attr("id");
        })

        $(document).on("click", ".deleter2", function () {
            window.ider2 = $(this).attr("id");
        })

        $(document).on("click", ".deleterUser", function () {
            window.ider3 = $(this).attr("id");
        })


        // add a new app
        $(document).ready(function () {
            $('#addAppForm').on('submit', function (e) {
                e.preventDefault();
                $('.loading').show();


                $.ajax({
                    type: 'POST',
                    url: '/a',
                    data: new FormData(this),
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (response) {
                        console.log(response)
                        alert(response.message);
                        $('.loading').hide();
                        if (response.message == 'Application Added Successfully') {
                            location.reload();
                            $('#staticBackdrop2').modal('hide')
                        }

                    },
                    error: function (error) {
                        console.log(error)
                        alert("Data Not Saved");
                        $('.loading').hide();

                    }
                })
            })

        })

        // add a new device
        $(document).ready(function () {
            $('#addDevForm').on('submit', function (e) {
                e.preventDefault();
                $('.loading').show();


                $.ajax({
                    type: 'POST',
                    url: '/d',
                    data: $('#addDevForm').serialize(),
                    success: function (response) {
                        console.log(response)
                        $('#staticBackdrop3').modal('hide')
                        alert("Data Saved");
                        $('.loading').hide();

                        location.reload();

                    },
                    error: function (error) {
                        console.log(error)
                        alert("Data Not Saved");
                        $('.loading').hide();

                    }
                })
            })

        })

        // add a new User
        $(document).ready(function () {
            $('#addUserForm').on('submit', function (e) {
                e.preventDefault();
                $('.loading').show();


                $.ajax({
                    type: 'POST',
                    url: '/u',
                    data: $('#addUserForm').serialize(),
                    success: function (response) {
                        console.log(response)
                        $('#staticBackdropUser').modal('hide')
                        alert("New User Created");
                        $('.loading').hide();

                        location.reload();

                    },
                    error: function (error) {
                        console.log(error)
                        alert("User Not created");
                        $('.loading').hide();

                    }
                })
            })

        })



        // View App Details
        $('.viewApp').on('click', function () {

            $('.loading').show();

            window.viewAppId = $(this).attr("id");
            var devicesApp = new Array();
            var usersApp = new Array();

            $.ajax({
                type: "GET",
                url: "a/" + viewAppId,
                success: function (data) {
                    $('#appName').empty();
                    $('#appDesc').empty();
                    $('#appStartD').empty();
                    $('#appDev').empty();
                    $('#appUser').empty();
                    $('#appLink').empty();
                    $('#appName').append(data.name);
                    $('#appDesc').append(data.description);
                    $('#appStartD').append(data.startDate);
                    $('#appLink').attr("href", "files/" + data.document)
                    $('#appLink').append(data.document);
                    data.device.forEach(myFunction);
                    data.user.forEach(myFunction2);
                    console.log(data);


                    function myFunction(item, index) {

                        devicesApp.push(item.id);

                        $('#appDev').append(item.serialNum + " " + item.brandName + "<br>");


                    };
                    $("#appDeviceEdit").val(devicesApp).trigger('change');


                    function myFunction2(item, index) {
                        usersApp.push(item.id);

                        $('#appUser').append(item.position + ". " +
                            item.fName + " " + item.lName +
                            ", <br>");
                        console.log(item.fName);
                    };
                    $("#appUserEdit").val(usersApp).trigger('change');



                    $('.loading').hide();

                    console.log(data.device);
                },
                error: function (error) {
                    console.log(error)

                }
            })

        })

        // View Device Details
        $('.viewDev').on('click', function () {

            $('.loading').show();

            window.viewDevId = $(this).attr("id");
            console.log(viewDevId);


            $.ajax({
                type: "GET",
                url: "d/" + viewDevId,
                success: function (data) {
                    $('#devSerial').empty();
                    $('#devBrand').empty();
                    $('#devModel').empty();
                    $('#devPurch').empty();
                    $('#devApp').empty();
                    $('#devSerial').append(data.serialNum);
                    $('#devBrand').append(data.brandName);
                    $('#devModel').append(data.model);
                    $('#devPurch').append(data.purchaseDate);
                    data.application.forEach(myFunction);

                    $('.loading').hide();


                    function myFunction(item, index) {
                        $('#devApp').append(item.name + ",<br>");
                    };
                    console.log(data);
                },
                error: function (error) {
                    console.log(error)

                }
            })

        })

        // view user details
        $('.viewUser').on('click', function () {
            $('.loading').show();


            window.viewUserId = $(this).attr("id");

            $.ajax({
                type: "GET",
                url: "u/" + viewUserId,
                success: function (data) {
                    $('#userFName').empty();
                    $('#userLName').empty();
                    $('#emailUser').empty();
                    $('#phone').empty();
                    $('#position').empty();
                    $('#userApp').empty();
                    $('#userFName').append(data.fName);
                    $('#userLName').append(data.lName);
                    $('#emailUser').append(data.email);
                    $('#phone').append(data.phoneNum);
                    $('#position').append(data.position);

                    data.application.forEach(myFunction);


                    function myFunction(item, index) {
                        $('#userApp').append(item.name + ", <br>");
                    };
                    $('.loading').hide();

                    console.log(data);
                },
                error: function (error) {
                    console.log(error)

                }
            })

        })

        $(document).ready(function () {
            var now = new Date();
            var month = (now.getMonth() + 1);
            var day = now.getDate();
            if (month < 10)
                month = "0" + month;
            if (day < 10)
                day = "0" + day;
            var today = now.getFullYear() + '-' + month + '-' + day;
            $('.startD').val(today);
        });
        // Datatables
        $(document).ready(function () {
            $('.applicationDevice').select2({
                placeholder: "Select devices"
            });

            $('.applicationUser').select2({
                placeholder: "Select Users"
            });

            $('.applicationDeviceEdit').select2({
                placeholder: "Select devices"
            });

        });

    </script>
    @endsection
