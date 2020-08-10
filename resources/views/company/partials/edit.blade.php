<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid " id="companyEditForm">
    <form class="kt-form kt-form--label-right" method="post" action="{{route('company.update')}}">
        @csrf
        <input type="hidden" name="selectedID" value="{{$selected_company['id']}}">
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
                        <div class="row">
                            <div class="col-8">
                                <h2>{{$selected_company['short_name']}}</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2" style="color: #ca30e9">Tags:</div>
                            <div class="col-lg-10 ">
                                <div id="organization-tags" style="display: flex; flex-wrap: wrap;"><?php
                                    foreach($organizationTagList as $taskTag) {
                                    ?>
                                    <span class="@if($taskTag['tagtype']==1) system-span @elseif($taskTag['tagtype']==2) organization-span @elseif($taskTag['tagtype']==3) personal-span @endif" style="@if ($taskTag['tagtype']!=3 )background-color:{{$taskTag['color']}} @else border-color:{{$taskTag['color']}} @endif">
                                                    {{$taskTag['name']}}
                                                </span> &nbsp;
                                    <?php
                                    }
                                    ?>
                                </div>
                                <input type="hidden" name="tags">
                                <p id="organization-edit-tags" @if (count($organizationTagList) != 0) style="display: none;" @endif>
                                    <select class="form-control kt-selectpicker" multiple data-actions-box="true" name="orgTags">
                                        @foreach($tagList as $tagItem)
                                            <option data-content='<span class="@if($tagItem['tagtype']==1) system-span @elseif($tagItem['tagtype']==2) organization-span @elseif($tagItem['tagtype']==3) personal-span @endif" style="@if ($tagItem['tagtype']!=3 )background-color:{{$tagItem['color']}} @else border-color:{{$tagItem['color']}} @endif">
                                                    {{$tagItem['name']}}
                                                    </span>' value="{{$tagItem['ID']}}"
                                            <?php
                                                foreach($organizationTagList as $taskTag) {
                                                    if ($taskTag['ID'] == $tagItem['ID'])
                                                    {
                                                        echo 'selected';
                                                        break;
                                                    }
                                                }
                                                ?>
                                            >
                                            </option>
                                        @endforeach
                                    </select>
                                </p>
                            </div>
                        </div>
                        <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row">
                            <div class="col-md-3"><label for="shortName">Short Name</label></div>
                            <div class="col-md-3">
                                    <span class="company_detail_span_text">{{$selected_company['short_name']}}</span>
                                    <input type="text" class="form-control" name="shortName" value="{{$selected_company['short_name']}}" id="shortName" style="display: <?php  if($selected_company['short_name']!="") echo 'none'; else echo 'block'; ?>">
                               </div>
                            <div class="col-md-3"><label for="type">Type</label></div>
                            <div class="col-md-3">
                                    <span class="company_detail_span_text">{{$selected_company['type']}}</span>
                                    <input type="text" class="form-control" name="type" value="{{$selected_company['type']}}" id="type"  style="display: <?php  if($selected_company['type']!="") echo 'none'; else echo 'block'; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="longName">Long Name</label></div>
                            <div class="col-md-9">
                                <span class="company_detail_span_text">{{$selected_company['long_name']}}</span>
                                <input type="text" class="form-control" name="longName" id="longName" value="{{$selected_company['long_name']}}" style="display: <?php  if($selected_company['long_name']!="") echo 'none'; else echo 'block'; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><label for="industry">Industry</label></div>
                            <div class="col-md-9">
                                <span class="company_detail_span_text">{{$selected_company['industry']}}</span>
                                <input type="text" class="form-control" value="{{$selected_company['industry']}}" name="industry" id="industry" style="display: <?php  if($selected_company['industry']!="") echo 'none'; else echo 'block'; ?>">
                            </div>
                        </div>
                        <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row">
                            <div class="col-md-3"><label for="address">Address</label></div>
                            <div class="col-md-3">
                                <span class="company_detail_span_text">{{$selected_company['address']}}</span>
                                <input type="text" class="form-control" value="{{$selected_company['address']}}" name="address" id="address" style="display: <?php  if($selected_company['address']!="") echo 'none'; else echo 'block'; ?>">
                            </div>
                            <div class="col-md-3"><label for="registrationNumber">Registration No</label></div>
                            <div class="col-md-3">
                                <span class="company_detail_span_text">{{$selected_company['registrationNumber']}}</span>
                                <input type="text" class="form-control" value="{{$selected_company['registrationNumber']}}" name="registrationNumber" id="registrationNumber" style="display: <?php  if($selected_company['registrationNumber']!="") echo 'none'; else echo 'block'; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="country">Country</label></div>
                            <div class="col-md-3">
                                <span class="company_detail_span_text">{{$selected_company['country']}}</span>
                                <input type="text" class="form-control" value="{{$selected_company['country']}}" name="country" id="country" style="display: <?php  if($selected_company['country']!="") echo 'none'; else echo 'block'; ?>">
                            </div>
                            <div class="col-md-3"><label for="vatNumber">VAT No</label></div>
                            <div class="col-md-3">
                                <span class="company_detail_span_text">{{$selected_company['VATNumber']}}</span>
                                <input type="text" class="form-control" value="{{$selected_company['VATNumber']}}" name="vatNumber" id="vatNumber" style="display: <?php  if($selected_company['VATNumber']!="") echo 'none'; else echo 'block'; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="phone">Phone</label></div>
                            <div class="col-md-3">
                                <span class="company_detail_span_text">{{$selected_company['phone']}}</span>
                                <input type="text" class="form-control" value="{{$selected_company['phone']}}" name="phone" id="phone" style="display: <?php  if($selected_company['phone']!="") echo 'none'; else echo 'block'; ?>">
                            </div>
                            <div class="col-md-3"><label for="taxPayer">Taxpayer</label></div>
                            <div class="col-md-3">
                                <span class="company_detail_span_text" id="taxPayerSpan">
                                    <?php
                                        if ($selected_company['Taxpayer'] == 0) {
                                            echo "<i class='flaticon2-check-mark'></i>";
                                        } else {
                                            echo "<i class='flaticon2-delete'></i>";
                                        }
                                    ?></span>
                                <select class="form-control" name="taxPayer" id="taxPayer" style="display: none">
                                    <option value="0" <?php if($selected_company['Taxpayer'] == 0) echo "selected"; ?>>Yes</option>
                                    <option value="1" <?php if($selected_company['Taxpayer'] == 1) echo "selected"; ?>>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><label for="email">mail</label></div>
                            <div class="col-md-3">
                                <span class="company_detail_span_text">
                                    {{$selected_company['email']}}
                                </span>
                                <input type="text" class="form-control" value="{{$selected_company['email']}}" name="email" id="email" style="display: <?php  if($selected_company['email']!="") echo 'none'; else echo 'block'; ?>">
                            </div>
                            <div class="col-md-3"><label for="messenger">messenger</label></div>
                            <div class="col-md-3">
                                <span class="company_detail_span_text">
                                    {{$selected_company['messenger']}}
                                </span>
                                <input type="text" class="form-control" value="{{$selected_company['messenger']}}" name="messenger" id="messenger" style="display: <?php  if($selected_company['messenger']!="") echo 'none'; else echo 'block'; ?>">
                            </div>
                        </div>
                        <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row">
                            <div class="col-md-3"><label for="companyID">Company ID</label></div>
                            <div class="col-md-9">
                                <span class="company_detail_span_text">
                                    {{$selected_company['companyID']}}
                                </span>
                                <input type="text" class="form-control" value="{{$selected_company['companyID']}}" name="companyID" id="companyID" style="display: <?php  if($selected_company['companyID']!="") echo 'none'; else echo 'block'; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="bankAccount">Bank Account</label></div>
                            <div class="col-md-9">
                                <span class="company_detail_span_text">{{$selected_company['bank_account']}}</span>
                                <input type="text" class="form-control" value="{{$selected_company['bank_account']}}" name="bankAccount" id="bankAccount" style="display: <?php  if($selected_company['bank_account']!="") echo 'none'; else echo 'block'; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="bank">Bank</label></div>
                            <div class="col-md-9">
                                <span class="company_detail_span_text">{{$selected_company['bank']}}</span>
                                <input type="text" class="form-control" value="{{$selected_company['bank']}}" name="bank" id="bank" style="display: <?php  if($selected_company['bank']!="") echo 'none'; else echo 'block'; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label for="swift_bic">SWIFT/BIC</label></div>
                            <div class="col-md-9">
                                <span class="company_detail_span_text">{{$selected_company['swift_bic']}}</span>
                                <input type="text" class="form-control" value="{{$selected_company['swift_bic']}}" name="swift_bic" id="swift_bic" style="display: <?php  if($selected_company['swift_bic']!="") echo 'none'; else echo 'block'; ?>">
                            </div>
                        </div>
                        <div class="mb-3" style="width: 100%; height: 1px; background-color: grey"></div>
                        <div class="row">
                            <div class="col-md-3"  style="color: #ca30e9"><label for="description">Description</label></div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <span id="descriptionSpan">{{$selected_company['description']}}</span>
                                <textarea class="form-control" rows="10" name="description" id="description" style="display: <?php  if($selected_company['description']!="") echo 'none'; else echo 'block'; ?>">{{$selected_company['description']}}</textarea>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-4 ml-auto mr-auto">
                                <a href="{{route('company.delete',['id'=>$selectedID])}}" class="form-control btn btn-success">Delete</a>
                            </div>
                            <div class="col-4 ml-auto mr-auto">
                                <button type="submit" class="form-control btn btn-success" id="companyCardUpdate" disabled>Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>