<?php

namespace App\Observers;


use App\Models\Type;
use App\Notifications\NewBudget;
use Illuminate\Support\Facades\Notification;

class TypeObservador
{
    public function created(Type $modelo)
    {
        // Lógica a ser executada após a criação de um novo registro
    }

    public function updated(Type $modelo)
    {
        // Lógica a ser executada após a atualização de um registro
    }

    public function deleted(Type $modelo)
    {

        $admin = 'noreplay@noreplay';

        Notification::route('mail', $admin)
            ->notify(new NewBudget());

        return true;
    }
}
