<x-app-layout>
    {{-- #TODO:sidebarの実装 --}}
    {{-- <x-app-side-bar></x-app-side-bar> --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $teacher->family_name }} {{ $teacher->first_name }}
        </h2>
    </x-slot>
    {{-- #TODO:点数の表示 --}}
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 mx-auto">
                            <x-flash-message status="session('status')" />
                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                <div class="flex justify-end mb-4">
                                    <button onclick="location.href='{{ route('owner.teachers.create') }}'" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">新規登録する</button>
                                </div>
                        {{-- #TODO:担当生徒の追加 --}}
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                            <tr>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">名前</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ナマエ</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="px-4 py-3">{{ $teacher->family_name }} {{ $teacher->first_name }}</td>
                                <td class="px-4 py-3">{{ $teacher->family_name_kana }} {{ $teacher->first_name_kana }}</td>
                                <td class="px-4 py-3">
                                <button onclick="location.href='{{ route('owner.teachers.edit', [$teacher->id]) }}'" type="submit" class=" text-white bg-green-400 border-0 py-2 px-4 focus:outline-none hover:bg-green-500 rounded ">登録</button>
                                </td>
                                <form id="delete_{{ $teacher->id }}" method="post" action="{{ route('owner.teachers.destroy', [$teacher->id]) }}">
                                    @csrf
                                    @method("delete")
                                    <td class="px-4 py-3">
                                        <a href="#" data-id="{{ $teacher->id }}" onclick="deletePost(this)" class=" text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded ">削除</a>
                                    </td>
                                </form>
                            </tr>
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
