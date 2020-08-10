<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid " style="display: none" id="companyAddForm">
    <form class="kt-form kt-form--label-right" method="post" action="{{route('company.add')}}">
        @csrf
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link active" data-toggle="tab" id="tab_information" href="#kt_quick_panel_tab_information" role="tab">{{__('task.information')}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-scroll" data-scroll="true">
                <div class="tab-content">
                    <div class="tab-pane active" id="kt_quick_panel_tab_information">
                        <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row">
                            <div class="col-2" style="color: #ca30e9">Tags:</div>
                            <div class="col-lg-10 ">
                                <input type="hidden" name="addTags">
                                <p id="organization-add-tags">
                                    <select class="form-control kt-selectpicker" multiple data-actions-box="true" name="orgAddTags">
                                        @foreach($tagList as $tagItem)
                                            <option data-content='<span class="@if($tagItem['tagtype']==1) system-span @elseif($tagItem['tagtype']==2) organization-span @elseif($tagItem['tagtype']==3) personal-span @endif" style="@if ($tagItem['tagtype']!=3 )background-color:{{$tagItem['color']}} @else border-color:{{$tagItem['color']}} @endif">
                                                    {{$tagItem['name']}}
                                                    </span>' value="{{$tagItem['ID']}}">
                                            </option>
                                        @endforeach
                                    </select>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="shortName">Short Name</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="shortName" id="shortName"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="longName">Long Name</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="longName" id="longName"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="type">Type</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="type" id="type"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="industry">Industry</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="industry" id="industry"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="country">Country</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="country" id="country"></div>
                        </div>
                        <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row">
                            <div class="col-md-3"><label for="address">Address</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="address" id="address"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="registrationNumber">Registration No</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="registrationNumber" id="registrationNumber"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="vatNumber">VAT No</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="vatNumber" id="vatNumber"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><label for="taxPayer">Taxpayer</label></div>
                            <div class="col-md-9">
                                <select class="form-control" name="taxPayer" id="taxPayer">
                                    <option value="0">Yes</option>
                                    <option value="1">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="phone">Phone</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="phone" id="phone"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="email">mail</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="email" id="email"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="messenger">messenger</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="messenger" id="messenger"></div>
                        </div>
                        <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row">
                            <div class="col-md-3"><label for="companyID">Company ID</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="companyID" id="companyID"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="bankAccount">Bank Account</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="bankAccount" id="bankAccount"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="bank">Bank</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="bank" id="bank"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="swift_bic">SWIFT/BIC</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="swift_bic" id="swift_bic"></div>
                        </div>
                        <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row">
                            <div class="col-md-3"><label for="description">Description</label></div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <textarea class="form-control" rows="10" name="description" id="description"></textarea>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-6 ml-auto mr-auto">
                                <button type="submit" class="form-control btn btn-success">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>