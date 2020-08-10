<?php

namespace App\Http\Controllers;

use App\Company;
use App\Model\Tag;
use App\TagOrganization;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function company(Request $request) {
        $Tag = new Tag();
        $organizationTag = new TagOrganization();
        $selected_company = null;
        $select = $request->input('select');
        $selected_company = Company::where('id',$select)->get()->first();
        $companies = Company::all()->toArray();
        $tagList = $Tag->getTagList();
        $organizationTagList = [];
        if ($select)
            $organizationTagList = $organizationTag->getOrganizationTagList($select);
        return view('company.index',
            [
                'organization' => true,
                'companies' => $companies,
                'selected_company' => $selected_company,
                'selectedID' => $select,
                'tagList' => $tagList,
                'organizationTagList' => $organizationTagList,
            ]
        );
    }

    public function Add(Request $request) {

        $data = [
            'short_name' => $request->input('shortName'),
            'long_name' => $request->input('longName'),
            'type' => $request->input('type'),
            'Taxpayer' => $request->input('taxPayer'),
            'VATNumber' => $request->input('vatNumber'),
            'registrationNumber' => $request->input('registrationNumber'),
            'country' => $request->input('country'),
            'address' => $request->input('address'),
//            'Manager',
//            'ContactPerson',
            'description' => $request->input('description'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'messenger' => $request->input('messenger'),
            'swift_bic' => $request->input('swift_bic'),
            'industry' => $request->input('industry'),
            'bank' => $request->input('bank'),
            'bank_account' => $request->input('bankAccount'),
            'companyID'=> $request->input('companyID')
        ];
        $comapny = Company::create($data);
        $tags = $request->input('addTags');
        $tags = explode(",",$tags);

        foreach($tags as $tag) {
            TagOrganization::create(['companyID'=>$comapny->id,'tagID'=>$tag]);
        }

        return redirect('organization?select='.$comapny->id);
    }

    public function Update(Request $request) {
        $id = $request->input('selectedID');
        $tags = $request->input('tags');

        if ($tags != "") {
            TagOrganization::where('companyID',$id)->delete();
            $tags = explode(",",$tags);

            foreach($tags as $tag) {
                TagOrganization::create(['companyID'=>$id,'tagID'=>$tag]);
            }
        }

        $data = [
            'short_name' => $request->input('shortName'),
            'long_name' => $request->input('longName'),
            'type' => $request->input('type'),
            'Taxpayer' => $request->input('taxPayer'),
            'VATNumber' => $request->input('vatNumber'),
            'registrationNumber' => $request->input('registrationNumber'),
            'country' => $request->input('country'),
            'address' => $request->input('address'),
//            'Manager',
//            'ContactPerson',
            'description' => $request->input('description'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'messenger' => $request->input('messenger'),
            'swift_bic' => $request->input('swift_bic'),
            'industry' => $request->input('industry'),
            'bank' => $request->input('bank'),
            'bank_account' => $request->input('bankAccount'),
            'companyID'=> $request->input('companyID')
        ];
        Company::where('id',$id)->update($data);
        return redirect('organization?select='.$id);
    }
    public function Delete(Request $request) {
        $id = $request->input('id');
        Company::where('id',$id)->delete();
        return redirect('organization');
    }

}
