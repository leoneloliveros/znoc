
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="display: flex;  justify-content: space-between; align-items: center;">
                    <h4>Areas in Charge</h4>
                    <a class="" data-toggle="tooltip" title="New Area"  href="{{route('areas.create')}}"><i class="fas fa-plus-square fa-2x"></i></a>
                </div>
                <div class="panel-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="height: 10vh; display: flex; align-items: center; justify-content: space-between;">
                            <div class="" style="font-size: 20px;">{{substr($area->area, strrpos($area->area,"_") + 1)}}</div>
                            <div class="">


                            <a href="{{route('create_user', $area->area )}}" data-toggle="tooltip" title="New User" class="btn btn-sm btn-primary">

                                <i class="fas fa-user-plus fa-2x"></i>
                            </a>
                            <a href="{{ route('roles.index', $area->area )}}" data-toggle="tooltip" title="Roles" class="btn btn-sm btn-primary">
                            <i class="fas fa-user-tag fa-2x"></i>

                            </a>
                            <a href="{{route('usersarea', $area->area )}}" data-toggle="tooltip" title="All Users" class="btn btn-sm btn-primary">
                            <i class="fas fa-users fa-2x"></i>
                            </a>
                            </div>
                        </div>
                        <div class="panel-body" >
                          <table class="table">
                            <thead>
                              <tr>
                                <th scope="col"><h4 class="text-center">Projects</h4></th>
                                <th scope="col"><h4 class="text-center">Area Coordinator/s</h4></th>
                                <th scope="col"><h4 class="text-center">Area Options</h4></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                    <div  style="display: flex;  justify-content: space-between;">
                                      <th scope="col" style="text-align:center;"><strong>{{substr($value['subarea'], strrpos($value['subarea'],"_") + 1)}}</strong></th>
                                      <th scope="col"><span>
                                        <ul>

                                          <li style="list-style: none; padding-right: 15%; list-style: none; text-align: center;">
                                            {!! Form::open(array('route' => array('responsableDestroy', $value2->id ), 'method' => 'delete','onsubmit' =>" modifyTexttt(this); return false;")) !!}







                                            {{$value2->name}} <button data-toggle="tooltip" title="Delete coordinator" class="btn btn-default" type="submit" style="color: #f77777; cursor: pointer;"><i class="fas fa-user-times"></i></button>
                                            {!! Form::close() !!}
                                          </li>
                                        </ul>
                                      </span></th>
                                    <th scope="col" style="text-align:center;">
                                    {!! Form::open(array('route' => array('createCoordinator', $value['subarea']), 'method' => 'get')) !!}

                                        <button data-toggle="tooltip" title="Add Coordinator"   class="btn btn-info" type="submit"><i class="fas fa-user-ninja" style="color:white;"></i></button>
                                    {!! Form::close() !!}

                                    {!! Form::open(array('route' => array('areas.destroy', $value['id']), 'method' => 'delete','onsubmit' =>" modifyText(this); return false; ")) !!}


                                        <button class="btn btn-danger btn-sm"  type="submit" id="venito" name="button" value="delete"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>

                                        {!! Form::close() !!}




                                        {!! Form::close() !!}
                                    </th>
                                    </div>
                                </tr>

                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>

</div>
