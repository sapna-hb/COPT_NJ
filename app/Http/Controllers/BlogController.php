<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Therapy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function BlogDetails()
    {
        return view('admin.blog_details');
    }
    public function BlogDetailList(Request $request)
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
            0 => 'blogs.id',
            1 => DB::raw('ROW_NUMBER() OVER(ORDER BY blogs.id ASC) as no'),
            2 => 'blogs.image',
            3 => 'blogs.name',
            3 => 'blogs.date',
        ];

        $columnName = $columns[$columnIndex] ?? 'blogs.id';

        // Build the query
        $query = DB::table('blogs')
            ->select([
                'blogs.id as id',
                DB::raw('ROW_NUMBER() OVER(ORDER BY blogs.id ASC) as no'),
                'blogs.name as title',
                'blogs.image as image',
                'blogs.date as date',
            ])
            ->where('blogs.is_deleted', 0);

        // Apply search filter
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('blogs.name', 'like', '%' . $searchValue . '%');
            });
        }

        // Get total records before applying pagination
        $totalRecords = $query->count();

        // Fetch records with pagination
        $blogs = $query->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        // Prepare data for response
        $data_arr = [];
        foreach ($blogs as $blog) {
            $data_arr[] = [
                "no" => $blog->no,
                "image" => '<img src="' . Storage::url($blog->image) . '" style="width: 100px; height: 100px; border-radius: 50%; border: 1px solid #ccc">',
                "title" => $blog->title,
                "date" => $blog->date,

                "action" => '<div class="btn-group btn-group-sm">
                <a href="javascript:void(0)" onclick="window.location.href=\'' . route('admin.BlogDetailEdit', ['id' => $blog->id]) . '\'" class="btn btn-primary btn-sm">
                    <i class="fas fa-pen"></i>
                </a>&nbsp;
                <a href="javascript:void(0)" onclick="deleteblogdetails(' . $blog->id . ')" class="btn btn-danger btn-sm">
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
    public function BlogDetailAdd()
    {
        $tags = Therapy::all();
        return view('admin.blog_details_add', compact('tags'));
    }
    public function BlogDetailAddOp(Request $request)
    {
        // dd($request->all());
        // "title" => "testing"
        // "category_name" => array:2 [
        //   0 => "2"
        //   1 => "3"
        // ]
        // "date" => "2025-03-10"
        // "description" => "<p>demon </p>"
        // "image" =>

        $addblog = new Blog();
        $addblog->name = $request->title;
        $addblog->blog_details = $request->description;
        $addblog->date = $request->date;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/blog');
            $addblog->image = 'public/blog/' . basename($imagePath);
        }
        $addblog->category_id = implode(',', $request->category_name);

        $addblog->save();
    }
    public function BlogDetailDelete(Request $request)
    {
        $therapy = Blog::find($request->id);
        if ($therapy->delete()) {
            return response()->json(['success' => '
            200', 'message' => 'Therapy deleted successfully!']);
        } else {
            return response()->json(['error' => 'An error occurred while deleting the therapy.']);
        }
    }
    public function BlogDetailEdit($id)
    {
        $blog = Blog::find($id);
        $tags = Therapy::all();
        return view('admin.blog_details_edit', compact('blog', 'tags'));
    }
    public function BlogDetailEditOp(Request $request)
    {
        //         dd($request->all());
        //         "id" => "1"
        //   "title" => "testing"
        //   "category_name" => array:2 [
        //     0 => "3"
        //     1 => "4"
        //   ]
        //   "date" => "2025-03-10"
        //   "description" => "<p>demon</p>"
        //   "image" =>

        $editblog = Blog::find($request->id);
        $editblog->name = $request->title;
        $editblog->blog_details = $request->description;
        $editblog->date = $request->date;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/blog');
            $editblog->image = 'public/blog/' . basename($imagePath);
        }
        $editblog->category_id = implode(',', $request->category_name);
        $editblog->save();
        return response()->json(['success' => '200', 'message' => 'Therapy updated successfully!']);
    }
}