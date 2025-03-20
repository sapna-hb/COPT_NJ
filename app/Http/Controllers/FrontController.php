<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\Blog;
use App\Models\cause;
use App\Models\Faq;
use App\Models\Team;
use App\Models\Therapy;
use App\Models\TherapyDetail;
use App\Models\Treatment;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view("front.index");
    }
    public function appointment()
    {
        return view("front.appointment");
    }
    public function contact()
    {
        return view("front.contact");
    }

    public function contactUs(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits_between:10,15',
            'subject' => 'required',
            'message' => 'required|string|max:1000',
        ]);

        $details = [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "subject" => $request->subject,
            "message" => $request->message,
            'template' => 'emails.contactus_mail',
        ];

        dispatch(new SendEmailJob($details));

        return redirect()->back()->with('success', 'Your Message has been sent successfully!');
    }

    public function ourpractice()
    {
        return view("front.our-practice");
    }
    public function ourlocations()
    {
        return view("front.our-locations");
    }
    public function ourteam()
    {
        $teams = Team::all();
        return view("front.our-team", compact("teams"));
    }

    public function ourteamop($id)
    {
        $team = Team::find($id);
        return view("front.team-detail", compact("team"));
    }
    public function career()
    {
        return view("front.career");
    }
    public function sendmail(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits_between:10,15',
            'date' => 'required|date',
            'service_time' => 'required',
            'service_refer' => 'required|in:Physician referral,Google,Facebook,Friend',
            'message' => 'required|string|max:1000',
        ]);

        $details = [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "date" => $request->date,
            "service_time" => $request->service_time,
            "service_refer" => $request->service_refer,
            "subject" => 'Request Appointment by ' . $request->name,
            "message" => $request->message,
            'template' => 'emails.appointment_mail',
        ];

        dispatch(new SendEmailJob($details));

        return redirect()->back()->with('success', 'Appointment request sent successfully!');
    }

    public function viewTherapyTreatment($therapy_name)
    {
        $therapy_id = Therapy::where('therapy_name', $therapy_name)->value('id');
        $therapy_details = TherapyDetail::where('therapy_id', $therapy_id)->first();
        return view("front.how_we_treat", compact('therapy_name', 'therapy_details'));
    }


    public function viewTreatmentNames($treatment_name)
    {
        $treatments = Treatment::where('treatment_name', $treatment_name)->first();

        $treatment_causes_exists = cause::where('treatment_id', $treatments->id)->exists();
        if ($treatment_causes_exists) {
            $treatment_causes = cause::where('treatment_id', $treatments->id)->get();
        } else {
            $treatment_causes = NULL;
        }
        return view("front.what_we_treat", compact('treatments', 'treatment_name', 'treatment_causes'));
    }

    public function healthBlog()
    {
        $healthBlogs = Blog::where('is_active', 1)
            ->where('is_deleted', 0)
            ->paginate(6);

        $popularBlogs = Blog::where('is_active', 1)
            ->where('is_deleted', 0)
            ->inRandomOrder() // Fetch random records
            ->limit(3)
            ->get();

        return view("front.blogs", compact('healthBlogs', 'popularBlogs'));
    }


    public function blogDetails($id)
    {
        $blogDetails = Blog::where('id', $id)->first();
        $popularBlogs = Blog::where('is_active', 1)
            ->where('is_deleted', 0)
            ->inRandomOrder() // Fetch random records
            ->limit(3)
            ->get();
        return view("front.blog-details", compact('blogDetails', 'popularBlogs'));
    }

    public function patientInfo()
    {
        return view("front.patient-info");
    }

    public function refererAFriend()
    {
        return view("front.refer-a-friend");
    }


    public function faq()
    {
        $faqs = Faq::where('is_active', 1)->where('is_deleted', 0)->get();

        return view("front.faq", compact('faqs'));
    }

    public function contactop(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits_between:10,15',
            'date' => 'required|date',
            'service_time' => 'required',
            'service_refer' => 'required|in:Physician referral,Google,Facebook,Friend',
            'message' => 'required|string|max:1000',
        ]);

        $details = [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "date" => $request->date,
            "service_time" => $request->service_time,
            "service_refer" => $request->service_refer,
            "message" => $request->message,
        ];

        dispatch(new SendEmailJob($details));

        return redirect()->back()->with('success', 'Appointment request sent successfully!');
    }


    public function leaveComment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comments' => 'required|string',
        ]);

        $details = [
            "blog" => $request->blog,
            "name" => $request->name,
            "email" => $request->email,
            "message" => $request->comments,
            'template' => 'emails.leave_comment_mail',
        ];

        dispatch(new SendEmailJob($details));

        return redirect()->back()->with('success', 'Your Comments has been sent successfully!');
    }
}
