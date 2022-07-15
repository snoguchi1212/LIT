<x-app-layout>
    <link rel="stylesheet" type="text/css" href="{{ asset('css\student\test\style.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            定期テスト点数 (テスト)
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
                                {{-- TODO:科目ごとの並び替え --}}
                                <div class="flex">
                                    <div class="mb-4">
                                        {{-- iconを入れる --}}
                                        <button onclick="location.href='{{ route('student.tests.indexOrderBySubject')}}'" class="text-white bg-sky-400 border-0 py-2 px-4 focus:outline-none hover:bg-sky-500 rounded text-lg">科目ごと</button>
                                    </div>
                                    <div class="ml-auto mb-4">
                                        <button onclick="location.href='{{ route('student.tests.create') }}'" class="text-white bg-green-500 border-0 py-2 px-4 focus:outline-none hover:bg-green-600 rounded text-lg">点数を登録する</button>
                                    </div>
                                </div>
                            {{-- TODO:レスポンシブ対応 --}}
                            @foreach ($tests as $test)
                                <div class="studentTestContainer border-2 border-gray-300 sm:rounded-lg">
                                    <div class="flex studentTest cursor-pointer px-4 py-3 text-xl font-medium text-gray-900 bg-gray-200 rounded-tl">
                                        <div>{{ $test->title }}</div>
                                        <div class="hidden sm:block ml-auto my-auto md:mr-8 mr-16 text-sm tracking-wider">
                                            @if ((isset($test->start_date) && isset($test->end_date)) && $test->start_date != $test->end_date)
                                            実施日 : {{ date('Y/m/d',  strtotime($test->start_date)) }}〜{{ date('m/d',  strtotime($test->end_date)) }}
                                            @elseif (!is_null($test->start_date))
                                            実施日 : {{ date('Y/m/d',  strtotime($test->start_date)) }}
                                            @endif
                                        </div>
                                    </div>
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-3 tracking-wider font-medium text-gray-900 text-base bg-gray-100 rounded-tl">教科</th>
                                                <th class="px-4 py-3 tracking-wider font-medium text-gray-900 text-base bg-gray-100 rounded-tl">科目名</th>
                                                <th class="px-4 py-3 tracking-wider font-medium text-gray-900 text-base bg-gray-100 rounded-tl">点数</th>
                                                <th class="px-4 py-3 tracking-wider md:table-cell hidden font-medium text-gray-900 text-base bg-gray-100 rounded-tl">平均点</th>
                                                <th class="px-4 py-3 tracking-wider md:table-cell hidden font-medium text-gray-900 text-base bg-gray-100 rounded-tl">偏差値</th>
                                                <th class="px-4 py-3 tracking-wider md:table-cell hidden font-medium text-gray-900 text-base bg-gray-100 rounded-tl">校内順位</th>
                                                <th class="px-4 py-3 tracking-wider md:table-cell hidden font-medium text-gray-900 text-base bg-gray-100 rounded-tl">全国順位</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($test->scores as $score)
                                            <tr>
                                                <td class="px-4 py-3">{{ $score->subject->name }}</td>
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
                                    <div class="edit_btn m-2">
                                        <form id="delete_{{ $test->id }}" method="post" action="{{ route('student.tests.destroy', [$test->id]) }}">
                                            @csrf
                                            @method("delete")
                                            <button href="#" type="button" data-id="{{ $test->id }}" class="delete_btn text-white bg-red-400 border-0 ml-2 py-2 px-4 focus:outline-none hover:bg-red-500 rounded text-lg">削除</button>
                                        </form>
                                        <button onclick="location.href='{{ route('student.tests.edit', ['test' => $test->id]) }}'" class="text-white bg-blue-400 border-0 ml-2 py-2 px-4 focus:outline-none hover:bg-blue-500 rounded text-lg">編集する</button>
                                    </div>
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
<script src={{ asset('js\testIndex.js')}}></script>
</x-app-layout>
