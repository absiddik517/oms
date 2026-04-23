@extends('app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Office</h1>
        <form action="{{ route('offices.update', $office) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label>Office Name (BN)</label>
                <input type="text" name="office_name_bn" class="border p-2 w-full"
                    value="{{ old('office_name_bn', $office->office_name_bn) }}" required>
            </div>
            <div>
                <label>Office Name (EN)</label>
                <input type="text" name="office_name_en" class="border p-2 w-full"
                    value="{{ old('office_name_en', $office->office_name_en) }}" required>
            </div>
            <div>
                <label>Upazila (EN)</label>
                <input type="text" name="upazila_en" class="border p-2 w-full"
                    value="{{ old('upazila_en', $office->upazila_en) }}" required>
            </div>
            <div>
                <label>Upazila (BN)</label>
                <input type="text" name="upazila_bn" class="border p-2 w-full"
                    value="{{ old('upazila_bn', $office->upazila_bn) }}" required>
            </div>
            <div>
                <label>District (EN)</label>
                <input type="text" name="district_en" class="border p-2 w-full"
                    value="{{ old('district_en', $office->district_en) }}" required>
            </div>
            <div>
                <label>District (BN)</label>
                <input type="text" name="district_bn" class="border p-2 w-full"
                    value="{{ old('district_bn', $office->district_bn) }}" required>
            </div>
            <div>
                <label>Geo Code</label>
                <input type="text" name="geo_code" class="border p-2 w-full"
                    value="{{ old('geo_code', $office->geo_code) }}">
            </div>
            <div>
                <label>Office Code</label>
                <input type="text" name="office_code" class="border p-2 w-full"
                    value="{{ old('office_code', $office->office_code) }}">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('offices.index') }}" class="ml-2 text-gray-600">Cancel</a>
        </form>
    </div>
@endsection
