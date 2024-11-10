@php
    
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


@endphp