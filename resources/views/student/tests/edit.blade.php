<x-app-layout>
    <link rel="stylesheet" type="text/css" href="{{ asset('css\student\test\edit.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            得点編集画面
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 mx-auto">
                            <div class="lg:w-1/2 md:w-9/12 mx-auto">
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form id="form" method="post" action="{{ route('student.tests.update', ['test' => $test->id]) }}">
                            @csrf
                            @method('put')
                                <div class="p-2 mr-2 w-3/4">
                                    <label for="title" class="leading-7 text-sm text-gray-600">テスト名</label><span class="text-red-500 text-xs">【必須】</span></label><br>
                                    <input type="text" maxlength="16" id="title" name="title[]" value="{{ $test->title }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                <div class="p-2 mr-2 w-3/4">
                                    <label for="start_date" class="leading-7 text-sm text-gray-600">実施日</label><br>
                                    <div class="md:flex flex-wrap">
                                        <input type="date" id="start_date" name="start_date" @if(isset($test->start_date)) value="{{ date("Y-m-d", strtotime($test->start_date)) }}" @endif class="w-5/12 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        <div class="mt-2 mx-2">〜</div>
                                        <input type="date" id="end_date" name="end_date" @if(isset($test->end_date)) value="{{ date("Y-m-d", strtotime($test->end_date)) }}" @endif class="w-5/12 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>
                                    <div id="date_form_error" class="hidden text-xs text-red-600 mt-2">正しい日付を入力してください</div>
                                </div>
                                <div id="scoreForms" class="scoreForms mb-4 border-b border-gray-400">
                                    <template id="form-template">
                                        <div class="scoreForm my-4 border-solid border-t border-gray-400">
                                            <div class="mainForm m-2">
                                                <div class="md:flex flex-wrap -m-2 ml-0 mt-0">
                                                    <div class="p-2 mr-8 sm:w-2/5 w-full">
                                                        <label for="subject_id" class="leading-7 text-sm text-gray-600">教科<span class="text-red-500 text-xs">【必須】</span></label><br>
                                                        <select id="subject_id" name="subject_id[]" required>
                                                            @foreach ($subjects as $subject )
                                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="p-2 mr-10 sm:w-5/12 w-full">
                                                        <div class="relative">
                                                            <label for="name" class="leading-7 text-sm text-gray-600">科目名<span class="text-red-500 text-xs">【必須】</span></label><br>
                                                            <input type="text" maxlength="16" id="name" name="name[]" required class="w-11/12 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="md:flex flex-wrap -m-2 ml-0  mt-0">
                                                    <div class="p-2 mr-4">
                                                        <label for="score" class="leading-7 text-sm text-gray-600">点数<span class="text-red-500 text-xs">【必須】</span></label><br>
                                                        <input type="number" id="score" name="score[]" inputmode="numeric" required class="score sm:w-1/2 w-1/3 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        <div class="error text-xs text-red-600 mt-2">入力できる値は, 0〜999の整数値です。</div>
                                                    </div>
                                                </div>
                                            </div> {{-- mainForm --}}
                                            <div class="subForm m-2">
                                                <div class="md:flex flex-wrap -m-2 ml-0  mt-0">
                                                    <div class="p-2 sm:w-1/2 w-full">
                                                        <label for="average_score" class="leading-7 text-sm text-gray-600">平均点 (小数第1位まで)</label><br>
                                                        <input type="number" step="0.1" id="average_score" name="average_score[]" inputmode="decimal" pattern="(^[0-9]{1,3})(\.[0-9]{0,1}$))|(^[0-9]{0,3}$)" class="average sm:w-1/3 w-1/3 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"><br>
                                                        <div class="error text-xs text-red-600 mt-2">入力できる値は, 0〜999の小数第一位までの数字です。</div>
                                                    </div>
                                                    <div class="p-2 sm:w-1/2 w-full">
                                                        <div class="relative">
                                                            <label for="deviation_value" class="leading-7 text-sm text-gray-600">偏差値 (小数第1位まで)</label><br>
                                                            <input type="number" step="0.1" name="deviation_value[]" inputmode="decimal" pattern="((^[0-9]{1,3})(\.[0-9]{0,1}$))|(^[0-9]{0,3}$)" class="deviation sm:w-1/3 w-1/3 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"><br>
                                                            <div class="error text-xs text-red-600 mt-2">入力できる値は, 0〜999の小数第一位までの数字です。</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="md:flex flex-wrap justify-between -m-2 ml-0 mt-0">
                                                    <div class="flex flex-wrap">
                                                        <div class="p-2 sm:w-1/5 w-2/5">
                                                            <label for="school_ranking" class="leading-7 text-sm text-gray-600">校内順位</label>
                                                            <input type="number" id="school_ranking" name="school_ranking[]" inputmode="number" class="ranking w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"><br>
                                                        </div>
                                                        <div class="relative w-4">
                                                            <span class="absolute bottom-2 text-sm align-text-bottom text-gray-600">位</span>
                                                        </div>
                                                        <div class="p-2 sm:w-1/5 w-2/5">
                                                            <div class="relative">
                                                                <label for="school_people" class="leading-7 text-sm text-gray-600">　</label>
                                                                <input type="number" id="school_people" name="school_people[]" inputmode="number" class="ranking w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"><br>
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
                                                            <input type="number" id="national_ranking" name="national_ranking[]"  inputmode="number" class="ranking w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"><br>
                                                        </div>
                                                        <div class="relative w-4">
                                                            <span class="absolute bottom-2 text-sm align-text-bottom text-gray-600">位</span>
                                                        </div>
                                                        <div class="p-2 sm:w-1/5 w-2/5">
                                                            <div class="relative">
                                                                <label for="national_people" class="leading-7 text-sm text-gray-600">　</label>
                                                                <input type="number" id="national_people" name="national_people[]" inputmode="number" class="ranking w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"><br>
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
                                            </div> {{-- subForm --}}
                                        </div> {{-- scoreForm --}}
                                    </template>
                                    {{-- #HACK:バリデーションを送信時にかけると入力内容が削除される → JSで対策 --}}
                                    @foreach ($scores as $score)
                                    <div class="scoreForm my-4 border-solid border-t border-gray-400">
                                        <div class="mainForm m-2">
                                            <div class="md:flex flex-wrap -m-2 ml-0 mt-0">
                                                <div class="p-2 mr-8 sm:w-2/5 w-full">
                                                    <label for="subject_id" class="leading-7 text-sm text-gray-600">教科<span class="text-red-500 text-xs">【必須】</span></label><br>
                                                    <select id="subject_id" name="subject_id[]" required>
                                                        @foreach ($subjects as $subject)
                                                        <option value="{{ $subject->id }}" @if( $score->subject_id === $subject->id ) selected @endif>{{ $subject->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="p-2 mr-10 sm:w-5/12 w-full">
                                                    <div class="relative">
                                                        <label for="name" class="leading-7 text-sm text-gray-600">科目名<span class="text-red-500 text-xs">【必須】</span></label><br>
                                                        <input type="text" maxlength="16" id="name" name="name[]" required value={{ $score->name }} class="w-11/12 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="md:flex flex-wrap -m-2 ml-0  mt-0">
                                                <div class="p-2 mr-4">
                                                    <label for="score" class="leading-7 text-sm text-gray-600">点数<span class="text-red-500 text-xs">【必須】</span></label><br>
                                                    <input type="number" id="score" name="score[]" value={{ $score->score }} inputmode="numeric" required class="score sm:w-1/2 w-1/3 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    <div class="error text-xs text-red-600 mt-2">入力できる値は, 0〜999の整数値です。</div>
                                                </div>
                                            </div>
                                        </div>  {{-- mainForm --}}
                                        <div class="subForm m-2">
                                            <div class="md:flex flex-wrap -m-2 ml-0  mt-0">
                                                <div class="p-2 sm:w-1/2 w-full">
                                                    <label for="average_score" class="leading-7 text-sm text-gray-600">平均点 (小数第1位まで)</label><br>
                                                    <input type="number" step="0.1" id="average_score" name="average_score[]" inputmode="decimal" pattern="(^[0-9]{1,3})(\.[0-9]{0,1}$))|(^[0-9]{0,3}$)" @if(!is_null($score->average_score))value={{ $score->average_score }}@endif class="average sm:w-1/3 w-1/3 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"><br>
                                                    <div class="error text-xs text-red-600 mt-2">入力できる値は, 0〜999の小数第一位までの数字です。</div>
                                                </div>
                                                <div class="p-2 sm:w-1/2 w-full">
                                                    <div class="relative">
                                                        <label for="deviation_value" class="leading-7 text-sm text-gray-600">偏差値 (小数第1位まで)</label><br>
                                                        <input type="number" step="0.1" id="deviation_value" name="deviation_value[]" inputmode="decimal" @if(!is_null($score->deviation_value))value={{ $score->deviation_value }}@endif class="deviation sm:w-1/3 w-1/3 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"><br>
                                                        <div class="error text-xs text-red-600 mt-2">入力できる値は, 0〜999の小数第一位までの数字です。</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="md:flex flex-wrap justify-between -m-2 ml-0 mt-0">
                                                <div class="flex flex-wrap">
                                                    <div class="p-2 sm:w-1/5 w-2/5">
                                                        <label for="school_ranking" class="leading-7 text-sm text-gray-600">校内順位</label>
                                                        <input type="number" id="school_ranking" name="school_ranking[]" inputmode="number"  @if(!is_null($score->school_ranking))value={{ $score->school_ranking }}@endif class="ranking w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"><br>
                                                    </div>
                                                    <div class="relative w-4">
                                                        <span class="absolute bottom-2 text-sm align-text-bottom text-gray-600">位</span>
                                                    </div>
                                                    <div class="p-2 sm:w-1/5 w-2/5">
                                                        <div class="relative">
                                                            <label for="school_people" class="leading-7 text-sm text-gray-600">　</label>
                                                            <input type="number" id="school_people" name="school_people[]" inputmode="number"  @if(!is_null($score->school_people))value={{ $score->school_people }}@endif class="ranking w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"><br>
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
                                                        <input type="number" id="national_ranking" name="national_ranking[]"  inputmode="number" @if(!is_null($score->national_ranking))value={{ $score->national_ranking }}@endif class="ranking w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"><br>
                                                    </div>
                                                    <div class="relative w-4">
                                                        <span class="absolute bottom-2 text-sm align-text-bottom text-gray-600">位</span>
                                                    </div>
                                                    <div class="p-2 sm:w-1/5 w-2/5">
                                                        <div class="relative">
                                                            <label for="national_people" class="leading-7 text-sm text-gray-600">　</label>
                                                            <input type="number" id="national_people" name="national_people[]" inputmode="number" @if(!is_null($score->national_people))value={{ $score->national_people }}@endif class="ranking w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"><br>
                                                        </div>
                                                    </div>
                                                    <div class="relative w-8">
                                                        <span class="absolute bottom-2 text-sm align-text-bottom text-gray-600">人中</span>
                                                    </div>
                                                    <div class="p-2 ml-auto sm:mt-10 mt-4 mr-4">
                                                        <a class="removeFormButton cursor-pointer hidden text-white bg-red-400 border-0 py-2 px-2 focus:outline-none hover:bg-red-500 rounded text-lg">削除</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> {{-- subForm --}}
                                    </div> {{-- scoreForm --}}
                                    @endforeach
                                </div> {{-- scoresForms --}}
                                {{-- 入力ボックスの追加ボタン --}}
                                <div class="-mt-2 p-2 w-full flex justify-around">
                                    <button id="addForm" type="button" class="text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg">入力欄を追加</button>
                                    <button id="unableAddForm" type="button" class="hidden bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-200 rounded text-lg">これ以上入力欄を追加することはできません</button>
                                </div>
                                {{-- 入力されたデータの送信ボタン --}}
                                <div class="mt-4 p-2 w-full flex justify-around">
                                    <button type="button" onclick="location.href='{{ route('student.tests.index') }}'" class=" text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg">戻る</button>
                                    <button type="submit" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">更新する</button>
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
