<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Job;
use App\Models\Order;
use App\Models\WebsiteInfo;
use App\Models\Worker;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $countries = Country::all();
        $jobs = Job::all();
        $website_info = WebsiteInfo::find(1);
        $query = Worker::query();
        // Define an array of fields to search in
        $fields = [
            'country_id' => $request->input('country'),
            'job_id' => $request->input('job'),
            'category_id' => $request->input('category'),
            'experience' => $request->input('experience'),
            'religion' => $request->input('religion'),
        ];
        foreach ($fields as $field => $value) {
            if ($value) {
                $query->where($field, $value);
            }
        }
        $workers = $query->get();
        return view('Front.index', compact('website_info', 'workers', 'jobs', 'countries', 'categories'));
    }
public function send_request(){
    $website_info = WebsiteInfo::find(1);
    return view('Front.send_request',compact('website_info'));
}
public function submit_request(Request $request){
    $validatedData = $request->validate([
        'name' => 'required',
        'identity_id' => 'required',
        'date_of_birth_hijri' => 'required',
        'phone' => 'required',
        'verification_code' => 'required', // Make it required if the checkbox is checked
        'visa_number' => 'required_if:hasVisaCheckbox,on', // Required if the checkbox is checked
        'visa_date_hijri' => 'required_if:hasVisaCheckbox,on', // Required if the checkbox is checked
        'border_number' => 'required_if:hasVisaCheckbox,on', // Required if the checkbox is checked
        'work_place' => 'required_if:hasVisaCheckbox,on', // Required if the checkbox is checked
        'work_city' => 'required_if:hasVisaCheckbox,on', // Required if the checkbox is checked
        'address' => 'required_if:hasVisaCheckbox,on', // Required if the checkbox is checked
        'relative_name' => 'required_if:hasVisaCheckbox,on', // Required if the checkbox is checked
        'relative_type' => 'required_if:hasVisaCheckbox,on', // Required if the checkbox is checked
        'relative_phone' => 'required_if:hasVisaCheckbox,on', // Required if the checkbox is checked
        'employer' => 'required_if:hasVisaCheckbox,on', // Required if the checkbox is checked
        'num_floors' => 'required_if:hasVisaCheckbox,on', // Required if the checkbox is checked
        'num_rooms' => 'required_if:hasVisaCheckbox,on', // Required if the checkbox is checked
        'num_family_members' => 'required_if:hasVisaCheckbox,on', // Required if the checkbox is checked
        'notes' => 'required_if:hasVisaCheckbox,0', // Required if the checkbox is unchecked
        // Add validation rules for other fields as needed
        // Create a new request record
        ]);

        $order = new Order();
    $order->fill($validatedData);
    $order->save();

    // You can add more logic here, such as sending email notifications, etc.

    // Redirect back to the form with a success message
    return redirect()->route('/')->with('success', 'Request submitted successfully!');

}
    public function home()
    {
        return view('home');
    }
}
