<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuestionController extends Controller
{
	use AuthorizesRequests;

    public static function middleware(): array
	{
	    return [
	        new Middleware('auth', except: ['show']),
	    ];
	}

    public function store(StoreQuestionRequest $request): RedirectResponse
    {
        $question = Question::create([
            'title'   => $request->input('title'),
            'body'    => $request->input('body'),
            'user_id' => $request->user()->id,
        ]);

        return redirect()
            ->route('questions.show', $question)
            ->with('status', 'Pregunta creada correctamente.');
    }

    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }

    public function edit(Question $question)
    {
        $this->authorize('update', $question);
        return view('questions.edit', compact('question'));
    }

    public function update(UpdateQuestionRequest $request, Question $question): RedirectResponse
    {
        $this->authorize('update', $question);
        $question->update($request->only(['title','body']));
        return redirect()
            ->route('questions.show', $question)
            ->with('status', 'Pregunta actualizada correctamente.');
    }

    public function destroy(Request $request, Question $question): RedirectResponse
    {
        $this->authorize('delete', $question);
        $question->delete();
        return redirect()->route('home')->with('status', 'Pregunta eliminada correctamente.');
    }
}
