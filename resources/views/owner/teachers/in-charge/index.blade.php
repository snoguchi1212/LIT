<x-app-layout>
    {{-- #TODO:sidebarの実装 --}}
    {{-- <x-app-side-bar></x-app-side-bar> --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$teacher->family_name}} {{$teacher->first_name}} 担当生徒一覧
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
                            <div class="mt-4 p-2 w-full flex justify-end">
                                <button onclick="location.href='{{ route('owner.teachers.studentsInCharge.create', [$teacher->id]) }}'" class="text-white bg-green-500 border-0 ml-4 py-2 px-4 focus:outline-none hover:bg-green-600 rounded text-base">新規登録する</button>
                            </div>
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                            <tr>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">学年</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">名前</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ナマエ</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">科目</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($teacher->students()->get() as $student)
                            <tr>
                                <td class="px-4 py-3">{{ GradeConsts::GRADE_LIST[$student->grade] }}</td>
                                <td class="px-4 py-3">{{ $student->family_name }} {{ $student->first_name }}</td>
                                <td class="px-4 py-3">{{ $student->family_name_kana }} {{ $student->first_name_kana }}</td>
                                <td class="px-4 py-3">{{ $subjects->find($student->pivot->subject_id)->name }}</td>
                                <td class="px-4 py-3">
                                    <form id="delete_{{ $student->id }}" method="post" action="{{ route('owner.teachers.studentsInCharge.destroy', ['teacher' => $teacher->id, 'student' => $student->id]) }}">
                                        @csrf
                                        @method("post")
                                        <button href="#" type="submit" data-id="{{ $student->id }}" class="delete_btn text-white bg-red-400 border-0 ml-2 py-2 px-4 focus:outline-none hover:bg-red-500 rounded text-lg">削除</button>
                                    </form>
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
<script>
    function deletePost(e) {
        'use strict';
        if (confirm('本当に削除してもいいですか?')) {
            document.getElementById('delete_' + e.dataset.id).submit();
        }
    }
</script>
</x-app-layout>
