<div class="flex text-white justify-between gap-12">
    <div class="sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
{{--        <div wire:loading>--}}
{{--            <p>Deleting student...</p>--}}
{{--        </div>--}}
        <h1 class="pb-2 text-xl">Classrooms</h1>
        <div>
            <form action="/submit" method="post" wire:submit="create_user">
                <label for="name">Name :</label><br>
                <input type="text" id="name" wire:model="new_name" required class="rounded-lg mb-2 text-black"><br>

                <label for="email">Email :</label><br>
                <input type="text" id="email" wire:model="new_email" required class="rounded-lg mb-2 text-black"><br>

                <label for="classroom">Class :</label><br>
                <select id="classroom" wire:model="new_classroom" required class="rounded-lg mb-4 text-black">
                    @foreach($classrooms as $class)
                        <option value="{{ $class->id }}">{{ $class->label }}</option>
                    @endforeach
                </select><br>
                <button type="submit" class="bg-blue-400 rounded p-2 mb-4
                                                hover:bg-blue-600
                                                disabled:bg-gray-500
                                                disabled:cursor-not-allowed"
                                                wire:click="createStudent()">
                    Add
                </button>
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
    <div class="sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <h1 class="pb-2 text-xl">Students</h1>
        @foreach($students as $student)
            <p>{{ $student->name }}</p>
        @endforeach
    </div>
    <div class="sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <h1 class="pb-2 text-xl">Teachers</h1>
        @foreach($teachers as $teacher)
            <p>{{ $teacher->name }}</p>
        @endforeach
    </div>

    <livewire:user-search-bar :users="$students" />
    <livewire:user-search-bar :users="$teachers" />
</div>
