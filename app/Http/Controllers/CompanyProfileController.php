<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function index() {
        $companyProfiles = CompanyProfile::all();
        return view('backend.pages.company-profile.index', compact(
            'companyProfiles',
        ));
    }

    public function create() {}

    public function store(Request $request) {}

    public function show($id) {}

    public function edit($id) {}

    public function update(Request $request, $id) {
        try {
            $companyProfile = CompanyProfile::find($id);
    
            $request->validate([
                'title' => 'required',
                'subtitle' => 'required',
                'name' => 'required',
                'description' => 'required',
            ]);
    
            $array = [
                'title' => $request['title'],
                'subtitle' => $request['subtitle'],
                'name' => $request['name'],
                'description' => $request['description'],
                'instagram' => $request['instagram'],
                'linkedin' => $request['linkedin'],
                'tiktok' => $request['tiktok'],
                'facebook' => $request['facebook'],
            ];


            if ($request->hasFile('image_banner_left')) {
                $array['image_banner_left'] = $this->handleFileUpload($request->file('image_banner_left'), 'company-profile/');
            }
            if ($request->hasFile('image_banner_right')) {
                $array['image_banner_right'] = $this->handleFileUpload($request->file('image_banner_right'), 'company-profile/');
            }
            if ($request->hasFile('image')) {
                $array['image'] = $this->handleFileUpload($request->file('image'), 'company-profile/');
            }

            $companyProfile->update($array);
    
            return redirect()->route('admin.company-profile.index')->with('success', 'Success');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id) {}

    private function handleFileUpload($file, $path)
    {
        if ($file) {
            $fileName = date('YmdHis') . rand(999999999, 9999999999) . $file->getClientOriginalExtension();
            $file->move(public_path($path), $fileName);
            return $fileName;
        }
        return null;
    }
}
