<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use Illuminate\Http\Request;

class AjaxHandlerController extends Controller
{
    public function getMarksById(Request $request)
    {
        $markId = $request->markId;
        $marks = Mark::where('id', $markId)->first();

        $response_data = [
            'marks_id' => $marks->id,
            'quizes_marks' => unserialize($marks->quizes_marks),
            'assignment_marks' => unserialize($marks->assignment_marks),
            'class_marks' => unserialize($marks->class_marks)
        ];

        echo collect($response_data)->toJson();
    }

}
