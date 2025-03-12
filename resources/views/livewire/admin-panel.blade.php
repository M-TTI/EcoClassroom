<div class="flex text-white justify-between gap-12">
    <div class="sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
{{--        <div wire:loading>--}}
{{--            <p>Deleting student...</p>--}}
{{--        </div>--}}
        <h1 class="pb-2 text-xl">Classes</h1>

        <h1>Créer une Classe</h1>
        <form action="/submit" method="post" wire:submit="createClassroom()">
            <label for="label">Nom :</label><br>
            <input type="text" id="label" wire:model="new_label" required class="rounded-lg mb-2 text-black"><br>

            <label for="teacher">Professeur :</label><br>
            <select id="teacher" wire:model="new_teacher" required class="rounded-lg mb-4 text-black">
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select><br>
            <button type="submit" class="bg-blue-400 rounded p-2 mb-4
                                            hover:bg-blue-600
                                            disabled:bg-gray-500
                                            disabled:cursor-not-allowed">
                Ajouter
            </button>
        </form>

        <h1>Ajouter un Eleve à une classe</h1>
        <form action="/submit" method="post" >
            <label for="student">Elève :</label><br>
            <select id="student" wire:model="new_student" required class="rounded-lg mb-2 text-black">
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select><br>
            <label for="classroom">Classe :</label><br>
            <select id="classroom" wire:model="selectedClassroom" required class="rounded-lg mb-4 text-black">
                @foreach($classrooms as $class)
                    <option value="{{ $class->id }}">{{ $class->label }}</option>
                @endforeach
            </select><br>
            <button type="submit" class="bg-blue-400 rounded p-2 mb-4
                            hover:bg-blue-600
                            disabled:bg-gray-500
                            disabled:cursor-not-allowed"
                            wire:click="addStudentToClass({{ $selectedStudent, $selectedClassroom }})"
                            wire:loading.attr="disabled"
                            wire:target="addStudentToClass({{ $selectedStudent, $selectedClassroom }})">
                Ajouter
            </button>

        @forelse($classrooms as $class)
            <h1>{{ $class->label." :" }}</h1>
            @foreach($class->students as $student)
                <p class="mb-2">
                    {{ $student->name }}
                    <button class="bg-red-600 rounded-lg px-2 py-1
                            hover:bg-red-800
                            disabled:bg-gray-500
                            disabled:cursor-not-allowed"
                            wire:click="removeStudentFromClass({{ $student }})"
                            wire:loading.attr="disabled"
                            wire:target="removeStudentFromClass({{ $student }})">
                        Retirer
                    </button>
                </p>
            @endforeach
        @empty
            <p>Pas de classes</p>
        @endforelse
    </div>
    <div class="sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <h1 class="pb-2 text-xl">Elèves</h1>

        <div>
            <h1>Créer un compte élève</h1>
            <form action="/submit" method="post" wire:submit="createStudent()">
                <label for="name">Nom :</label><br>
                <input type="text" id="name" wire:model="new_name" required class="rounded-lg mb-2 text-black"><br>

                <label for="email">Email :</label><br>
                <input type="text" id="email" wire:model="new_email" required class="rounded-lg mb-2 text-black"><br>

                <label for="password">Mot de Passe :</label><br>
                <input type="password" id="password" wire:model="new_password" required class="rounded-lg mb-2 text-black"><br>

                <button type="submit" class="bg-blue-400 rounded p-2 mb-4
                                                hover:bg-blue-600
                                                disabled:bg-gray-500
                                                disabled:cursor-not-allowed">
                    Ajouter
                </button>
            </form>
        </div>


        <br><h1 class="mb-2">Supprimer un compte élève</h1>

        <livewire:user-search-bar :users="$students" />
        <button type="submit" class="bg-red-600 rounded p-2
                                        hover:bg-red-800"
                                        wire:click="deleteStudent({{ $selectedUser }})">
            Supprimer
        </button>

        @foreach($students as $student)
            <p>{{ $student->name }}</p>
        @endforeach
    </div>
    <div class="sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <h1 class="pb-2 text-xl">Professeurs</h1>

        <div>
            <h1>Créer un compte professeur</h1>
            <form action="/submit" method="post" wire:submit="createTeacher()">
                <label for="name">Nom :</label><br>
                <input type="text" id="name" wire:model="new_name" required class="rounded-lg mb-2 text-black"><br>

                <label for="email">Email :</label><br>
                <input type="text" id="email" wire:model="new_email" required class="rounded-lg mb-2 text-black"><br>

                <label for="password">Mot de Passe :</label><br>
                <input type="password" id="password" wire:model="new_password" required class="rounded-lg mb-2 text-black"><br>

                <button type="submit" class="bg-blue-400 rounded p-2 mb-4
                                                hover:bg-blue-600
                                                disabled:bg-gray-500
                                                disabled:cursor-not-allowed">
                    Ajouter
                </button>
            </form>
        </div>

        <br><h1 class="mb-2">Supprimer un compte professeur</h1>
        <form action="/submit" method="post" wire:submit="deleteTeacher({{ $selectedUser }})">
            <livewire:user-search-bar :users="$teachers" />
            <button type="submit" class="bg-red-600 rounded p-2
                                            hover:bg-red-800">
                Supprimer
            </button>
        </form>
        @foreach($teachers as $teacher)
            <p>{{ $teacher->name }}</p>
        @endforeach
    </div>

</div>
