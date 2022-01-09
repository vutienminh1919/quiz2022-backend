<?php

namespace App\Http\Controllers;

use App\Services\AnswerService;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    protected $answerService;

    public function __construct(AnswerService $answerService) {
        $this->answerService = $answerService;
    }

    public function destroy($id)
    {
        $this->answerService->destroy($id);
        return response()->json(['message'=>'Xóa thành công'], 200);
    }
}
