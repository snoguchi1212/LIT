<x-app-layout>
    {{-- #TODO:sidebarの実装 --}}
    {{-- <x-app-side-bar></x-app-side-bar> --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            担当生徒追加
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 mx-auto">
                            <x-flash-message status="session('status')" />
                            <form method="POST" action="{{ route('owner.teachers.studentsInCharge.upsert', ['teacher' => $teacher->id]) }}">
                                @csrf
                                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                <h2  class="font-semibold text-xl text-gray-800 leading-tight pb-2">{{$teacher->family_name}} {{$teacher->first_name}} </h2>
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                            <tr>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">学年</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">名前</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">教科</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- #TODO:データの追加→ペジネーションの追加 --}}
                            <tr>
                                <td class="px-4 py-3">
                                <select id="grade" data-url={{ route('owner.teachers.studentsInCharge.create', [$teacher->id]) }} name="grade" onchange="gradeChange()">
                                    @foreach (GradeConsts::GRADE_LIST as $number => $name )
                                    <option value="{{ $number }}" @if($gradeId == $number) selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                                </td>
                                <td class="px-4 py-3">
                                    <select id="student" name="student">
                                        @foreach ($students as $student )
                                            <option value="{{ $student->id }}">{{ $student->family_name }}{{ $student->first_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-4 py-3">
                                    <select name="subject">
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" >{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="mt-4 p-2 w-full flex justify-around">
                            <button type="submit" class=" text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">登録する</button>
                        </div>
                    </form>
                        </div>
                    </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script>
        function gradeChange(){
            const grade = document.getElementById('grade');
            const gradeId = grade.selectedIndex + 1
            const url = grade.dataset.url;

            window.location.href = url+`/`+gradeId;
        }
    </script>
</x-app-layout>
