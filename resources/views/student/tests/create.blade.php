<x-app-layout>
    <link rel="stylesheet" type="text/css" href="{{ asset('css\student\test\edit.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            得点登録画面
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
                                <div class="p-2 -m-2 w-3/4">
                                    <label for="title" class="leading-7 text-sm text-gray-600">テスト名</label>
                                    <input type="text" id="title" name="title[]" value="{{ old('title') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                <div id="scoreForms" class="scoreForms mb-4 border-b border-gray-400">
                                    {{-- 入力フォーム → #TODO:これを複製できるようにする --}}
                                    {{-- #TODO:最後にも線を引く --}}
                                    <div class="scoreForm rounded my-4 border-solid border-t border-gray-400">
                                        <div class="mainForm m-2">
                                            <div class="md:flex flex-wrap -m-2 ml-0 mt-0">
                                                <div class="p-2 mr-8 w-1/4">
                                                    <label for="subject_id" class="leading-7 text-sm text-gray-600">教科<span class="text-red-500 text-xs">【必須】</span></label><br>
                                                    <select id="subject_id" name="subject_id[]">
                                                        @foreach ($subjects as $subject )
                                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="p-2 mr-10 w-2/5">
                                                    <div class="relative">
                                                        <label for="name" class="leading-7 text-sm text-gray-600">科目名<span class="text-red-500 text-xs">【必須】</span></label><br>
                                                        <input type="text" id="name" name="name[]" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="md:flex flex-wrap -m-2 ml-0  mt-0">
                                                <div class="p-2 mr-4 sm:w-1/5 w-2/5">
                                                    <label for="score" class="leading-7 text-sm text-gray-600">点数<span class="text-red-500 text-xs">【必須】</span></label><br>
                                                    <input type="number" id="score" name="score[]"  inputmode="decimal" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                            </div>
                                        </div>
                                    {{-- mainForm --}}
                                        <div class="subForm m-2">
                                            <div class="md:flex flex-wrap -m-2 ml-0  mt-0">
                                                <div class="p-2 mr-4 sm:w-1/5 w-2/5">
                                                    <label for="average_score" class="leading-7 text-sm text-gray-600">平均点</label><br>
                                                    <input type="number" step="0.1" id="average_score" name="average_score[]"  inputmode="decimal" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"><br>
                                                    <span class="text-gray-600 text-xs">(小数第1位)</span></label>
                                                </div>
                                                <div class="p-2 sm:w-1/5 w-2/5">
                                                    <div class="relative">
                                                        <label for="deviation_value" class="leading-7 text-sm text-gray-600">偏差値</label>
                                                        <input type="number" step="0.1" id="deviation_value" name="deviation_value[]" inputmode="decimal" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        <span class="text-gray-600 text-xs">(小数第1位)</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="md:flex flex-wrap justify-between -m-2 ml-0 mt-0">
                                                <div class="flex flex-wrap">
                                                    <div class="p-2 sm:w-1/5 w-2/5">
                                                        <label for="school_ranking" class="leading-7 text-sm text-gray-600">校内順位</label>
                                                        <input type="number" id="school_ranking" name="school_ranking[]"  inputmode="number" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    </div>
                                                    <div class="relative w-4">
                                                        <span class="absolute bottom-2 text-sm align-text-bottom text-gray-600">位</span>
                                                    </div>
                                                    <div class="p-2 sm:w-1/5 w-2/5">
                                                        <div class="relative">
                                                            <label for="school_people" class="leading-7 text-sm text-gray-600">　</label>
                                                            <input type="number" id="school_people" name="school_people[]" inputmode="number" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        </div>
                                                    </div>
                                                    <div class="relative w-8">
                                                        <span class="absolute bottom-2 text-sm align-text-bottom text-gray-600">人中</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="md:flex flex-wrap justify-between -m-2 ml-0 mt-0">
                                                <div class="flex flex-wrap">
                                                    <div class="p-2 sm:w-1/5 w-2/5">
                                                        <label for="national_ranking" class="leading-7 text-sm text-gray-600">全国順位</label>
                                                        <input type="number" id="national_ranking" name="national_ranking[]"  inputmode="number" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    </div>
                                                    <div class="relative w-4">
                                                        <span class="absolute bottom-2 text-sm align-text-bottom text-gray-600">位</span>
                                                    </div>
                                                    <div class="p-2 sm:w-1/5 w-2/5">
                                                        <div class="relative">
                                                            <label for="national_people" class="leading-7 text-sm text-gray-600">　</label>
                                                            <input type="number" id="national_people" name="national_people[]" inputmode="number" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        </div>
                                                    </div>
                                                    <div class="relative w-8">
                                                        <span class="absolute bottom-2 text-sm align-text-bottom text-gray-600">人中</span>
                                                    </div>
                                                    <div class="p-2 ml-auto sm:mt-10 mt-4 mr-4">
                                                        <a class="removeFormButton hidden cursor-pointer text-white bg-red-400 border-0 py-2 px-2 focus:outline-none hover:bg-red-500 rounded text-lg">削除</a>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- #TODO:リンク先の変更 --}}
                                        </div> {{-- subForm --}}
                                    </div> {{-- scoresForm --}}
                                </div> {{-- scoresForms --}}
                                {{-- 入力ボックスの追加ボタン --}}
                                <div class="-mt-2 p-2 w-full flex justify-around">
                                    <button id="addForm" type="button" class="text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg">入力欄を追加</button>
                                </div>
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
<script src={{ asset('js\testEdit.js')}}></script>
</x-app-layout>
