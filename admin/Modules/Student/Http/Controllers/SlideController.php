<?php

namespace Modules\Student\Http\Controllers;

use App\Models\KMsg;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Student\Entities\Slides;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;


class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $slides = Slides::whereNull('deleted_at')->paginate(10);
        return view('student::slide.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $params = $request->all();

            $validatorArray = [
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_height=500',
            ];
            $result = new KMsg();


            $validator = Validator::make($params, $validatorArray);
            if ($validator->fails()) {
                $result->message = $validator->messages();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

            // Save project
            try {
                if(!empty($request->hasFile('file'))){
                    $img = $request->file('file')->getClientOriginalName();
                    $request->file('file')->move('img/slide',$img);
                }
                Slides::create([
                    "images" => $img,
                    "created_at" => Carbon::now()
                ]);
                $result->message = "Tạo slide thành công";
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (Exception $ex) {
                $result->message = $ex->getMessage();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

        } else {
            return view('student::slide.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('course::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $params = $request->all();
            // Save project
            try {
                $result = new KMsg();
                $item = Slides::where('id', $id)->first();
                if(!empty($request->hasFile('file'))){
                    $validatorArray = [
                        'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_height=500',
                    ];
                    $validator = Validator::make($params, $validatorArray);
                    if ($validator->fails()) {
                        $result->message = $validator->messages();
                        $result->result = KMsg::RESULT_ERROR;
                        return \response()->json($result);
                    }
                    $img = $request->file('file')->getClientOriginalName();
                    $request->file('file')->move('img/slide',$img);
                    $item->images = $img;
                    $item->save();
                }
                $result->message = "Sửa slide thành công";
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (Exception $ex) {
                $result->message = [$ex->getMessage()];
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json(["Some thing was wrong"]);
            }

        } else {
            $item = Slides::where('id', $id)->first();
            return view('student::slide.edit', compact('item'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id){
        $result = Slides::where('id', $id)->first();
        if ($result) {
            $result->deleted_at = Carbon::now();
            $result->save();

            return redirect(route('slide.index'))->with('messages','Xoá slide thành công');
        } else {
            return redirect(route('slide.index'))->withErrors(["Không tồn tại slide này"]);
        }
    }

}
