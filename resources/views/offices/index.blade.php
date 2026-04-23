@extends('app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Offices</h1>
        <a href="{{ route('offices.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add
            Office</a>
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
        @endif
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Office Name (BN)</th>
                    <th>Office Name (EN)</th>
                    <th>Upazila (EN)</th>
                    <th>Upazila (BN)</th>
                    <th>District (EN)</th>
                    <th>District (BN)</th>
                    <th>Geo Code</th>
                    <th>Office Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offices as $office)
                    <tr>
                        <td>{{ $office->id }}</td>
                        <td>{{ $office->office_name_bn }}</td>
                        <td>{{ $office->office_name_en }}</td>
                        <td>{{ $office->upazila_en }}</td>
                        <td>{{ $office->upazila_bn }}</td>
                        <td>{{ $office->district_en }}</td>
                        <td>{{ $office->district_bn }}</td>
                        <td>{{ $office->geo_code }}</td>
                        <td>{{ $office->office_code }}</td>
                        <td>
                            <a href="{{ route('offices.edit', $office) }}" class="text-blue-500">Edit</a>
                            <form action="{{ route('offices.destroy', $office) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 ml-2"
                                    onclick="return confirm('Delete this office?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
