<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    //
    public function faqs()
    {
        return view('admin.faq');
    }
    public function faqAdd()
    {
        return view('admin.faq_add');
    }
    public function faqDelete(Request $request)
    {
        $team = Faq::find($request->id);
        if ($team) {
            $team->delete();
            return response()->json(['success' => '200', 'message' => 'data deleted successfully!']);
        } else {
            return response()->json(['success' => '404', 'message' => 'data not found']);
        }
    }
    public function faqList(Request $request)
    {
        $draw = filter_var($request->get('draw'), FILTER_VALIDATE_INT);
        $start = filter_var($request->get('start'), FILTER_VALIDATE_INT);
        $rowperpage = filter_var($request->get('length'), FILTER_VALIDATE_INT);

        if ($draw === false || $start === false || $rowperpage === false) {
            return response()->json(['error' => 'Invalid parameters']);
        }

        $order_arr = $request->get('order', []);
        $searchValue = $request->get('search')['value'] ?? '';

        if (!is_array($order_arr) || count($order_arr) === 0) {
            return response()->json(['error' => 'Invalid order parameter']);
        }

        $columnIndex = $order_arr[0]['column'];
        $columnSortOrder = $order_arr[0]['dir'] ?? 'asc';

        $columns = [
            0 => 'id',
            1 => DB::raw('ROW_NUMBER() OVER(ORDER BY id ASC) as no'),
            2 => 'question',
            3 => 'answer',
        ];

        $columnName = $columns[$columnIndex] ?? 'id';

        // Build the query
        $query = DB::table('faqs')
            ->select([
                'id',
                DB::raw('ROW_NUMBER() OVER(ORDER BY id ASC) as no'),
                'question',
                'answer',
            ])
            ->where('is_deleted', 0);

        // Apply search filter
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('question', 'like', '%' . $searchValue . '%');
            });
        }

        // Get total records before applying pagination
        $totalRecords = $query->count();

        // Fetch records with pagination
        $faqs = $query->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        // Prepare data for response
        $data_arr = [];
        foreach ($faqs as $faq) {
            $data_arr[] = [
                "no" => $faq->no,
                "question" => $faq->question,
                "answer" => $faq->answer,
                "action" => '
                    <a href="javascript:void(0)" onclick="deletefaq(' . $faq->id . ')" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>',

            ];
        }

        $response = [
            'draw' => $draw,
            'iTotalRecords' => $totalRecords,
            'iTotalDisplayRecords' => $totalRecords,
            'data' => $data_arr,
        ];

        return response()->json($response);
    }
    public function faqAddOp(Request $request)
    {
        //   dd($request->all());
        //   "fq_name" => "ghjkjknds"
        //   "fa_name" => "dsljlkjlkdf"
        $addteam = new Faq();
        $addteam->question = $request->fq_name;
        $addteam->answer = $request->fa_name;
        $addteam->save();
        return response()->json(['success' => 'FAQ Added Successfully']);
    }
}
