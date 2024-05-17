@foreach ($output as $item)
    <div>
        <p>Judul: {{ $item->judul }}</p>
        <p>tanggal update:
            {{ $item->statusPenelitian->statusPenelitianKey->name }} {{ $item->statusPenelitian->name }} </p>
        <p>Updated At: {{ $item->updated_at }}</p>
        <p>Feedback: {{ $item->feedback }}</p>
    </div>
@endforeach
