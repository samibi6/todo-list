<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mx-auto dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-fit">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('dashboard.add') }}" class="mb-4">
                        @csrf
                        <label for="description" class="font-bold">Ajouter une tâche:</label>
                        <input type="text" name="description" id="description">
                        <input type="submit" value="Ajouter"
                            class="hover:cursor-pointer bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-800">
                    </form>
                    @foreach ($tasks as $task)
                        <x-task-line :task="$task" />
                    @endforeach
                </div>
            </div>
        </div>
        <x-modal name="confirm-task-deletion" focusable>
            <form method="post" onsubmit="event.target.action= '/dashboard/' + window.selected" class="p-6">
                @csrf
                @method('DELETE')

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Êtes-vous sûr de vouloir supprimer cette tâche ?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Cette action est irréversible. Toutes les données seront supprimées.
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Annuler
                    </x-secondary-button>

                    <x-danger-button class="ml-3" type="submit">
                        Supprimer
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
