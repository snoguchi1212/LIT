<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            生徒追加画面
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 mx-auto">
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="post" action="{{ route('student.tests.store') }}">
                            @csrf
                                <div class="p-2 -m-2">
                                    <label for="title" class="leading-7 text-sm text-gray-600">テスト名</label>
                                    <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                {{-- テーブル #TODO:デザインを変更する --}}
                                {{-- <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                    <tr>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">テスト</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">点数</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($scores as $score)
                                    <tr>
                                        <td class="px-4 py-3">{{ $score->name }}</td>
                                        <td class="px-4 py-3">{{ $score->score }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table> --}}
                                {{-- 入力ボックス --}}
                                <div id="input_box">
                                    <!-- 各入力ボックス -->
                                    <div>
                                        <input type="text" name="texts[]">
                                    </div>
                                    <!-- 入力ボックスの削除ボタン -->
                                    <button type="button" id="deleteInput_btn">削除</button>
                                </div>
                                {{-- 入力ボックスの追加ボタン --}}
                                <button type="button" id="addInput_btn" class=" text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">追加する</button>
                                {{-- 入力されたデータの送信ボタン --}}
                                <div class="mt-4 p-2 w-full flex justify-around">
                                    <button type="button" onclick="location.href='{{ route('student.tests.index') }}'" class=" text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg">戻る</button>
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

        // 追加項目の作り方がわからん

        document.getElementById('addInput_btn').addEventListener('click', () => {

            console.log('helo')
            const input_box = document.getElementById('input_box');
            const form = input_box.parentNode;
            const copy = input_box.cloneNode(false);

            console.log(input_box.value)
            console.log(form.value)
            console.log(copy.value)


            const addInput_btn = document.getElementById('addInput_btn');
            form.insertBefore(copy, addInput_btn);
        });

</script>
</x-app-layout>
