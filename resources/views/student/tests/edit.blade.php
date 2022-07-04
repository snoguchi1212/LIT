<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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
                                <div class="studentTestContainer absolute border-2 border-gray-300">
                                    <div class="studentTest cursor-pointer px-4 py-3 text-xl font-medium text-gray-900 bg-gray-200 rounded-tl">{{ $test->title }}</div>
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-3 tracking-wider font-medium text-gray-900 text-base bg-gray-100 rounded-tl">教科</th>
                                                <th class="px-4 py-3 tracking-wider font-medium text-gray-900 text-base bg-gray-100 rounded-tl">科目名</th>
                                                <th class="px-4 py-3 tracking-wider font-medium text-gray-900 text-base bg-gray-100 rounded-tl">点数</th>
                                                <th class="px-4 py-3 tracking-wider font-medium text-gray-900 text-base bg-gray-100 rounded-tl">平均点</th>
                                                <th class="px-4 py-3 tracking-wider font-medium text-gray-900 text-base bg-gray-100 rounded-tl">偏差値</th>
                                                <th class="px-4 py-3 tracking-wider font-medium text-gray-900 text-base bg-gray-100 rounded-tl">校内順位</th>
                                                <th class="px-4 py-3 tracking-wider font-medium text-gray-900 text-base bg-gray-100 rounded-tl">全国順位</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($scores as $score)
                                            <tr>
                                                <td class="px-4 py-3">{{ $score->subject_id }}</td>
                                                <td class="px-4 py-3">{{ $score->name }}</td>
                                                <td class="px-4 py-3">{{ $score->score }}</td>
                                                <td class="px-4 py-3">{{ $score->average_score }}</td>
                                                <td class="px-4 py-3">{{ $score->deviation_value }}</td>
                                                <td class="px-4 py-3">{{ $score->school_ranking }} / {{ $score->school_people }}人中</td>
                                                <td class="px-4 py-3">{{ $score->national_ranking }} / {{ $score->national_people }}人中</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="edit_btn m-2 flex justify-end mb-4">
                                        <button onclick="location.href='{{ route('student.tests.edit', ['test' => $test->id]) }}'" class="text-white bg-blue-400 border-0 py-2 px-8 focus:outline-none hover:bg-blue-500 rounded text-lg">確認画面へ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
