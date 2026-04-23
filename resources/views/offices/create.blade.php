@extends('app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Add Office</h1>
        <form action="{{ route('offices.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label>Office Name (BN)</label>
                <input type="text" name="office_name_bn" class="border p-2 w-full" required>
            </div>
            <div>
                <label>Office Name (EN)</label>
                <input type="text" name="office_name_en" class="border p-2 w-full" required>
            </div>
            <div>
                <label>Upazila (EN)</label>
                <input type="text" name="upazila_en" class="border p-2 w-full" required>
            </div>
            <div>
                <label>Upazila (BN)</label>
                <input type="text" name="upazila_bn" class="border p-2 w-full" required>
            </div>
            <div>
                <label>District (EN)</label>
                <input type="text" name="district_en" class="border p-2 w-full" required>
            </div>
            <div>
                <label>District (BN)</label>
                <input type="text" name="district_bn" class="border p-2 w-full" required>
            </div>
            <div>
                <label>Geo Code</label>
                <input type="text" name="geo_code" class="border p-2 w-full">
            </div>
            <div>
                <label>Office Code</label>
                <input type="text" name="office_code" class="border p-2 w-full">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
            <a href="{{ route('offices.index') }}" class="ml-2 text-gray-600">Cancel</a>
        </form>
    </div>
@endsection
