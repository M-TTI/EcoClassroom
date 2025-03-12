{{--<form wire:submit.prevent="submitGrades">--}}
{{--    <div class="flex text-white">--}}
{{--        <div class="mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden flex-grow rounded-lg">--}}
{{--            @forelse($classroom->students as $student)--}}
{{--                <div class="flex items-center justify-between mb-4">--}}
{{--                    <label for="grade-{{ $student->id }}" class="mr-4">{{ $student->name }}</label>--}}
{{--                    <select id="grade-{{ $student->id }}" wire:model="grades.{{ $student->id }}" class="rounded-lg text-black" required>--}}
{{--                        <option value="">Mode de transport</option>--}}
{{--                        <option value="1">En voiture</option>--}}
{{--                        <option value="2">En bus</option>--}}
{{--                        <option value="3">En covoiturage</option>--}}
{{--                        <option value="4">A vélo</option>--}}
{{--                        <option value="5">A pied</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            @empty--}}
{{--                <div>No students in this classroom.</div>--}}
{{--            @endforelse--}}
{{--            <button type="submit" class="bg-blue-400 rounded p-2 mt-4 hover:bg-blue-600 disabled:bg-gray-500 disabled:cursor-not-allowed">--}}
{{--                Submit Grades--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</form>--}}
<style>
    .student-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .student-name {
        width: 200px; /* Adjust the width as needed */
        flex-shrink: 0;
    }
    .student-grades {
        flex-grow: 1;
        text-align: right;
    }
</style>

<form wire:submit.prevent="submitGrades">
    <div class="flex text-white">
        <div class="mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden flex-grow rounded-lg">
            @forelse($classroom->students as $student)
                <div class="student-info mb-4">
                    <div class="student-name">
                        {{ $student->name }}
                    </div>
                    <div class="student-grades text-gray-400 ml-2">
                        Moyenne: {{ $student->average ?? 'N/A' }}, Derniere note: {{ $student->last_grade ?? 'N/A' }}
                    </div>
                    <select id="grade-{{ $student->id }}" wire:model="grades.{{ $student->id }}" class="rounded-lg text-black" required>
                        <option value="">Mode de transport</option>
                        <option value="1">En voiture</option>
                        <option value="2">En bus</option>
                        <option value="3">En covoiturage</option>
                        <option value="4">A vélo</option>
                        <option value="5">A pied</option>
                    </select>
                </div>
            @empty
                <div>No students in this classroom.</div>
            @endforelse
            <button type="submit" class="bg-blue-400 rounded p-2 mt-4 hover:bg-blue-600 disabled:bg-gray-500 disabled:cursor-not-allowed">
                Submit Grades
            </button>
        </div>
    </div>
</form>
