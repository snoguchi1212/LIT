<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            生徒管理
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 mx-auto">
                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                <div class="flex justify-end mb-4">
                                    <button onclick="location.href='{{ route('owner.students.create') }}'" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">新規登録する</button>
                                </div>
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                            <tr>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">学年</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">名前</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ナマエ</th></th>
                                <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($e_students as $e_student)
                            <tr>
                                <td class="px-4 py-3">{{ $e_student->grade }}</td>
                                <td class="px-4 py-3">{{ $e_student->family_name }} {{ $e_student->last_name }}</td>
                                <td class="px-4 py-3">{{ $e_student->family_name_kana }} {{ $e_student->last_name_kana }}</td>
                                <td class="w-10 text-center">
                                <input name="plan" type="radio">
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
