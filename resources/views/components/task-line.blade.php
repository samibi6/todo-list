<div class="flex justify-between my-2 p-2 rounded-md bg-zinc-200 hover:bg-zinc-400 transition">
    <form method="POST" action="{{ route('dashboard.update', $task) }}" id="check"
        class="w-full flex justify-center items-center">
        @csrf
        @method('PATCH')
        <input type="checkbox" class="hover:cursor-pointer" name="completed" id="completed-{{ $task->id }}"
            onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
        <label for="completed-{{ $task->id }}"
            class="hover:cursor-pointer ml-2 w-full {{ $task->completed ? 'line-through' : '' }}">{{ $task->description }}</label>
    </form>
    {{-- <form method="POST" action="{{ route('dashboard.delete', $task->id) }}">
        @csrf
        @method('DELETE') --}}
    @can('delete', $task)
        <button x-data="{ id: {{ $task->id }} }"
            x-on:click.prevent="window.selected = id; $dispatch('open-modal', 'confirm-task-deletion');"
            type="submit"><x-ri-delete-bin-2-fill
                class="h-8 w-8 inline-block text-red-500 bg-white rounded-md p-2 hover:bg-red-500 hover:text-black transition" /></button>
    @endcan
    {{-- </form> --}}
</div>
