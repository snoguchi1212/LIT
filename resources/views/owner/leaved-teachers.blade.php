<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            退塾講師一覧
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 mx-auto">
                            <x-flash-message status="session('status')" />
                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                            <tr>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">名前</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ナマエ</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">削除日</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- #TODO:showメソッドの追加 --}}
                            @foreach ($leavedStudents as $student)
                            <tr>
                                <td class="px-4 py-3">{{ $student->family_name }} {{ $student->first_name }}</td>
                                <td class="px-4 py-3">{{ $student->family_name_kana }} {{ $student->first_name_kana }}</td>
                                <td class="px-4 py-3">{{ $student->deleted_at->diffForHumans() }}</td>
                                <td class="px-4 py-3">
                                <button onclick="location.href='{{ route('owner.students.edit', [$student->id]) }}'" type="submit" class=" text-white bg-green-400 border-0 py-2 px-4 focus:outline-none hover:bg-green-500 rounded ">復元</button>
                                </td>
                                <form id="delete_{{ $student->id }}" method="post" action="{{ route('owner.leaved-students.destroy', [$student->id]) }}">
                                    @csrf
                                    <td class="px-4 py-3">
                                        <a href="#" data-id="{{ $student->id }}" onclick="deletePost(this)" class=" text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded ">完全に削除</a>
                                    </td>
                                </form>
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
    <script>
        function deletePost(e) {
            'use strict';
            if (confirm('本当に削除してもいいですか?')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>
