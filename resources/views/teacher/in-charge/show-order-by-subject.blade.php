<x-app-layout>
    <link rel="stylesheet" type="text/css" href="{{ asset('css\student\test\style.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ GradeConsts::GRADE_LIST[$student->grade]}} {{ $student->family_name }} {{ $student->first_name }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 mx-auto">
                            <x-flash-message status="session('status')" />
                            <div class="lg:w-10/12 w-full mx-auto overflow-auto">
                                <div class="flex">
                                    <div class="mb-4">
                                        {{-- iconを入れる --}}
                                        <button onclick="location.href='{{ route('teacher.studentsInCharge.show', [$student->id]) }}'" class="text-white bg-sky-400 border-0 py-2 px-4 focus:outline-none hover:bg-sky-500 rounded text-lg">テストごと</button>
                                    </div>
                                </div>
                            {{-- TODO:レスポンシブ対応 --}}
                            @foreach ($subjects as $subject)
                                <div class="studentTestContainer border-2 border-gray-300 sm:rounded-lg">
                                    <div class="studentTest cursor-pointer px-4 py-3 text-xl font-medium text-gray-900 bg-gray-200 rounded-tl">{{ $subject->name }}</div>
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-3 tracking-wider font-medium text-gray-900 text-base bg-gray-100 rounded-tl">テスト</th>
                                                <th class="px-4 py-3 tracking-wider font-medium text-gray-900 text-base bg-gray-100 rounded-tl">科目名</th>
                                                <th class="px-4 py-3 tracking-wider font-medium text-gray-900 text-base bg-gray-100 rounded-tl">点数</th>
                                                <th class="px-4 py-3 tracking-wider md:table-cell hidden font-medium text-gray-900 text-base bg-gray-100 rounded-tl">平均点</th>
                                                <th class="px-4 py-3 tracking-wider md:table-cell hidden font-medium text-gray-900 text-base bg-gray-100 rounded-tl">偏差値</th>
                                                <th class="px-4 py-3 tracking-wider md:table-cell hidden font-medium text-gray-900 text-base bg-gray-100 rounded-tl">校内順位</th>
                                                <th class="px-4 py-3 tracking-wider md:table-cell hidden font-medium text-gray-900 text-base bg-gray-100 rounded-tl">全国順位</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($subject->scores as $score)
                                            <tr>
                                                <td class="px-4 py-3">{{ $score->test->title }}</td>
                                                <td class="px-4 py-3">{{ $score->name }}</td>
                                                <td class="px-4 py-3">{{ $score->score }}</td>
                                                <td class="px-4 py-3 md:table-cell hidden">{{ $score->average_score }}</td>
                                                <td class="px-4 py-3 md:table-cell hidden">{{ $score->deviation_value }}</td>
                                                <td class="px-4 py-3 md:table-cell hidden">{{ $score->school_ranking }} @if($score->school_ranking!="" and $score->school_people!="" ) / @endif {{ $score->school_people }} @if($score->school_ranking!="" and $score->school_people!="" )人中@endif</td>
                                                <td class="px-4 py-3 md:table-cell hidden">{{ $score->national_ranking }} @if($score->national_ranking!="" and $score->national_people!="" ) / @endif {{ $score->national_people }} @if($score->national_ranking!="" and $score->national_people!="" )人中@endif</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </table>
                        </div>
                    </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
<script src={{ asset('js\testIndex.js')}} ></script>
</x-app-layout>
