@foreach ($penelitian as $item)
    <div>
        <p>Judul: {{ $item->judul }}</p>
        <p>Status Penelitian:
            {{ $item->statusPenelitian->statusPenelitianKey->name }} {{ $item->statusPenelitian->name }} </p>
        <p>Updated At: {{ $item->updated_at }}</p>
        <p>Feedback: {{ $item->feedback }}</p>
    </div>
@endforeach
