    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid ">
        <form class="kt-form kt-form--label-right" id="task_add_form">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active" data-toggle="tab" id="tab_information" href="#kt_quick_panel_tab_information" role="tab">{{__('task.information')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" id="tab_time" href="#kt_quick_panel_tab_time" role="tab">{{__('task.time')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="text-transform: uppercase" data-toggle="tab"  id="tab_statistics" href="#kt_quick_panel_tab_statistics" role="tab">{{__('task.statistics')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-scroll taskAddBody" data-scroll="true">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_quick_panel_tab_information">
                            <div class="row mb-3">
                                <div class="col-8">
                                   <h4>{{$selected_person['nameFirst'].' '.$selected_person['nameMiddle'].' '.$selected_person['nameFamily']}}</h4>
                                </div>
                                <div class="col-4 text-right">
                                 @include('people.partials.details_avatar')
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-3">Tags:</div>
                            </div>
                            <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                            <div class="row mb-3">
                                <div class="col-6" >
                                    <div  class="people_details_text">
                                        <p>First Name</p>
                                        <p>{{$selected_person['nameFirst']}}</p>
                                    </div>
                                    <div  class="people_details_text">
                                        <p>Middle Name</p>
                                        <p>{{$selected_person['nameMiddle']}}</p>
                                    </div>
                                    <div class="people_details_text">
                                        <p>Last Name</p>
                                        <p>{{$selected_person['nameFamily']}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="people_details_text">
                                        <p>Gender</p>
                                        <p><?php if ($selected_person['gender'] == 1) echo 'Male'; else echo 'Female'; ?></p>
                                    </div>
                                    <div class="people_details_text">
                                        <p>Date Of Birth</p>
                                        <p>{{$selected_person['birthday']}}</p>
                                    </div>
                                    <div class="people_details_text">
                                        <p>Nationality</p>
                                        <p>{{$selected_person['nationality']}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                            <div class="row mb-3">
                                <div class="col-6" >
                                    <div class="people_details_text">
                                        <p>Address</p>
                                        <p>{{$selected_person['address']}}</p>
                                    </div>
                                    <div class="people_details_text">
                                        <p >Country</p>
                                        <p >WA, USA</p>
                                    </div>
                                    <div class="people_details_text">
                                        <p >Phone</p>
                                        <p >{{$selected_person['phone_number']}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="people_details_text">
                                        <p >Mail</p>
                                        <p >{{$selected_person['email']}}</p>
                                    </div>
                                    <div class="people_details_text">
                                        <p >Messenger</p>
                                        <p ></p>
                                    </div>
                                    <div  class="people_details_text">
                                        <p>Organization</p>
                                        <p>{{$selected_person['organization']}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                            <div class="row mb-3">
                                <div class="col-6" >
                                    <div class="people_details_text">
                                        <p>Company ID</p>
                                        <p></p>
                                    </div>
                                    <div class="people_details_text">
                                        <p>Bank Account</p>
                                        <p></p>
                                    </div>
                                    <div class="people_details_text">
                                        <p>Bank</p>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="people_details_text">
                                        <p>National ID</p>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                            <div class="row m-0">
                                <p> Description </p>
                                <div>

                                </div>
                            </div>
                            <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                            <div class="row m-0">
                                <p> Family </p>
                                <div>

                                </div>
                            </div>
                            <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                            <div class="row m-0">
                                <p> Attachment </p>
                                <div>

                                </div>
                            </div>
                            <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                            <div class="row m-0">
                                <p> History </p>
                                <div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="kt_quick_panel_tab_time">
                            <div class="row mb-3">
                                <div class="col-8">
                                    <h4>{{$selected_person['nameFirst'].' '.$selected_person['nameMiddle'].' '.$selected_person['nameFamily']}}</h4>
                                </div>
                                <div class="col-4 text-right">
                                    @include('people.partials.details_avatar')
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-3">Tags:</div>
                            </div>
                            <div class="mb-2 mt-2" style="width: 100%; height: 1px; background-color: grey"></div>
                            <?php $cc = 0?>
                            @foreach($workTime as $index => $item)
                                @if ($cc++ == 3)
                                    <div class="mb-2 mt-2" style="width: 100%; height: 1px; background-color: grey"></div>
                                @endif
                                <div class="row" style="font-size: 16px">
                                    <div class="col-3">
                                        {{$index}}
                                    </div>
                                    <div class="col-9">
                                        <?php echo floor($item/8).'d '.fmod($item,8).'h'; ?>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="tab-pane" id="kt_quick_panel_tab_statistics">
                            <div class="row mb-3">
                                <div class="col-8">
                                    <h4>{{$selected_person['nameFirst'].' '.$selected_person['nameMiddle'].' '.$selected_person['nameFamily']}}</h4>
                                </div>
                                <div class="col-4 text-right">
                                    @include('people.partials.details_avatar')
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-3">Tags:</div>
                            </div>
                            <div class="row m-0">
                                <table style="width: 100%; font-size: 16px">
                                    <tr>
                                        <th></th>
                                        <th>Success</th>
                                        <th><i class="fa fa-circle"></i>    </th>
                                        <th><i class='flaticon2-arrow lg'></i></th>
                                        <th><i class='fa fa-pause'></i></th>
                                        <th><i class='flaticon2-check-mark'></i></th>
                                        <th><i class='flaticon2-delete'></i></th>
                                        <th><i class='fa fa-star'></i></th>
                                    </tr>
                                    <?php $cc = 0; ?>
                                    @foreach($statistics as $index => $item)
                                        <tr <?php if ($cc == 0 || $cc == 3){
                                              echo 'style="border-top: solid 1px grey;"';
                                        } $cc += 1; ?> >

                                            <td>{{$index}}</td>
                                            <td><?php echo round($item['success'] * 100,2); ?> %</td>
                                            <td>{{$item[1]}}</td>
                                            <td>{{$item[2]}}</td>
                                            <td>{{$item[3]}}</td>
                                            <td>{{$item[4]}}</td>
                                            <td>{{$item[5]}}</td>
                                            <td>{{$item[7]}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>