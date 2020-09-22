<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid " style="@if($errors->has('email'))display: block; @else display: none; @endif" id="personAddForm">
    <form class="kt-form kt-form--label-right" method="post" action="{{route('people.add')}}">
        @csrf
        <input type="hidden" name="organizationID" id="organizationID" value="{{auth()->user()->organization_id}}">

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
                        <div class="mb-3 mt-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row">
                            <div class="col-2" style="color: #ca30e9">Tags:</div>
                            <div class="col-lg-10 ">
                                <input type="hidden" name="personTags">
                                <p>
                                    <select class="form-control kt-selectpicker" multiple data-actions-box="true" name="personAddTags">
                                        @foreach($tagList as $tagItem)
                                            <option data-content='<span class="@if($tagItem['tagtype']==1) system-span @elseif($tagItem['tagtype']==2) organization-span @elseif($tagItem['tagtype']==3) personal-span @endif" style="color:{{$tagItem['color']}}">
                                                    {{$tagItem['name']}}
                                                    </span>' value="{{$tagItem['ID']}}">
                                            </option>
                                        @endforeach
                                    </select>
                                </p>
                            </div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="firstName">First Name</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="nameFirst" id="firstName" required></div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="middleName">Middle Name</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="nameMiddle" id="middleName"></div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="familyName">Last Name</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="nameFamily" id="familyName" required></div>
                        </div>

                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="roleID">Role</label></div>
                            <div class="col-md-9">
                                <select name="roleID" id="roleID" class="form-control">
                                    <option value="1"> ADMIN </option>
                                    <option value="2"> Manager </option>
                                    <option value="4"> Member </option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="gender">Gender</label></div>
                            <div class="col-md-9">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="1"> male </option>
                                    <option value="0"> female </option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="password">Password</label></div>
                            <div class="col-md-9"><input type="password" class="form-control" name="password" id="password" required></div>
                        </div>
                        <div class="mb-3  mt-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="birthday">Date of Birth</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="birthday" id="birthday"></div>
                        </div>

                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="nationality">Nationality</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="nationality" id="nationality"></div>
                        </div>

                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="address">Address</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="address" id="address"></div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="country">Country</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="country" id="country"></div>
                        </div>

                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="phone">Phone</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="phone_number" id="phone"></div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="email">mail</label></div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="email" id="email" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="messenger">messenger</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="messenger" id="messenger"></div>
                        </div>
                        <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="nationalID">National ID</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="nationalID" id="nationalID"></div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="companyID">Company ID</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="companyID" id="companyID"></div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="bankAccount">Bank Account</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="bankAccount" id="bankAccount"></div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="bank">Bank</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="bank" id="bank"></div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="swift_bic">SWIFT/BIC</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="swift_bic" id="swift_bic"></div>
                        </div>

                        <div class="row mt-1 mb-1">
                            <div class="col-md-3"><label for="family">Family</label></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="family" id="family"></div>
                        </div>

                        <div class="mb-3  mt-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row">
                            <div class="col-md-3"><label for="description">Description</label></div>
                        </div>
                        <div class="row mt-1 mb-1">
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