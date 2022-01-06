<?php
namespace App\Repositories;

use App\Http\Requests\AnswerRequest;
use App\Models\Answer;
use Illuminate\Http\Client\Request;

class AnswerRepository
{
    public function getAll()
    {
        $answer = Answer::all();
        return $answer;
    }

    public function getById($id)
    {
        $answer = Answer::findOrFail($id);
        return $answer;

    }

    public function update(Request $request, $id)
    {
        $data = Answer::findOrFail($id);
        $data = $request->


    }

    public function destroy($id)
    {
        $answer = Answer::findOrFail($id);
        $answer->delete();

    }

}
