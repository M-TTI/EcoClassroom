<div class="text-white">
    <div wire:loading>
        <p>Deleting student...</p>
    </div>
    <div>
        <form action="/submit" method="post" wire:submit="create_user">
            <label for="name">Name :</label><br>
            <input type="text" id="name" name="name" required class="rounded-lg mb-2 text-black"><br>

            <label for="email">Class :</label><br>
            <select id="email" name="email" required class="rounded-lg mb-4 text-black">
                @foreach($classrooms as $class)
                    <option value="{{ $class }}">{{ $class->label }}</option>
                @endforeach
            </select><br>
            <button type="submit" class="bg-blue-400 rounded p-2 mb-4">Add</button>
        </form>
    </div>
    <h1>{{ $user->name."'s Classes :" }}</h1>
    @forelse($classrooms as $class)
        <p>{{ $class->label." :" }}</p>
        @foreach($class->students as $student)
            <p class="mb-2">
                {{ $student->name }}
                <button class="bg-red-600 rounded-lg px-2 py-1
                        hover:bg-red-800
                        disabled:bg-gray-500
                        disabled:cursor-not-allowed"
                        wire:click="deleteStudent({{ $student }})"
                        wire:loading.attr="disabled"
                        wire:target="deleteStudent({{ $student }})">
                    Delete
                </button>
            </p>
        @endforeach
    @empty
        <p>No classrooms</p>
    @endforelse
</div>
