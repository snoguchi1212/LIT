<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div>生徒追加画面 CSVから登録</div>
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <section class="text-gray-600 body-font relative">
                <div class="container px-5 mx-auto">
                <x-flash-message status="session('status')" />
                <div class="lg:w-1/2 md:w-2/3 mx-auto">
            <form method="POST" action="{{ route('owner.teachers.storeFromCSV') }}" enctype="multipart/form-data">
                @csrf
                <label class="text-right" for="form-file-1"></label>
                <div class="custom-file">
                    <input type="file" name="csv" class="custom-file-input" id="customFile">
                </div>
                <div class="mt-4 p-2 w-full flex justify-around">
                    <button type="button" onclick="location.href='{{ route('owner.teachers.create') }}'" class=" text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg">戻る</button>
                    <button type="submit" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">登録する</button>
                </div>
            </form>
                    </div>
                </div>
            </section>
        </div>
        </div>
        </div>
    </div>
</x-app-layout>
