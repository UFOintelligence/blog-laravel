<?php

namespace App\Http\Livewire;

use App\Events\CommentCreated;
use App\Models\Question as ModelsQuestion;
use Livewire\Component;
use App\Models\Answer as ModelsAnswer;

class Question extends Component
{

    public $model;
    public $message;
    public $limit = 10;
    public $totalComments;
    public $question_edit = [
        'id' => null,
        'body' =>  ''
    ];


  

      // Propiedad computada para questions
      public function getQuestionsProperty()
      { 
          $this->totalComments = $this->model->questions()->count();
  
          return $this->model
              ->questions()
              ->orderBy('created_at', 'desc')
              ->take($this->limit)
              ->get();
      }
      public function update()
      {
          $this->validate([
              'question_edit.body' => 'required',
          ]);
  
          $question = ModelsQuestion::find($this->question_edit['id']);
  
          if ($question) {
              $question->update([
                  'body' => $this->question_edit['body'],
                  'user_id' => auth()->id(),
              ]);
  
              $this->reset('question_edit');
          } else {
              session()->flash('error', 'No se encontró la respuesta para actualizar.');
          }
      }
    public function loadMore()
    {
        // Incrementa el límite de comentarios y recarga la lista
        $this->limit += 10;
        
    }


    public function store()
    {
        $this->validate([
            'message' => 'required'
        ]);

       $question = $this->model->questions()->create([
            'body' => $this->message,
            'user_id'=> auth()->id()
        ]);

        CommentCreated::dispatch($question);

        


        $this->message = '';
    // Actualiza el total de comentarios
    $this->totalComments = $this->model->questions()->count();


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

        // Actualiza el total de comentarios
        $this->totalComments = $this->model->questions()->count();

    // Refresca la lista de preguntas y resetea el estado
    
    $this->reset('question_edit');
}


    public function cancel(){

        $this->reset('question_edit');


    }


    public function render()
    {
            // Actualiza el total de comentarios
    $this->totalComments = $this->model->questions()->count();

        return view('livewire.question');
    }
}
