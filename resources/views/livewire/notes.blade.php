<div class="flex text-white">
    @forelse($classroom->students as $student)
        <div>{{ $student->name }}</div>
    @empty
        <div>No students in this classroom.</div>
    @endforelse
</div>
