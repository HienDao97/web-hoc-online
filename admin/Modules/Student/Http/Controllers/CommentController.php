<?php

namespace Modules\Student\Http\Controllers;

use App\Models\KMsg;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Student\Entities\Comment;
use Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $comments = Comment::paginate(10);
        return view('student::comment.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('student::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('student::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id, Request $request)
    {
        if ($request->isMethod('post')) {
            $params = $request->all();
            // Save project
            try {
                $result = new KMsg();

                $validatorArray = [
                    'public' => 'required',
                ];
                $validator = Validator::make($params, $validatorArray);
                if ($validator->fails()) {
                    $result->message = $validator->messages();
                    $result->result = KMsg::RESULT_ERROR;
                    return \response()->json($result);
                }
                //dd($params);

                $item = Comment::where('id', $id)->first();
                $item->public = $params['public'];
                //dd($item);
                $item->save();
                $result->message = "Sửa comment thành công";
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (Exception $ex) {
                $result->message = [$ex->getMessage()];
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json(["Some thing was wrong"]);
            }

        } else {
            $item = Comment::where('id', $id)->first();
            return view('student::comment.edit', compact('item'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
