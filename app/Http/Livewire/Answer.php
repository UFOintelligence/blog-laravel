<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Answer as ModelsAnswer;

class Answer extends Component
{
    public $question;
    public $answers;

    public $answers_created = [
        'open' => false,
        'body' => '',
    ];
    
    public $answer_edit = [
        'id' => null,
        'body' => '',
    ];
    
    public $answer_to_answer = [
        'id' => null,
        'body' => '',
    ];

    public function mount()

    {
        $this->getAnswers();
    }

    public function getAnswers()
    {
        $this->answers = $this->question->answers()->orderBy('id', 'asc')->get();
    }

    public function edit($answerId)
    {
        $answer = ModelsAnswer::find($answerId);

        if ($answer) {
            $this->answer_edit = [
                'id' => $answer->id,
                'body' => $answer->body,
            ];
        } else {
            session()->flash('error', 'No se encontró la respuesta para editar.');
        }
    }

    public function update()
    {
        $this->validate([
            'answer_edit.body' => 'required',
        ]);

        $answer = ModelsAnswer::find($this->answer_edit['id']);

        if ($answer) {
            $answer->update([
                'body' => $this->answer_edit['body'],
                'user_id' => auth()->id(),
            ]);

            $this->getAnswers();
            $this->reset('answer_edit');
        } else {
            session()->flash('error', 'No se encontró la respuesta para actualizar.');
        }
    }

    public function store()
    {
        $this->validate([
            'answers_created.body' => 'required',
        ]);

        $this->question->answers()->create([
            'body' => $this->answers_created['body'],
            'user_id' => auth()->id(),
        ]);

        $this->getAnswers();
        $this->reset('answers_created');
    }

    public function storeReply()
    {
        $this->validate([
            'answer_to_answer.body' => 'required',
        ]);
    
        ModelsAnswer::create([
            'body' => $this->answer_to_answer['body'],
            'user_id' => auth()->id(),
            'question_id' => $this->question->id,
            'parent_id' => $this->answer_to_answer['id'], // Aquí guardas el ID de la respuesta a la que se está respondiendo
        ]);
    
        $this->getAnswers();
        $this->reset('answer_to_answer');
    }
    
    
    public function destroy($answerId)
{
    $answer = ModelsAnswer::find($answerId);

    if ($answer) {
        // Elimina todas las respuestas hijas de la respuesta actual
        ModelsAnswer::where('parent_id', $answer->id)->delete();
        
        // Luego elimina la respuesta específica
        $answer->delete();

        // Vuelve a cargar las respuestas después de eliminar
        $this->getAnswers();

        // Mensaje de éxito
        session()->flash('success', 'Respuesta eliminada correctamente.');
    } else {
        // Maneja el caso en que no se encuentra la respuesta
        session()->flash('error', 'Respuesta no encontrada.');
    }
}

    public function cancel(){

        $this->reset('answer_edit');


    }
   

    public function render()
    {
        return view('livewire.answer');
    }
}
