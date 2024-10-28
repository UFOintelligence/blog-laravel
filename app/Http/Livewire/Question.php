<?php

namespace App\Http\Livewire;

use App\Models\Question as ModelsQuestion;
use Livewire\Component;
use App\Models\Answer as ModelsAnswer;

class Question extends Component
{

    public $model;
    public $message;
    public $questions;
    public $question_edit = [
        'id' => null,
        'body' =>  ''
    ];


    public function mount(){
        $this->getQuestions();
    }


    public function getQuestions()
    {

        $this->questions = $this->model
        ->questions()
        ->orderBy('created_at', 'desc')
        ->get();



    }



    public function store()
    {
        $this->validate([
            'message' => 'required'
        ]);

        $this->model->questions()->create([
            'body' => $this->message,
            'user_id'=> auth()->id()
        ]);

        $this->getQuestions();


        $this->message = '';


    }

    public function edit($questionId){
        $question = ModelsQuestion::find($questionId);
        $this->question_edit = [
            'id' => $question->id,
            'body' => $question->body
        ];
    }

  

    public function destroy($questionId)
{
    // Elimina las respuestas relacionadas con la pregunta
    ModelsAnswer::where('question_id', $questionId)->delete();

    // Luego, elimina la pregunta
    $question = ModelsQuestion::find($questionId);

    // Verifica si la pregunta existe antes de eliminar
    if ($question) {
        $question->delete();
    }

    // Refresca la lista de preguntas y resetea el estado
    $this->getQuestions();
    $this->reset('question_edit');
}


    public function cancel(){

        $this->reset('question_edit');


    }


    public function render()
    {
        return view('livewire.question');
    }
}
